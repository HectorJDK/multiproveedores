<?php
App::uses('AppController', 'Controller');
App::uses('EmailsController', 'Controller');
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
		$orders = $this->Paginator->paginate(array('Order.deleted' => 0));
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

    public function create_order_for_quote($quote, $supplier, $request)
    {
        $this->Order->create();
        $order = array('quote_id'=>$quote['id']);

        $this->Order->save($order);

        $supplier['debt'] += $request['quantity'] * $quote['unitary_price'];
        $this->Order->Quote->Supplier->save($supplier);

        $emailsController = new EmailsController();
        $emailsController->sendEmailForOrder($order, $supplier, $request);
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
	}}


