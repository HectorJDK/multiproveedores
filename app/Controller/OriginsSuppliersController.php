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
	}

    public function originsForSupplier($supplier_id)
    {
        $this->OriginsSupplier->recursive = -1;
        $supplier = $this->OriginsSupplier->Supplier->findById($supplier_id);
        $supplier = $supplier['Supplier'];
        $origins = $this->get_origins_for_supplier($this, $supplier_id);
        $all_origins = $this->OriginsSupplier->Origin->find('all');
        $this->set(compact('supplier', 'origins', 'all_origins'));
    }

    private function get_origins_for_supplier($controller, $supplier_id)
    {
        $controller->Paginator->settings = array(
            'limit' => 20,
            'recursive'=>0,
            'conditions' => array('supplier_id' => $supplier_id, 'deleted_origin' => false)
        );
        $results = $controller->Paginator->paginate($controller->OriginsSupplier);
        $formatted_results = array();
        foreach ($results as $result)
        {
            array_push($formatted_results, $result['Origin']);
        }
        return $formatted_results;
    }

    public function addOriginToSupplier($origin_id, $supplier_id)
    {
        $this->autoRender = false;
        $results = $this->OriginsSupplier->find('all',
            array('conditions' =>
                array(
                    'supplier_id' => $supplier_id,
                    'origin_id' => $origin_id
                )
            )
        );
        if(count($results) > 0) return;

        $newRelation['origin_id'] = $origin_id;
        $newRelation['supplier_id'] = $supplier_id;
        $this->OriginsSupplier->save($newRelation);
    }

    public function removeOriginFromSupplier($origin_id, $supplier_id)
    {
        $this->autoRender = false;
        $this->OriginsSupplier->deleteAll(array(
            'supplier_id' => $supplier_id,
            'origin_id' => $origin_id
        ));
    }
}
