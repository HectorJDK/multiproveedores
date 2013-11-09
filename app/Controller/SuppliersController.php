<?php
App::uses('AppController', 'Controller');
App::uses('ProductSearch', 'Lib');

/**
 * Suppliers Controller
 *
 * @property Supplier $Supplier
 * @property PaginatorComponent $Paginator
 */
class SuppliersController extends AppController {

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
	public function add() {
		if ($this->request->is('post')) {
			$this->Supplier->create();
			if($this->request->data["Type"]["Type"]!=""){
				if ($this->Supplier->save($this->request->data)) {
					$this->Session->setFlash(__('The supplier has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The supplier could not be saved. Please, try again.'));
				}
			}else {
			$this->Session->setFlash(__('No se especificó el tipo.'));
			}
		}		
		$categories = $this->Supplier->Category->find('list');		
		$types = $this->Supplier->Type->find('list');
		$this->set(compact('categories',  'types'));
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
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Supplier->save($this->request->data)) {
				$this->Session->setFlash(__('The supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
			$this->request->data = $this->Supplier->find('first', $options);
		}
		$categories = $this->Supplier->Category->find('list');
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
	}}
