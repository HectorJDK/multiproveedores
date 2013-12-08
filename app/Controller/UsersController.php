<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function beforeFilter() {
	parent::beforeFilter();
	$this->Auth->allow('add'); // Letting users register themselves
}

public function login() {
	if ($this->request->is('post')) {
		//Entramos con configuracion inicial
		if ($this->Auth->login()) {
			if ($this->Auth->user['deleted'] != 1)
			{
				return $this->redirect($this->Auth->redirect());
			}
			else
			{
				$this->Session->setFlash(__('Usuario eliminado, pongase en contacto con el administrador'));
				return $this->redirect($this->Auth->logout());
			}
				
		}
		// print_r($this->Auth->_authenticateObjects['0']->helpers);
		print_r($this->Auth->user());
		$this->Session->setFlash(__('El nombre de usuario o la contraseña son invalidos.'));
	}
}

public function logout() {
	$this->Session->setFlash(__('Se ha cerrado la sesión'));
	return $this->redirect($this->Auth->logout());
}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$users = $this->Paginator->paginate(array('deleted' => false));
		$this->set('users', $users);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario inválido.'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('El usuario ha sido registrado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El usuario no se pudo registrar.'));
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
	public function edit($id = null)
	{
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('El usuario ha sido actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El usuario no se pudo actualizar.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('El usuario ha sido eliminado.'));
		} else {
			$this->Session->setFlash(__('El usuario no se pudo eliminar.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * Virtual delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function virtualDelete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('El usuario no existe'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->saveField('deleted', '1')) {
			$this->Session->setFlash(__('El usuario ha sido dado de baja.'));
		} else {
			$this->Session->setFlash(__('El usuario no se pudo dar de baja.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}