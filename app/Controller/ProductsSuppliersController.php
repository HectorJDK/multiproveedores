<?php
App::uses('AppController', 'Controller');
App::uses('Catalog', 'Lib');
App::uses('CatalogItem', 'Lib');
/**
 * ProductsSuppliers Controller
 *
 * @property ProductsSupplier $ProductsSupplier
 * @property PaginatorComponent $Paginator
 */
class ProductsSuppliersController extends AppController {

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
		$this->ProductsSupplier->recursive = 0;
		$this->set('productsSuppliers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null)
    {
		if (!$this->ProductsSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid products supplier'));
		}
		$options = array('conditions' => array('ProductsSupplier.' . $this->ProductsSupplier->primaryKey => $id));
		$this->set('productsSupplier', $this->ProductsSupplier->find('first', $options));
	}

    public function update_price_by_quote($quote, $supplier)
    {
        $product_supplier = $this->ProductsSupplier->find(
            'first',
            array('conditions'=>array(
                'supplier_id'=>$supplier['id'],
                'product_id'=>$quote['product_id']
            )));
        if(count($product_supplier) == 0)
        {
            $this->ProductsSupplier->create();
            $product_supplier = array(
                'supplier_id'=>$supplier['id'],
                'product_id'=>$quote['product_id'],
                'price'=>$quote['unitary_price']
            );
            $this->ProductsSupplier->save($product_supplier);
        }else
        {
            $product_supplier = $product_supplier['ProductsSupplier'];
            $product_supplier['price'] = $quote['unitary_price'];
            $this->ProductsSupplier->save($product_supplier);
        }
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductsSupplier->create();
			if ($this->ProductsSupplier->save($this->request->data)) {
				$this->Session->setFlash(__('The products supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products supplier could not be saved. Please, try again.'));
			}
		}
		$suppliers = $this->ProductsSupplier->Supplier->find('list');
		$products = $this->ProductsSupplier->Product->find('list');
		$this->set(compact('suppliers', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductsSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid products supplier'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductsSupplier->save($this->request->data)) {
				$this->Session->setFlash(__('The products supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The products supplier could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProductsSupplier.' . $this->ProductsSupplier->primaryKey => $id));
			$this->request->data = $this->ProductsSupplier->find('first', $options);
		}
		$suppliers = $this->ProductsSupplier->Supplier->find('list');
		$products = $this->ProductsSupplier->Product->find('list');
		$this->set(compact('suppliers', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null)
    {
		$this->ProductsSupplier->id = $id;
		if (!$this->ProductsSupplier->exists()) {
			throw new NotFoundException(__('Invalid products supplier'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductsSupplier->delete()) {
			$this->Session->setFlash(__('The products supplier has been deleted.'));
		} else {
			$this->Session->setFlash(__('The products supplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function ensure_that_supplier_supplies_product_by_manufacturer_id()
    {
        $this->autoRender = false;

        $supplier_id = $this->request->data['supplier_id'];
        $manufacturer_id = $this->request->data['product_id'];
        $price = $this->request->data['price'];

        $products = $this->ProductsSupplier->Product->find('first', array('conditions' => array('manufacturer_id' => $manufacturer_id)));

        return $this->ensure_that_supplier_supplies_product($supplier_id, $products['Product']['id'], $price);
    }

    public function ensure_that_supplier_supplies_product($supplier_id, $product_id, $price)
    {
        $this->autoLayout = false;
        $this->autoRender = false;

        if(is_null($price))
        {
            throw new InternalErrorException("No se especificó un precio!");
        }

        $relation = array(
            'supplier_id' => $supplier_id,
            'product_id' => $product_id
        );
        $result = $this->ProductsSupplier->find(
            'all',
            array('conditions' => $relation)
        );
        $relation['price'] = $price;
        if (count($result) == 0)
        {
            $this->ProductsSupplier->save($relation);
        }
        else
        {
            $result[0]['ProductsSupplier']['price'] = $price;
            $this->ProductsSupplier->save($result[0]);
        }
    }

    public function catalog($supplier_id)
    {
        $this->ProductsSupplier->recursive = -1;
        $supplier = $this->ProductsSupplier->Supplier->findById($supplier_id);
        $catalog_items = $this->get_catalog_items_for_supplier($this, $supplier_id);
        $catalog = new Catalog($supplier['Supplier'], $catalog_items);
        $this->set(compact('catalog'));
    }

    private function get_catalog_items_for_supplier($controller, $supplier_id)
    {
        $controller->Paginator->settings = array(
            'limit' => 20,
            'recursive'=>0,
            'conditions' => array('supplier_id' => $supplier_id, 'deleted_product' => false)
        );
        $query_result = $controller->Paginator->paginate($controller->ProductsSupplier);
        $result = array();
        foreach ($query_result as $item)
        {
            array_push($result,
                new CatalogItem(
                    $item['ProductsSupplier']['id'],
                    $item['Product'],
                    $item['ProductsSupplier']['price'],
                    $item['ProductsSupplier']['modified']
                )
            );
        }
        return $result;
    }

    public function remove_product_from_supplier()
    {
        $this->autoRender = false;
        $product_id = $this->request->data['product_id'];
        $supplier_id = $this->request->data['supplier_id'];
        $this->ProductsSupplier->deleteAll(array(
            'supplier_id' => $supplier_id,
            'product_id' => $product_id
        ));
    }
}
