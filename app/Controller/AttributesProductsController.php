<?php
App::uses('AppController', 'Controller');
/**
 * AttributesProducts Controller
 *
 * @property AttributesProduct $AttributesProduct
 * @property PaginatorComponent $Paginator
 */
class AttributesProductsController extends AppController {

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
		$this->AttributesProduct->recursive = 0;
		$this->set('attributesProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AttributesProduct->exists($id)) {
			throw new NotFoundException(__('Invalid attributes product'));
		}
		$options = array('conditions' => array('AttributesProduct.' . $this->AttributesProduct->primaryKey => $id));
		$this->set('attributesProduct', $this->AttributesProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AttributesProduct->create();
			if ($this->AttributesProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The attributes product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attributes product could not be saved. Please, try again.'));
			}
		}
		$products = $this->AttributesProduct->Product->find('list');
		$attributes = $this->AttributesProduct->Attribute->find('list');
		$this->set(compact('products', 'attributes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AttributesProduct->exists($id)) {
			throw new NotFoundException(__('Invalid attributes product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AttributesProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The attributes product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attributes product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AttributesProduct.' . $this->AttributesProduct->primaryKey => $id));
			$this->request->data = $this->AttributesProduct->find('first', $options);
		}
		$products = $this->AttributesProduct->Product->find('list');
		$attributes = $this->AttributesProduct->Attribute->find('list');
		$this->set(compact('products', 'attributes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AttributesProduct->id = $id;
		if (!$this->AttributesProduct->exists()) {
			throw new NotFoundException(__('Invalid attributes product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AttributesProduct->delete()) {
			$this->Session->setFlash(__('The attributes product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The attributes product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
