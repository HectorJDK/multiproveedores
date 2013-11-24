<?php
App::uses('AppController', 'Controller');
App::uses('ProductSearch', 'Lib');
App::uses('ProductSearchQueries', 'Lib');
App::uses('AttributesProduct', 'Model');
App::uses('ProductsSupplier', 'Model');
App::uses('Equivalency', 'Model');

/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {
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
	$this->Product->recursive = 0;
	$this->set('products', $this->Paginator->paginate());
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	if (!$this->Product->exists($id)) {
		throw new NotFoundException(__('Invalid product'));
	}
	$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
	$this->set('product', $this->Product->find('first', $options));	
}

/**
 * add method
 *
 * @return void
 */
public function add() 
{
	if ($this->request->is('post'))
	{
		$transaction = $this->Product->getDataSource();	
		$transaction->begin();
		$failure = false;

		//Obtenemos datos del producto
		$product = $this->request->data["Product"];

		//Decodificamos los datos de los atributos y los eliminamos
		$attributes = json_decode($this->request->data["Attributes"]["attributes_values"]);

		//Obtenemos los datos de los proveedores y lo eliminamos
		$suppliers = $this->request->data["Supplier"];

		//Obtenemos los datos para guardar en las equivalencias
		//Pendiente

		//Primer fase transaccion
		$this->Product->create(); 

		//Creacion del producto
		if ($this->Product->save($product))
		// if (false)
		{
			if(is_null($attributes) || count($attributes) == 0)
			{
				$this->Session->setFlash(__('No puedes crear tipos sin atributos.'));
				$failure = true;
			}
			else
			{
				foreach ($attributes as $attribute) 
				{	
					//Formato para guardar los datos
					$formatSave=array("AttributesProduct"=>array('product_id' => $this->Product->getInsertID(), 
						'attribute_id' => $attribute->attribute_id, 'value' => $attribute->value));

					//Creacion del modelo para guardar en la tabla correspondiente
					$AttributesProduct = new AttributesProduct();
					$AttributesProduct->create();
					if(!$AttributesProduct->save($formatSave['AttributesProduct']))
					{
						$transaction->rollback();
						$this->Session->setFlash(__('The type could not be saved. Please, try again.'));
						$failure = true;
						break;
					}
				}

				if(!$failure) 
				{
					//Formato para guardar los datos
					$suppliers['product_id'] = $this->Product->getInsertID();

					//Creacion del modelo para guardar en la tabla correspondiente
					$ProductsSupplier = new ProductsSupplier();
					$ProductsSupplier->create();

					if(!$ProductsSupplier->save($suppliers))
					{
						$transaction->rollback();
						$this->Session->setFlash(__('The type could not be saved. Please, try again. 1'));
						$failure = true;
					}
				}

				if(!$failure) 
				{	
					$equivalencies['original_id'] = $this->Product->getInsertID();
					$equivalencies['equivalent_id'] = $this->Product->getInsertID();

					$Equivalency = new Equivalency();
					$Equivalency->create();

					//Creamos el prodcuto 
					if (!$Equivalency->save($equivalencies))
					{
						$transaction->rollback();
						$this->Session->setFlash(__('The type could not be saved. Please, try again. Equivalencias'));
						$failure = true;
					}
				}
			}
		}
		else
		{
			$transaction->rollback();
			$failure = true;
			$this->Session->setFlash(__('The product could not be saved. Please, try again. 2'));
		}

		if(!$failure)
		{
			$transaction->commit();
			$this->Session->setFlash(__('The product has been saved.'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	//Datos que se pasan a la vista
	$types = $this->Product->Type->find('list');
	$attributes = $this->Product->Attribute->find('list');
	$suppliers = $this->Product->Supplier->find('list');
	$this->set(compact('types', 'attributes', 'suppliers'));
}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$categories = $this->Product->Category->find('list');
		$types = $this->Product->Type->find('list');
		$attributes = $this->Product->Attribute->find('list');
		$suppliers = $this->Product->Supplier->find('list');
		$this->set(compact('categories', 'types', 'attributes', 'suppliers'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


											// SEARCHS!!!
	/**
	 * newOnlineRequest method
	 *
	 * @return void
	 */
	public function search_by_attributes()
	{        
		$product_description = $this->request->data;

		$productSearch = new ProductSearch(
			$product_description[0],
			$product_description[1],
			$product_description[2]
			);
		$result = $this->Product->search_by_attributes($productSearch);

		$this->set(compact('result'));
	}
/**
	 * asignarEquivalencias method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function asignarEquivalencias($id = null, $idequiv = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($idequiv != null) {			
			//Asignar equivalencias
			$equivalencies['original_id'] = $id;
			$equivalencies['equivalent_id'] = $idequiv;

			$Equivalency = new Equivalency();
			$Equivalency->create();

			//Creamos el prodcuto 
			if ($Equivalency->save($equivalencies)){		
				$this->Session->setFlash(__('Se guardaron las equivalencias.'));
				return $this->redirect(array('action' => 'asignarEquivalencias/'.$id));
			} else {
				$this->Session->setFlash(__('Hubo un problema al guardar las equivalencias'));
			}
		} else {
			//Generar lista de productos
			//Producto original
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
			//Productos equivalentes (para no reasignar)
			$Equivalency = new Equivalency();
			$equivalencias = $Equivalency->find('all',array(
        		'conditions' => array('Equivalency.original_id' => $id)));
			//ids
			$idequivalencias = array();
			foreach($equivalencias as $equivalencia){
				array_push($idequivalencias,$equivalencia['Equivalency']['equivalent_id']); 
			}
			$this->set('equivalencias', $idequivalencias);
			$this->Product->recursive = 0;			
			$this->set('products', $this->Paginator->paginate());		
		}
		
		$types = $this->Product->Type->find('list');
		$attributes = $this->Product->Attribute->find('list');
		$suppliers = $this->Product->Supplier->find('list');
		$this->set(compact('categories', 'types', 'attributes', 'suppliers'));
	}
}