<?php
App::uses('AppController', 'Controller');
/**
 * Types Controller
 *
 * @property Type $Type
 * @property PaginatorComponent $Paginator
 */
class TypesController extends AppController {
	public $uses = array('Type', 'DataType');

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
		$this->Type->recursive = 0;
		$this->set('types', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {

		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Invalid type'));
		}
		$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
		$this->set('type', $this->Type->find('first', $options));
		$this->set_attribute_types();
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post'))
		{
            //Obtenemos la informacion del nuevo tipo para agregar
            $type = $this->request->data['Type'];
            $type['type_name'] = ucfirst(strtolower(trim($type['type_name'])));

            //Obtenemos la informacion de los atributos nuevos para agregar
            $attributes = json_decode($this->request->data['Type']['attributes']);

            //Limpiamos informacion inecesaria
            unset($type['attributes']);

            //Buscamos si existe anteriormente
            $conditions = array('Type.deleted' => 0, 'Type.type_name' => $type['type_name']);
            if($this->Type->hasAny($conditions))
            {
                $this->Session->setFlash(__('El Tipo de Producto ha sido agregado anteriormente'));
                return $this->redirect(array('action' => 'add'));
            }

            //Si es el unico empieza la transaccion
			$transaction = $this->Type->getDataSource();
			$transaction->begin();
            $this->Type->create();
			$failure = false;

			if($this->Type->save($type))
			{
				if(is_null($attributes) || count($attributes) == 0){
					$this->Session->setFlash(__('No puedes crear tipos sin atributos.'));
					$failure = true;
				}
				else
				{
					foreach ($attributes as $attribute) {
						$this->Type->Attribute->create();
                        $attribute->type_id = $this->Type->id;
                        $attribute->name =  ucfirst(strtolower(trim($attribute->name)));
						if(!$this->Type->Attribute->save($attribute))
						{
							$transaction->rollback();
							$this->Session->setFlash(__('El tipo de producto no se pudo agregar.'));
							$failure = true;
							break;
						}
					}
				}
			}
			else
			{
				$transaction->rollback();
				$failure = true;
				$this->Session->setFlash(__('El tipo de producto no se pudo agregar.'));		
			}

			if($failure)
			{
				$this->set_attribute_types();
			}
			else
			{
				$transaction->commit();
				$this->Session->setFlash(__('El tipo de producto ha sido agregado.'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		else
		{
			$this->set_attribute_types();
		}	
	}

	private function set_attribute_types()
	{
		$this->DataType->recursive = 0;
		$dataTypes = $this->DataType->find('all');
		$dataTypesForSelect = array();
		foreach ($dataTypes as $data_type)
		{
			$dataTypesForSelect[$data_type['DataType']['id']] = $data_type['DataType']['name'];
		}
		$this->set('data_types', $dataTypesForSelect);
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Invalid type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__('The type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));

			$type = $this->Type->find('first', $options);
			$this->request->data = $type;
			$this->set('type', $type);
			$this->set_attribute_types();
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
		$this->Type->id = $id;
		if (!$this->Type->exists()) {
			throw new NotFoundException(__('Invalid type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Type->delete()) {
			$this->Session->setFlash(__('The type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function types_for_selector()
	{
		$types = $this->Type->find('all');
		$typesForSelector = array();
		foreach ($types as $type)
		{
			$typesForSelector[$type['Type']['id']] = $type['Type']['type_name'];
		}
		return $typesForSelector;
	}

}
