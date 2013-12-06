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
	public $components = array('Paginator', 'RequestHandler');

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
	}

    public function suppliersTypes($id)
    {
        $this->SuppliersType->Supplier->id = $id;
        if (!$this->SuppliersType->Supplier->exists())
        {
            throw new NotFoundException('No se encontró el proveedor.');
        }
        $this->SuppliersType->Supplier->recursive = -1;
        $supplier = $this->SuppliersType->Supplier->find('first', array('conditions' => array('id' => $id)));
        $this->SuppliersType->Behaviors->load('Containable');

        $this->Paginator->settings = array(
            'conditions' => array('supplier_id' => $id),
            'contain' => array('Type')

        );
        $types = $this->Paginator->paginate();
        $this->SuppliersType->Behaviors->unload('Containable');
        $this->set(compact('types', 'supplier'));
    }

    public function ensure_that_supplier_supplies_type()
    {
        $this->autoRender = false;

        $supplier_id = $this->request->data['supplier_id'];
        $type_name = $this->request->data['type_name'];
        $type = $this->SuppliersType->Type->find('first', array('conditions' => array('type_name' => $type_name)));

        $relation = $this->SuppliersType->find('first', array('conditions' => array('supplier_id' => $supplier_id, 'type_id' => $type['Type']['id'])));
        if(count($relation) == 0)
        {
            $relation = array('supplier_id' => $supplier_id, 'type_id' => $type['Type']['id']);
            $this->SuppliersType->save($relation);
        }
    }

    public function remove_type_from_supplier()
    {
        $this->autoRender = false;
        $supplier_id = $this->request->data['supplier_id'];
        $type_id = $this->request->data['type_id'];
        $this->SuppliersType->deleteAll(array('supplier_id' => $supplier_id, 'type_id' => $type_id));
    }

}
