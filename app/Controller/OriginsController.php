<?php
App::uses('AppController', 'Controller');
/**
 * Origins Controller
 *
 * @property Origin $Origin
 * @property PaginatorComponent $Paginator
 */
class OriginsController extends AppController {

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
		$this->Origin->recursive = 0;
		$this->set('origins', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Origin->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Origin.' . $this->Origin->primaryKey => $id));
		$this->set('category', $this->Origin->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Origin->create();
			if ($this->Origin->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
		$suppliers = $this->Origin->Supplier->find('list');
		$this->set(compact('suppliers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Origin->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Origin->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Origin.' . $this->Origin->primaryKey => $id));
			$this->request->data = $this->Origin->find('first', $options);
		}
		$suppliers = $this->Origin->Supplier->find('list');
		$this->set(compact('suppliers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Origin->id = $id;
		if (!$this->Origin->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Origin->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function categories_for_selector()
	{
		$origins = $this->Origin->find('all');
		$originsForSelector = array();
		foreach ($origins as $category)
		{
			$originsForSelector[$category['Origin']['id']] = $category['Origin']['url'];
		}
		return $originsForSelector;
	}
}