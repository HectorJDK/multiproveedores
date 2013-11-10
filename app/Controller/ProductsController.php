<?php
App::uses('AppController', 'Controller');
App::uses('ProductSearch', 'Lib');
App::uses('ProductSearchQueries', 'Lib');
App::uses('AttributesProduct', 'Model');
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
                $this->Product->recursive = 2;
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
        public function add() {
             if ($this->request->is('post')) {  
			$transaction = $this->Product->getDataSource();
			$transaction->begin();
			$failure = false;

			//Obtenemos datos
			$infoProduct = array();                     
			$infoProduct = $this->request->data; 
			$infoAttributes = json_decode($infoProduct["Product"]["attributes_values"]);                                        
			unset($infoProduct["Product"]["attributes_values"]);                    
			//Primer fase transaccion
			$this->Product->create(); 
			if ($this->Product->save($infoProduct))
			{
				if(is_null($infoAttributes) || count($infoAttributes) == 0){
					$this->Session->setFlash(__('No puedes crear tipos sin atributos.'));
					$failure = true;
				}
				else
				{
					foreach ($infoAttributes as $attribute) {
						$formatSave=array("AttributesProduct"=>array('product_id' => $this->Product->id,
							'attribute_id' => $attribute->attribute_id, 'value' => $attribute->value));

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
				}
			}
			else
			{
				$transaction->rollback();
				$failure = true;
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));                
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

    public function search_suppliers_for_products()
    {
            $this->autoRender = false;
            $products = $this->request->data;
            $result = $this->Product->search_suppliers_for_products($products);
            echo json_encode($result);
    }

}