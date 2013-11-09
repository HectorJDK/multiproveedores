<?php
App::uses('AppController', 'Controller');
/**
 * SuppliersTypes Controller
 *
 * @property SuppliersType $SuppliersType
 * @property PaginatorComponent $Paginator
 */
class SuppliersTypesController extends AppController {

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
		$this->SuppliersType->recursive = 0;
		$this->set('suppliersTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SuppliersType->exists($id)) {
			throw new NotFoundException(__('Invalid suppliers type'));
		}
		$options = array('conditions' => array('SuppliersType.' . $this->SuppliersType->primaryKey => $id));
		$this->set('suppliersType', $this->SuppliersType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SuppliersType->create();
			if ($this->SuppliersType->save($this->request->data)) {
				$this->Session->setFlash(__('The suppliers type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The suppliers type could not be saved. Please, try again.'));
			}
		}
		$types = $this->SuppliersType->Type->find('list');
		$suppliers = $this->SuppliersType->Supplier->find('list');
		$this->set(compact('types', 'suppliers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SuppliersType->exists($id)) {
			throw new NotFoundException(__('Invalid suppliers type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SuppliersType->save($this->request->data)) {
				$this->Session->setFlash(__('The suppliers type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The suppliers type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SuppliersType.' . $this->SuppliersType->primaryKey => $id));
			$this->request->data = $this->SuppliersType->find('first', $options);
		}
		$types = $this->SuppliersType->Type->find('list');
		$suppliers = $this->SuppliersType->Supplier->find('list');
		$this->set(compact('types', 'suppliers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SuppliersType->id = $id;
		if (!$this->SuppliersType->exists()) {
			throw new NotFoundException(__('Invalid suppliers type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SuppliersType->delete()) {
			$this->Session->setFlash(__('The suppliers type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The suppliers type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
