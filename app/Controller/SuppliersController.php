<?php
App::uses('AppController', 'Controller');
App::uses('ProductSearch', 'Lib');
App::uses('SupplierResult', 'Lib');
App::uses('PastOrder', 'Lib');

/**
 * Suppliers Controller
 *
 * @property Supplier $Supplier
 * @property PaginatorComponent $Paginator
 */
class SuppliersController extends AppController {
    var $uses = array('Supplier', 'Product');

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
	public function index()
    {
		$this->Supplier->recursive = 0;
        $this->Paginator->settings = array('conditions' => array('deleted' => false));
		$this->set('suppliers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
		$this->set('supplier', $this->Supplier->find('first', $options));
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
            $data = $this->request->data['Supplier'];
            $data['moral_rfc'] = strtoupper($data['moral_rfc']);

            //Limitamos la busqueda a solo los datos que nos interesan
            $this->Supplier->recursive = -1;
            $conditions = array('Supplier.deleted' => 0, 'Supplier.moral_rfc' => $data['moral_rfc']);

            if(!$this->Supplier->hasAny($conditions))
            {
                $this->Supplier->create();

                if ($this->Supplier->save($data))
                {
                    $this->Session->setFlash(__('Proveedor guardado'));
                    return $this->redirect(array('action' => 'index'));
                }
                else
                {
                    $this->Session->setFlash(__('El proveedor no ha podido guardarse. Intente Nuevamente'));
                }

            }
            else
            {
                $this->Session->setFlash(__('El proveedor ya ha sido agregado'));
            }

	    }

		$origins = $this->Supplier->Origin->find('list');
		$types = $this->Supplier->Type->find('list');
		$this->set(compact('origins',  'types'));
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
        $this->Supplier->id = $id;
    
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		if ($this->request->is(array('post', 'put')))
        {
			if ($this->Supplier->save($this->request->data))
            {
				$this->Session->setFlash(__('The supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else
            {
				$this->Session->setFlash(__('The supplier could not be saved. Please, try again.'));
			}
		} else
        {
			$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
            $supplier = $this->Supplier->find('first', $options);
            $this->set('supplier', $supplier);
			$this->request->data = $supplier;
		}
		$categories = $this->Supplier->Origin->find('list');
		$products = $this->Supplier->Product->find('list');
		$types = $this->Supplier->Type->find('list');
		$this->set(compact('categories', 'products', 'types'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Supplier->id = $id;
		if (!$this->Supplier->exists()) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->perform_delete($this))
        {
			$this->Session->setFlash(__('The supplier has been deleted.'));
		} else
        {
			$this->Session->setFlash(__('The supplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    private function perform_delete($controller)
    {
        $transaction = $controller->Supplier->getDataSource();
        $transaction->begin();

        $controller->Supplier->saveField('deleted', true);

        //Borrar de products_supplier
        $this->Supplier->ProductsSupplier->updateAll(
            array('deleted_supplier' => true),
            array('supplier_id' => $this->Supplier->id)
        );

        //Borrar de origins_supplier
        $this->Supplier->OriginsSupplier->updateAll(
            array('deleted_supplier' => true),
            array('supplier_id' => $this->Supplier->id)
        );
        $transaction->commit();
        return true;
    }


    public function suppliers_for_category_product_type()
    {
        $category = $this->request->data['Supplier']['category'];
        $product_type = $this->request->data['Supplier']['type'];
        $request_id = $this->request->data['request_id'];

        /* @var $results SupplierResult[] */
        $results = $this->Supplier->search_by_product_type($category, $product_type);
        $this->set('results', $results);
        $this->set('request_id', $request_id);
    }

    public function suppliers_for_products()
    {
        $products = json_decode($this->request->data['Suppliers']['products_for_suppliers']);
        $request_id = $this->request->data['Suppliers']['request_id'];
        $result = $this->Product->search_suppliers_for_products($products);
        $this->set('suppliers_products', $result);
        $this->set('request_id', $request_id);
    }

    public function increment_accepted_quotes($supplier_id)
    {
        $options = array('conditions' => array('id' => $supplier_id));
        $supplier = $this->Supplier->find('first', $options);

        $accepted_quotes = $supplier['Supplier']['accepted_quotes'] + 1;

        $this->Supplier->id = $supplier_id;
        $this->Supplier->saveField('accepted_quotes', $accepted_quotes);
    }

    public function increment_rejected_quotes($supplier_id, $reason)
    {
        //Limitamos la recursividad de la busqueda
        $this->Supplier->recursive = -1;
        $supplier = $this->Supplier->findById($supplier_id);

        //Eliminamos los datos no deseados para guadar
        $this->Supplier->id = $supplier_id;
        $this->Supplier->set('rejected_quotes', $supplier['Supplier']['rejected_quotes'] + 1);

        //Obtenemos el caso de la perdida de la cotizacion y aumentamos su razon de perdida (otra posible solucion es con counters)
        switch ($reason) {
            case 2:
                $this->Supplier->set('rejected_price', $supplier['Supplier']['rejected_price'] + 1);
                break;

            case 3:
                $this->Supplier->set('rejected_existance', $supplier['Supplier']['rejected_existance'] + 1);
                break;

            case 4:
                $this->Supplier->set('rejected_response', $supplier['Supplier']['rejected_response'] + 1);
                break;

            case 5:
                $this->Supplier->set('rejected_delivery', $supplier['Supplier']['rejected_delivery'] + 1);
                break;
        }

        //Actualizamos, de no ser posible aventamos el error
        if (!$this->Supplier->save())
        {
            throw new InternalErrorException("Error al actualizar la DB");
        }
    }

    public function record($supplier_id)
    {
        $this->Supplier->recursive = -1;
        $payed_orders = $this->get_accepted_orders_for_supplier($this, $supplier_id);
        $supplier = $this->Supplier->findById($supplier_id);
        $supplier = $supplier['Supplier'];
        $this->set(compact('supplier', 'payed_orders'));
    }

    public function get_accepted_orders_for_supplier($controller, $supplier_id)
    {
        $controller->Paginator->settings = array(
            'limit' => 20,
            'recursive' => 1,
            'contain' => 'Order',
            'conditions' => array(
                'supplier_id' => $supplier_id,
                'status_quote_id' => 1,
                'Order.payed' => true,
            )
        );
        $query_result = $controller->Paginator->paginate($controller->Supplier->Quote);
        $result = array();
        foreach ($query_result as $quote)
        {
            array_push($result,
                new PastOrder(
                    $quote['Product'],
                    $quote['Request']['quantity'],
                    $quote['Quote']['unitary_price'],
                    $quote['Quote']['modified'],
                    $quote['Order']['rating']
                )
            );
        }
        return $result;
    }


    /*
    *Actualizar el rating del proveedor en base al numero de ordenes  y el nuevo rating 
    */
    public function update_rating($supplier_id, $rating){
        if (!$this->Supplier->exists($supplier_id)) {
            throw new NotFoundException(__('El proveedor no existe'));
        }
        $this->Supplier->recursive = 2;
        $supplier = $this->Supplier->findById($supplier_id);
        //Contar el numero de ordenes del proveedor
        $contOrdenes = 0;
        foreach ($supplier['Quote'] as $quote){
            if(!empty($quote['Order'])){
                $contOrdenes++;
            }
        }     
        //Actualizar el nuevo rating
        //Nuevo rating = ((cantidad de ordenes * rating actual) + nuevo Rating)/ cantidad de ordenes incrementada
        $supplier['Supplier']['rating'] = (($contOrdenes * $supplier['Supplier']['rating']) + $rating)/($contOrdenes+1);
        
        if ($this->Supplier->save($supplier))
        {
            return 1;
        } 
        else
        {
            return 0;
        }            
    }

}