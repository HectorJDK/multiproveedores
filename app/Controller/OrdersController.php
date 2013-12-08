<?php
App::uses('AppController', 'Controller');
App::uses('EmailsController', 'Controller');
App::uses('SuppliersController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 */
class OrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Order->recursive = 2;

		$this->Paginator->settings = array(
				'limit' => 5,
				'recursive'=>2
		);
		//Mostrar las ordenes por cerrar (que no estan pagadas, ni canceladas, ni con fecha de pago)
		$orders = $this->Paginator->paginate(array('Order.deleted' => 0, 'Order.closed'=>0, 
			'Order.cancelled'=>0,'Order.payed'=>0));
		$this->set('orders', $orders);
	}

	public function add() {
		if ($this->request->is('post')) {
			}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));

		$order = $this->Order->find('first', $options);
		$this->set('order', $order );

		$quote = $this->Order->Quote->findById($order['Order']['quote_id']);
		$this->set('quote', $quote);

		// $this->set('product', $this->Order->Quote->Product->findById($quote['Quote']['product_id']));
	}

    public function create_order_for_quote($quote, $supplier, $request, $email, $logistics, $product, $copy)
    {
        $this->Order->create();
        $order = array('quote_id'=>$quote['id']);

        $this->Order->save($order);

        $supplier['debt'] += $request['quantity'] * $quote['unitary_price'];

        //en este punto, $supplier ya no contiene el valor mas nuevo para rejected y accepted quotes, por lo que
        //es importante actualizar únicamente el campo de debt y no el modelo entero.
        $this->Order->Quote->Supplier->id = $supplier['id'];
        $this->Order->Quote->Supplier->saveField('debt', $supplier['debt']);

 		
        $emailsController = new EmailsController();
        $emailsController->sendEmailForOrder($order, $supplier, $request,$email, $logistics, $product, $copy);
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
			$this->request->data = $this->Order->find('first', $options);
		}
		$users = $this->Order->User->find('list');
		$quotes = $this->Order->Quote->find('list');
		$states = $this->Order->State->find('list');
		$this->set(compact('users', 'quotes', 'states'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Order->delete()) {
			$this->Session->setFlash(__('The order has been deleted.'));
		} else {
			$this->Session->setFlash(__('The order could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
 * orderToClose method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function orderToClose() {
		//Obtenemos el id de la orden
		
		$id = $this->request->data["order_id"];
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		
		 //Limitar la busqueda
        $this->Order->recursive = 0;
		$data = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));

		//Actualizar el rating del proveedor 		
		$supplier = new SuppliersController();
		if($supplier->update_rating($data['Quote']['supplier_id'],$this->request->data["rating_".$id])){
			$this->Session->setFlash(__('No se pudo actualizar el rating del proveedor'));
		}

		//Asignamos el rating que le dio el usuario
		$data['Order']['rating']=$this->request->data["rating_".$id];
		//Asignamos la fecha de pago
		$data['Order']['due_date'] = $this->request->data["pay_date_".$id];	
		//Cerramos la orden
		$data['Order']['closed'] = 1;
		//Actualizamos	
		if ($this->Order->save($data['Order'])) {
			$this->Session->setFlash(__('La orden se ha transferido a cuentas por pagar.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('La orden no pudo ser procesada.'));
		}
	}

/**
 * orderToClose method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function ordersToPay($id = null) {
		if ($id!=null) {
			//Obtenemos el id de la orden
						
			if (!$this->Order->exists($id)) {
				throw new NotFoundException(__('Invalid request'));
			}
			
			 //Limitar la busqueda
	        $this->Order->recursive = -1;
			$data = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));		

			//Actualizamos el estado de la orden
			$data['Order']['payed']=1;
			//Actualizamos	
			if ($this->Order->save($data['Order'])) {
				$this->Session->setFlash(__('La orden ha sido procesada y archivada en el historial.'));
				return $this->redirect(array('action' => 'ordersToPay'));
			} else {
				$this->Session->setFlash(__('La orden no pudo ser procesada.'));
			}
		} else {
			$this->Order->recursive = 2;

			$this->Paginator->settings = array(
					'limit' => 5,
					'recursive'=>2
			);
			//Mostrar las ordenes por pagar (fecha de pago definida)
			$orders = $this->Paginator->paginate(array('Order.deleted' => 0, 'Order.cancelled'=>0, 
				'Order.payed'=>0,'Order.closed '=>1));
			$this->set('orders', $orders);
		}
	}

/**
 * ordersHistory method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function ordersHistory($filter=null) {
		$this->Order->recursive = 2;

		$this->Paginator->settings = array(
				'limit' => 5,
				'recursive'=>2
		);
		//Mostrar las ordenes pagadas y canceladas
		if($filter==null){
		$findParams = array( 
         	'and' => array( 
             	'Order.deleted' => 0,
                'or' => array(
                	'Order.cancelled '=> 1, 
                 	'Order.payed ' => 1		               			
           			)	                         	
                )
            ); 
		} else {
			$findParams = array( 
         	'and' => array( 
             	'Order.deleted' => 0,
                'Order.'.$filter => 1	               			
           		)	                         	                
            ); 
		}
		$orders = $this->Paginator->paginate($findParams);
		$this->set('orders', $orders);
		
		
		//Obtener informacion de tipos
		if(isset($orders[0]) and !is_null($orders[0])){
			$this->Order->Behaviors->load('Containable');
			foreach($orders as $key => $value){
				$data[$key]=$this->Order->Quote->Product->find('first',
					array(
						'conditions'=>array('Product.id'=>$value['Quote']['Product']['id'])
					,
						'contain'=>array('Type')
					)
				);
				$tipos[$key]=$data[$key]['Type'];
			}
			$this->Order->Behaviors->unload('Containable');
			$this->set('tipos',$tipos);
		}
		
	}

	/**
 * cancel method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function cancel($order_id, $from) {
		if ($this->request->is(array('post', 'put'))) {
			//Obtenemos el id de la orden			
			$id = $order_id;//$this->request->data["order_id"];	
			if (!$this->Order->exists($id)) {
				throw new NotFoundException(__('Invalid request'));
			}
			
			 //Limitar la busqueda
	        $this->Order->recursive = -1;
			$data = $this->Order->find('first', array('conditions' => array('Order.id' => $id)));		

			//Actualizamos el estado de la orden
			$data['Order']['cancelled']=1;
			//Actualizamos	
			if ($this->Order->save($data['Order'])) {
				$this->Session->setFlash(__('La orden ha sido cancelada y archivada en el historial.'));
				return $this->redirect(array('action' => $from));
			} else {
				$this->Session->setFlash(__('La orden no pudo ser cancelada.'));
			}
		} 
	}
}


