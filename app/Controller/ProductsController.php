<?php
App::uses('AppController', 'Controller');
App::uses('ProductSearch', 'Lib');
App::uses('ProductSearchQueries', 'Lib');
App::uses('AttributesProduct', 'Model');
App::uses('ProductsSupplier', 'Model');
App::uses('EquivalencyRelation', 'Model');

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
        $this->Paginator->settings = array('conditions' => array('Product.deleted' => false));
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
        $product = $this->Product->find('first', $options);
        $this->set(compact('product'));
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
                            $this->Session->setFlash(__('El tipo de producto no se pudo registrar.'));
                            $failure = true;
                            break;
                        }
                    }

                    if(!$failure)
                    {
                        $equivalencies['original_id'] = $this->Product->getInsertID();
                        $equivalencies['equivalent_id'] = $this->Product->getInsertID();

                        $Equivalency = new EquivalencyRelation();
                        $Equivalency->create();

                        //Creamos el prodcuto
                        if (!$Equivalency->save($equivalencies))
                        {
                            $transaction->rollback();
                            $this->Session->setFlash(__('El tipo no se pudo asignar. Verifica las equivalencias.'));
                            $failure = true;
                        }
                    }
                }
            }
            else
            {
                $transaction->rollback();
                $failure = true;
                $this->Session->setFlash(__('El producto no se pudo registrar.'));
            }

            if(!$failure)
            {
                $transaction->commit();
                $this->Session->setFlash(__('El producto ha sido registrado.'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        //Datos que se pasan a la vista
        $types = $this->Product->Type->find('list', array('conditions' => array('deleted' => false)));
        $attributes = $this->Product->Attribute->find('list');
        $this->set(compact('types', 'attributes'));
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
            if ($this->Product->update_product($this->request->data)) {
                $this->Session->setFlash('Se actualizó el producto.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Error al actualizar producto.');
            }
        } else {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $product = $this->Product->find('first', $options);
        }
        $this->set(compact('product'));
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
        if ($this->perform_delete($this))
        {
            $this->Session->setFlash(__('El producto ha sido eliminado.'));
        } else {
            $this->Session->setFlash(__('El producto no se pudo eliminar.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    private function perform_delete($controller)
    {
        $transaction = $controller->Product->getDataSource();
        $transaction->begin();

        $controller->Product->saveField('deleted', true);

        //Borrar de products_supplier
        $this->Product->ProductsSupplier->updateAll(
            array('deleted_product' => true),
            array('product_id' => $this->Product->id)
        );

        //Borrar de equivalencias como original
        $this->Product->AsOriginal->updateAll(
            array('deleted_original' => true),
            array('original_id' => $this->Product->id)
        );

        //Borrar de equivalencias como equivalente
        $this->Product->AsEquivalent->updateAll(
            array('deleted_equivalent' => true),
            array('equivalent_id' => $this->Product->id)
        );
        $transaction->commit();
        return true;
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

    public function equivalent_to($id)
    {
        $this->Product->recursive = -1;
        if (!$this->Product->exists($id)) {
            throw new NotFoundException('Producto invalido');
        }
        $equivalent = $this->Product->findById($id);

        $this->Paginator->settings = array(
            'limit' => 20,
            'recursive'=>0,
            'conditions' => array('equivalent_id' => $id, 'original_id !=' => $id, 'deleted_original' => false)
        );
        $equivalency_relations = $this->Paginator->paginate($this->Product->AsEquivalent);
        $this->set(compact('equivalent', 'equivalency_relations'));
    }

    public function has_as_equivalents($id)
    {
        $this->Product->recursive = 1;
        if (!$this->Product->exists($id)) {
            throw new NotFoundException('Producto invalido');
        }
        $original = $this->Product->findById($id);

        $this->Paginator->settings = array(
            'limit' => 20,
            'recursive'=>0,
            'conditions' => array('original_id' => $id, 'equivalent_id !=' => $id, 'deleted_equivalent' => false)
        );
        $equivalency_relations = $this->Paginator->paginate($this->Product->AsOriginal);
        $this->set(compact('original', 'equivalency_relations'));
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
            $this->set('products', $this->Paginator->paginate(array('Product.deleted' => 0)));
        }

        $types = $this->Product->Type->find('list');
        $attributes = $this->Product->Attribute->find('list');
        $suppliers = $this->Product->Supplier->find('list');
        $this->set(compact('categories', 'types', 'attributes', 'suppliers'));
    }
}