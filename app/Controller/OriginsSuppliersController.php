<?php
App::uses('AppController', 'Controller');
/**
 * OriginsSuppliers Controller
 *
 * @property OriginsSupplier $OriginsSupplier
 * @property PaginatorComponent $Paginator
 */
class OriginsSuppliersController extends AppController {

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
		$this->OriginsSupplier->recursive = 0;
		$this->set('categoriesSuppliers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OriginsSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid categories supplier'));
		}
		$options = array('conditions' => array('OriginsSupplier.' . $this->OriginsSupplier->primaryKey => $id));
		$this->set('categoriesSupplier', $this->OriginsSupplier->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OriginsSupplier->create();
			if ($this->OriginsSupplier->save($this->request->data)) {
				$this->Session->setFlash(__('The categories supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categories supplier could not be saved. Please, try again.'));
			}
		}
		$categories = $this->OriginsSupplier->Category->find('list');
		$suppliers = $this->OriginsSupplier->Supplier->find('list');
		$this->set(compact('categories', 'suppliers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->OriginsSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid categories supplier'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OriginsSupplier->save($this->request->data)) {
				$this->Session->setFlash(__('The categories supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categories supplier could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OriginsSupplier.' . $this->OriginsSupplier->primaryKey => $id));
			$this->request->data = $this->OriginsSupplier->find('first', $options);
		}
		$categories = $this->OriginsSupplier->Category->find('list');
		$suppliers = $this->OriginsSupplier->Supplier->find('list');
		$this->set(compact('categories', 'suppliers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->OriginsSupplier->id = $id;
		if (!$this->OriginsSupplier->exists()) {
			throw new NotFoundException(__('Invalid categories supplier'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OriginsSupplier->delete()) {
			$this->Session->setFlash(__('The categories supplier has been deleted.'));
		} else {
			$this->Session->setFlash(__('The categories supplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
