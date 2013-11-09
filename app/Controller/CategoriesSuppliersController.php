<?php
App::uses('AppController', 'Controller');
/**
 * CategoriesSuppliers Controller
 *
 * @property CategoriesSupplier $CategoriesSupplier
 * @property PaginatorComponent $Paginator
 */
class CategoriesSuppliersController extends AppController {

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
		$this->CategoriesSupplier->recursive = 0;
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
		if (!$this->CategoriesSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid categories supplier'));
		}
		$options = array('conditions' => array('CategoriesSupplier.' . $this->CategoriesSupplier->primaryKey => $id));
		$this->set('categoriesSupplier', $this->CategoriesSupplier->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CategoriesSupplier->create();
			if ($this->CategoriesSupplier->save($this->request->data)) {
				$this->Session->setFlash(__('The categories supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categories supplier could not be saved. Please, try again.'));
			}
		}
		$categories = $this->CategoriesSupplier->Category->find('list');
		$suppliers = $this->CategoriesSupplier->Supplier->find('list');
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
		if (!$this->CategoriesSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid categories supplier'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CategoriesSupplier->save($this->request->data)) {
				$this->Session->setFlash(__('The categories supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categories supplier could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CategoriesSupplier.' . $this->CategoriesSupplier->primaryKey => $id));
			$this->request->data = $this->CategoriesSupplier->find('first', $options);
		}
		$categories = $this->CategoriesSupplier->Category->find('list');
		$suppliers = $this->CategoriesSupplier->Supplier->find('list');
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
		$this->CategoriesSupplier->id = $id;
		if (!$this->CategoriesSupplier->exists()) {
			throw new NotFoundException(__('Invalid categories supplier'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CategoriesSupplier->delete()) {
			$this->Session->setFlash(__('The categories supplier has been deleted.'));
		} else {
			$this->Session->setFlash(__('The categories supplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
