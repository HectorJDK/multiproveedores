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
    $origins = $this->Paginator->paginate(array('Origin.deleted' => 0));
	$this->set('origins', $origins);
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
	$this->set('origin', $this->Origin->find('first', $options));
}

/**
 * add method
 *
 * @return void
 */
public function add() {
    //Solo se aceptaran funciones que se hayan dado por post
	if ($this->request->is('post')) {
        //Preparamos la insercion en la base de datos
		$this->Origin->create();
        //Obtenemos la informacion y la guardamos en lowercaset
		$data = $this->request->data['Origin'];
		$data['url'] = strtolower($data['url']);

        //Limitamos la busqueda a solo los datos que nos interesan
        $this->Origin->recursive = -1;
		$error = $this->Origin->find('first', array('conditions' => array('Origin.deleted' => 0, 'Origin.url' => $data['url'])));

		if (!isset($error['Origin']))
        {
			if ($this->Origin->save($data))
            {
				$this->Session->setFlash(__('Origen correctamente guardado'));
				return $this->redirect(array('action' => 'index'));
			}
            else
            {
				$this->Session->setFlash(__('El origen no ha podido guardarse. Intente Nuevamente'));
			}
		}
        else
        {
            $this->Session->setFlash(__('El Origen ya ha sido creado anteriormente'));
        }
	}
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
		$this->Origin->id=$id;
		if ($this->Origin->save($this->request->data)) {
			$this->Session->setFlash(__('El origen se ha actualizado.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('El origen no se pudo actualizar.'));
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
		$this->Session->setFlash(__('El origen ha sido eliminado'));
	} else {
		$this->Session->setFlash(__('El origen no se pudo eliminar.'));
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