<?php
App::uses('AppController', 'Controller');
/**
 * Equivalencies Controller
 *
 * @property Equivalency $Equivalency
 * @property PaginatorComponent $Paginator
 */
class EquivalenciesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array();

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public $uses = array('Product', 'Equivalency');
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Equivalency->recursive = 0;
        $equivalencies = $this->Paginator->paginate();
        $this->set('equivalencies', $equivalencies);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Equivalency->exists($id)) {
            throw new NotFoundException(__('Invalid equivalency'));
        }
        $options = array('conditions' => array('Equivalency.' . $this->Equivalency->primaryKey => $id));
        $this->set('equivalency', $this->Equivalency->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Equivalency->create();
            if ($this->Equivalency->save($this->request->data)) {
                $this->Session->setFlash(__('The equivalency has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The equivalency could not be saved. Please, try again.'));
            }
        }
        $this->Product->recursive = 1;
        $originals = $this->Product->find('list');
        $equivalents = $this->Product->find('list');
        $this->set(compact('originals', 'equivalents'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Equivalency->exists($id)) {
            throw new NotFoundException(__('Invalid equivalency'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Equivalency->save($this->request->data)) {
                $this->Session->setFlash(__('The equivalency has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The equivalency could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Equivalency.' . $this->Equivalency->primaryKey => $id));
            $this->request->data = $this->Equivalency->find('first', $options);
        }
        $originals = $this->Equivalency->Original->find('list');
        $equivalents = $this->Equivalency->Equivalent->find('list');
        $this->set(compact('originals', 'equivalents'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Equivalency->id = $id;
        if (!$this->Equivalency->exists()) {
            throw new NotFoundException(__('Invalid equivalency'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Equivalency->delete()) {
            $this->Session->setFlash(__('The equivalency has been deleted.'));
        } else {
            $this->Session->setFlash(__('The equivalency could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }}
