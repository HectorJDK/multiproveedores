<?php
App::uses('AppController', 'Controller');
App::uses('RequestsController', 'Controller');
App::uses('SuppliersController', 'Controller');
App::uses('ProductsSuppliersController', 'Controller');
App::uses('OrdersController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses( 'EmailConfig', 'Model');
App::uses( 'Order', 'Model');
/**
 * Quotes Controller
 *
 * @property Quote $Quote
 * @property PaginatorComponent $Paginator
 */
class QuotesController extends AppController
{

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator', 'RequestHandler');
/**
 * index method
 *
 * @return void
 */
public function index($request_id = null)
{
	$userId = $this->Auth->user('id');

	if(isset($request_id)){
		$this->Paginator->settings = array(
				'limit' => 1,
				'recursive'=>2,
				'conditions' => array(
					'Request.quote_count >' => 0,
					'Request.deleted' => 0,
					'Request.id' => $request_id,
					'Request.user_id'=> $userId
				)
		);
	}else{
		$this->Paginator->settings = array(
				'limit' => 1,
				'recursive'=>2,                     
				'conditions' => array( 'Request.deleted' => 0,'Request.user_id' => $userId, 'Request.quote_count > '=> 0)
		);
	}
	$requests = $this->Paginator->paginate($this->Quote->Request);
	for($i = 0 ; $i < count($requests); $i++)
	{
		for($j = 0; $j < count($requests[$i]['Quote']); $j++)
		{
			if($requests[$i]['Quote'][$j]['deleted']==1)
			{
				unset($requests[$i]['Quote'][$j]);
				$j--;
			}
		}
	}

	//Obtencion de la informacion de los productos en cada quote
	if(isset($requests[0]) and !is_null($requests[0])){
		$this->Quote->Product->Behaviors->load('Containable');
		foreach($requests[0]['Quote'] as $key => $value){
			$data[$key]=$this->Quote->Product->find('first',
				array(
					'conditions'=>array('Product.id'=>$value["product_id"])
				,
					'contain'=>array('Attribute','Type')
				)
			);
		}
		$this->Quote->Product->Behaviors->unload('Containable');
		$this->set('data',$data);
	}
	$this->set('requests', $requests);
}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Quote->id = $id;
		if (!$this->Quote->exists()) {
			throw new NotFoundException(__('Invalid quote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quote->delete()) {
			$this->Session->setFlash(__('The quote has been deleted.'));
		} else {
			$this->Session->setFlash(__('The quote could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function preview()
	{
		if ($this->request->is('post'))
		{
			//Obtenemos los valores correspondientes de request
			$request_id = $this->request->data['request_id'];
			$quotes = $this->request->data['quotes'];

            //Wrap de la informacion para su procesamiento
            $data['request_id'] = $request_id;
            $data['quotes'] = $quotes;

			//Inicializacion
			$accepted_quotes = 0;
            $accepted_quote_id = null;

			//Contamos que o todos los quotes sean rechazados o haya maximo uno aceptado
			foreach ($quotes as $id => $value)
			{
				if($value == 1)
                {
                    $accepted_quotes ++;
                    $accepted_quote_id = $id;
                }

			}

			if($accepted_quotes > 1)
			{
				$this->Session->setFlash(__('Se debe de aceptar máximo 1 cotización.'));
				return $this->redirect(array('controller'=>'quotes', 'action' => 'index'));
			}
            elseif(is_null($accepted_quote_id))
            {
                $this->processQuotes($request_id, $quotes);
            }
            elseif($accepted_quotes == 1)
            {
                $this->Quote->Behaviors->load('Containable');
                $accepted_quote = $this->Quote->find('first',
                    array
                    (
                        'conditions'=>array('Quote.id'=>$accepted_quote_id),
                        'contain'=>array('Request', 'Supplier', 'Product' => array('Type', 'Attribute'))
                    )
                );
                $this->Quote->Behaviors->unload('Containable');
                $this->Session->write('data', $data);
                $this->Session->write('product',  $accepted_quote["Product"]);
                $this->set('quote', $accepted_quote);
            }
           
            else
            {
                throw new InternalErrorException();
            }
		}
		else
		{
			throw new NotFoundException('Pagina no accesible');
		}
	}

	public function processQuotes($request_id = null, $quotes = null)
	{

		$transaction = $this->Quote->getDataSource();
		$transaction->begin();

		 $this->Quote->recursive = 0;

		//Marcar el request como deleted
        if(is_null($request_id) and is_null($quotes))
        {
            $data = $this->Session->read('data');
            $product = $this->Session->read('product');
            $quotes = $data['quotes'];           
            $request_id = $data['request_id'];
            $this->Session->delete('quotes');
        }

		//Asignar status y procesar quotes
		$accepted_quotes = 0;
		$accepted_quote = null;
		
		foreach ($quotes as $id => $value)
		{
			$quote_query = $this->Quote->findById($id);
			$quote_query['Quote']['status_quote_id'] = $value;
			$quote_query['Quote']['deleted'] = 1;
			$this->Quote->save($quote_query['Quote']);
			if($value == 1)
			{
				$accepted_quotes ++;
				$accepted_quote = $quote_query;
			}
			else
			{
				$this->reject($quote_query, $value);
			}
		}

		if($accepted_quotes > 1)
		{
			$this->Session->setFlash(__('Se debe de aceptar máximo 1 cotización.'));
			$transaction->rollback();
			return $this->redirect(array('controller'=>'quotes', 'action' => 'index'));
		}
		else
		{
			if($accepted_quotes == 1)
			{
				$this->Quote->Request->id = $request_id;
				$this->Quote->Request->saveField('deleted', '1');
				$this->accept($accepted_quote, $product, $this->request->data['Quote']['logistics'],$this->request->data['order_email_copy']);
			}
			$transaction->commit();
		}
		$this->Session->setFlash(__('Se registró la orden y se envió por correo al proveedor.'));
		return $this->redirect(array('controller'=>'requests', 'action' => 'myRequests'));
	}

	private function accept($quote_query, $product, $logistics, $copy)
	{
		//incrementar accepted_quotes
		$sc = new SuppliersController();
		$sc->increment_accepted_quotes($quote_query['Supplier']['id']);
		
		//crear orden
		//Obtener mail de usuario logueado
        $userMail=$this->Auth->user();
		$orderController = new OrdersController();
		$orderController->create_order_for_quote($quote_query['Quote'], $quote_query['Supplier'], $quote_query['Request'],$userMail["email"], $logistics, $product, $copy);

		//actualizal precio
		$product_supplier_controller = new ProductsSuppliersController();
		$product_supplier_controller->update_price_by_quote($quote_query['Quote'], $quote_query['Supplier']);

	}

	private function reject($quote_query, $value)
	{
		//incrementar rejected_quotes y aumenta la razon de la perdida de la cotizacion de ser con el tipo que fue
		$sc = new SuppliersController();
		$sc->increment_rejected_quotes($quote_query['Supplier']['id'], $value);
	}


	public function setProductToQuote()
	{
		$this->autoRender = false;
		$this->autoLayout = false;

		$keyQ = $this->request->data['keyQ'];

		$quote_id = $this->request->data['quote_id'];
		$manufacturer_id = $this->request->data['manufacturer_id'];
		$price = $this->request->data['price'];


		$quote = $this->Quote->findById($quote_id);
		$requestController = new RequestsController();

		if($requestController->validateIOwnRequest($this, $quote['Request']['id']))
		{
			if(is_null($quote['Quote']['product_id']))
			{
				$product = $this->Quote->Product->findByManufacturerId($manufacturer_id);
				if(count($product) == 0)
				{
					throw new Exception("No se encontró el producto.");
				}
				else
				{
					$transaction = $this->Quote->getDataSource();
					$transaction->begin();

					$this->Quote->id = $quote_id;
					$this->Quote->saveField('product_id', $product['Product']['id']);
					$this->Quote->saveField('unitary_price', $price);

					$psc = new ProductsSuppliersController();
					$psc->ensure_that_supplier_supplies_product($quote['Quote']['supplier_id'], $product['Product']['id'], $price);
					$transaction->commit();
					$view = new View($this, false);
					$this->Quote->recursive = 2;
					$quote = $this->Quote->findById($quote_id);
					$quote_for_element = $quote['Quote'];
					$quote_for_element['Supplier'] = $quote['Supplier'];
					$quote_for_element['Product'] = $quote['Product'];
					$quote_for_element['Request'] = $quote['Request'];
					 $this->Quote->Product->Behaviors->load('Containable');
						//echo "<pre>". print_r($requests,TRUE)."</pre>";                        
							$data[$keyQ]=$this->Quote->Product->find('first',
								array(
									'conditions'=>array('Product.id'=>$quote['Quote']['product_id'])
									,
								 'contain'=>array('Attribute','Type')
								 )
								);                        
						$this->Quote->Product->Behaviors->unload('Containable');
						$this->set('data',$data);
					echo $view->element('Quotes/pending', array('quote' => $quote_for_element, 
						'data'=>$data,'keyQ'=>$keyQ));
				}
			}
			else
			{
				throw new InternalErrorException("El quote ya tenía un producto asignado.");
			}
		}
		else
		{
			throw new ForbiddenException("No le pertenece el request.");
		}
	}

	/**
	 * updatePrice method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function updatePrice() {

		$this->autoRender = false;

		$datos=array();
		$datos= $this->request->data;
		//Asignar el id de la cotizacion a actualizar
		$this->Quote->id = 79;//$datos[0];
		if (!$this->Quote->exists()) {
			echo json_encode(0);
		}
		//Guardar el precio en productsSupplier
		$productsSupplier = $this->Quote->Product->ProductsSupplier->find('first', array('conditions'=>array(
			'product_id'=>$datos[3], 'supplier_id'=>$datos[2])));				
		$this->Quote->Product->ProductsSupplier->id = $productsSupplier['ProductsSupplier']['id'];		
		//Actualizar el precio en las dos tablas
		if ($this->Quote->saveField('unitary_price', $datos[1])) {
			if ($this->Quote->Product->ProductsSupplier->saveField('price', $datos[1])) {
				echo json_encode(1);
			} else {
				echo json_encode(0);
			}			
		} else {
			echo json_encode(0);
		}
	}
}
