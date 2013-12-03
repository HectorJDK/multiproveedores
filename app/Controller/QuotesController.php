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
                    'Request.user_id'=>$userId
                )
        );
    }else{
        $this->Quote->Product->Behaviors->load('Containable');
        $this->Paginator->settings = array(
                'limit' => 1,
                'recursive'=>2,                     
                'conditions' => array( 'Request.deleted' => 0,'Request.user_id' => $userId, 'Request.quote_count > '=> 0)
        );
    }
    $requests = $this->Paginator->paginate($this->Quote->Request);
    foreach ($requests as $key => $request)
    {
        for($i = 0; $i < count($request['Quote']); $i++)
        {
            if($request['Quote'][$i]['deleted']==1)
            {
                unset($request['Quote'][$i]);
                $i--;
            }
        }
    }
    //$this->Quote->Product->Behaviors->load('Containable');
    //echo "<pre>". print_r($this->element('sql_dump'),TRUE)."</pre>";

    foreach($requests[0]['Quote'] as $key => $value  ){
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

    public function processQuotes()
    {

        $transaction = $this->Quote->getDataSource();
        $transaction->begin();

         $this->Quote->recursive = 0;

        //Marcar el request como deleted
        $request_id = $this->request->data['request_id'];
        $this->Quote->Request->id = $request_id;
        $this->Quote->Request->saveField('deleted', '1');

        $quotes = $this->request->data['quotes'];

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
                $this->reject($quote_query);
            }
        }

        if($accepted_quotes > 1)
        {
            $this->Session->setFlash(__('Se debe de aceptar máximo 1 cotización.'));
            $transaction->rollback();
            return $this->redirect(array('controller'=>'quotes', 'action' => 'index'));
        }else
        {
            if($accepted_quotes == 1)
            {
                $this->accept($accepted_quote);
            }
            $transaction->commit();
        }
        return $this->redirect(array('controller'=>'requests', 'action' => 'myRequests'));
    }

    private function accept($quote_query)
    {
        //incrementar accepted_quotes
        $sc = new SuppliersController();
        $sc->increment_accepted_quotes($quote_query['Supplier']['id']);

        //crear orden
        $orderController = new OrdersController();
        $orderController->create_order_for_quote($quote_query['Quote'], $quote_query['Supplier'], $quote_query['Request']);

        //actualizal precio
        //$product_supplier_controller = new ProductsSuppliersController();
        //$product_supplier_controller->update_price_by_quote($quote_query['Quote'], $quote_query['Supplier']);

    }

    private function reject($quote_query)
    {
        //incrementar rejected_quotes
        $sc = new SuppliersController();
        $sc->increment_rejected_quotes($quote_query['Supplier']['id']);

        //actualizar precio
        //$product_supplier_controller = new ProductsSuppliersController();
        //$product_supplier_controller->update_price_by_quote($quote_query['Quote'], $quote_query['Supplier']);
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

}
