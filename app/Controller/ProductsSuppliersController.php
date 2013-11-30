<?php
App::uses('AppController', 'Controller');
/**
 * ProductsSuppliers Controller
 *
 * @property ProductsSupplier $ProductsSupplier
 * @property PaginatorComponent $Paginator
 */
class ProductsSuppliersController extends AppController {

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
		$this->ProductsSupplier->recursive = 0;
		$this->set('productsSuppliers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductsSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid products supplier'));
		}
		$options = array('conditions' => array('ProductsSupplier.' . $this->ProductsSupplier->primaryKey => $id));
		$this->set('productsSupplier', $this->ProductsSupplier->find('first', $options));
	}

    public function update_price_by_quote($quote, $supplier)
    {
        $product_supplier = $this->ProductsSupplier->find(
            'first',
            array('conditions'=>array(
                'supplier_id'=>$supplier['id'],
                'product_id'=>$quote['product_id']
            )));
        if(count($product_supplier) == 0)
        {
            $this->ProductsSupplier->create();
            $product_supplier = array(
                'supplier_id'=>$supplier['id'],
                'product_id'=>$quote['product_id'],
                'price'=>$quote['unitary_price']
            );
            $this->ProductsSupplier->save($product_supplier);
        }else
        {
            $product_supplier = $product_supplier['ProductsSupplier'];
            $product_supplier['price'] = $quote['unitary_price'];
            $this->ProductsSupplier->save($product_supplier);
        }
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductsSupplier->create();
			if ($this->ProductsSupplier->save($this->request->data)) {
				$this->Session->setFlash(__('The products supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products supplier could not be saved. Please, try again.'));
			}
		}
		$suppliers = $this->ProductsSupplier->Supplier->find('list');
		$products = $this->ProductsSupplier->Product->find('list');
		$this->set(compact('suppliers', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductsSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid products supplier'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductsSupplier->save($this->request->data)) {
				$this->Session->setFlash(__('The products supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products supplier could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductsSupplier.' . $this->ProductsSupplier->primaryKey => $id));
			$this->request->data = $this->ProductsSupplier->find('first', $options);
		}
		$suppliers = $this->ProductsSupplier->Supplier->find('list');
		$products = $this->ProductsSupplier->Product->find('list');
		$this->set(compact('suppliers', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductsSupplier->id = $id;
		if (!$this->ProductsSupplier->exists()) {
			throw new NotFoundException(__('Invalid products supplier'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductsSupplier->delete()) {
			$this->Session->setFlash(__('The products supplier has been deleted.'));
		} else {
			$this->Session->setFlash(__('The products supplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
