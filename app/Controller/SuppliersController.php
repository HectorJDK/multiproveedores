<?php
App::uses('AppController', 'Controller');
App::uses('ProductSearch', 'Lib');
App::uses('SupplierResult', 'Lib');
App::uses('PastOrder', 'Lib');

/**
 * Suppliers Controller
 *
 * @property Supplier $Supplier
 * @property PaginatorComponent $Paginator
 */
class SuppliersController extends AppController {
    var $uses = array('Supplier', 'Product');

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
	public function index() {
		$this->Supplier->recursive = 0;
		$this->set('suppliers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
		$this->set('supplier', $this->Supplier->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add()
    {
		if ($this->request->is('post'))
        {
			$this->Supplier->create();
            {
				if ($this->Supplier->save($this->request->data))
                {
					$this->Session->setFlash(__('The supplier has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The supplier could not be saved. Please, try again.'));
				}
			}
		}		
		$origins = $this->Supplier->Origin->find('list');
		$types = $this->Supplier->Type->find('list');
		$this->set(compact('origins',  'types'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null)
	{
        $this->Supplier->id = $id;
    
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		if ($this->request->is(array('post', 'put')))
        {
			if ($this->Supplier->save($this->request->data))
            {
				$this->Session->setFlash(__('The supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else
            {
				$this->Session->setFlash(__('The supplier could not be saved. Please, try again.'));
			}
		} else
        {
			$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
            $supplier = $this->Supplier->find('first', $options);
            $this->set('supplier', $supplier);
			$this->request->data = $supplier;
		}
		$categories = $this->Supplier->Origin->find('list');
		$products = $this->Supplier->Product->find('list');
		$types = $this->Supplier->Type->find('list');
		$this->set(compact('categories', 'products', 'types'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Supplier->id = $id;
		if (!$this->Supplier->exists()) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Supplier->delete()) {
			$this->Session->setFlash(__('The supplier has been deleted.'));
		} else {
			$this->Session->setFlash(__('The supplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


    public function suppliers_for_category_product_type()
    {
        $category = $this->request->data['Supplier']['category'];
        $product_type = $this->request->data['Supplier']['type'];
        $request_id = $this->request->data['request_id'];

        /* @var $results SupplierResult[] */
        $results = $this->Supplier->search_by_product_type($category, $product_type);
        $this->set('results', $results);
        $this->set('request_id', $request_id);
    }

    public function suppliers_for_products()
    {
        $products = json_decode($this->request->data['Suppliers']['products_for_suppliers']);
        $request_id = $this->request->data['Suppliers']['request_id'];
        $result = $this->Product->search_suppliers_for_products($products);
        $this->set('suppliers_products', $result);
        $this->set('request_id', $request_id);
    }

    public function increment_accepted_quotes($supplier_id)
    {
        $options = array('conditions' => array('id' => $supplier_id));
        $supplier = $this->Supplier->find('first', $options);

        $accepted_quotes = $supplier['Supplier']['accepted_quotes'] + 1;

        $this->Supplier->id = $supplier_id;
        $this->Supplier->saveField('accepted_quotes', $accepted_quotes);
    }

    public function increment_rejected_quotes($supplier_id)
    {
        $options = array('conditions' => array('id' => $supplier_id));
        $supplier = $this->Supplier->find('first', $options);

        $rejected_quotes = $supplier['Supplier']['rejected_quotes'] + 1;

        $this->Supplier->id = $supplier_id;
        $this->Supplier->saveField('rejected_quotes', $rejected_quotes);
    }

    public function record($supplier_id)
    {
        $this->Supplier->recursive = -1;
        $payed_orders = $this->get_accepted_orders_for_supplier($this, $supplier_id);
        $supplier = $this->Supplier->findById($supplier_id);
        $supplier = $supplier['Supplier'];
        $this->set(compact('supplier', 'payed_orders'));
    }

    public function get_accepted_orders_for_supplier($controller, $supplier_id)
    {
        $controller->Paginator->settings = array(
            'limit' => 20,
            'recursive' => 1,
            'contain' => 'Order',
            'conditions' => array(
                'supplier_id' => $supplier_id,
                'status_quote_id' => 1,
                'Order.payed' => true,
            )
        );
        $query_result = $controller->Paginator->paginate($controller->Supplier->Quote);
        $result = array();
        foreach ($query_result as $quote)
        {
            array_push($result,
                new PastOrder(
                    $quote['Product'],
                    $quote['Request']['quantity'],
                    $quote['Quote']['unitary_price'],
                    $quote['Quote']['modified'],
                    $quote['Order']['rating']
                )
            );
        }
        return $result;
    }

}