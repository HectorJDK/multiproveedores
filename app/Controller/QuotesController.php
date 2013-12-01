<?php
App::uses('AppController', 'Controller');
App::uses('ProductsSuppliersController', 'Controller');
App::uses('OrdersController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses( 'EmailConfig', 'Model');
App::uses( 'Order', 'Model');
/**
 * Quotes Controller
 *
 * @property Quote $Quote
 * @property PaginatorComponent $Paginator
 */
class QuotesController extends AppController
{

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
public function index()
{
	$userId = $this->Auth->user('id');

    $this->Paginator->settings = array(
        'conditions' => array(
            'Request.deleted' => 0,
            'Request.user_id' => $userId,
            'Request.quote_count >' => 0
        ),
        'limit' => 1,
        'recursive'=>2
    );
    $requests = $this->Paginator->paginate($this->Quote->Request);




	$this->set('requests', $requests);
}


    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Quote->id = $id;
        if (!$this->Quote->exists()) {
            throw new NotFoundException(__('Invalid quote'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Quote->delete()) {
            $this->Session->setFlash(__('The quote has been deleted.'));
        } else {
            $this->Session->setFlash(__('The quote could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function processQuotes()
    {

        $transaction = $this->Quote->getDataSource();
        $transaction->begin();

         $this->Quote->recursive = 0;

        //Marcar el request como deleted
        $request_id = $this->request->data['request_id'];
        $this->Quote->Request->id = $request_id;
        $this->Quote->Request->saveField('deleted', '1');

        $quotes = $this->request->data['quotes'];

        //Asignar status y procesar quotes
        $accepted_quotes = 0;
        $accepted_quote = null;
        foreach ($quotes as $id => $value)
        {
            $quote_query = $this->Quote->findById($id);
            $quote_query['Quote']['status_quote_id'] = $value;
            $quote_query['Quote']['deleted'] = 1;
            $this->Quote->save($quote_query['Quote']);
            if($value == 1)
            {
                $accepted_quotes ++;
                $accepted_quote = $quote_query;
            }
            else
            {
                $this->reject($quote_query);
            }
        }

        if($accepted_quotes > 1)
        {
            $this->Session->setFlash(__('Se debe de aceptar máximo 1 cotización.'));
            $transaction->rollback();
            return $this->redirect(array('controller'=>'quotes', 'action' => 'index'));
        }else
        {
            if($accepted_quotes == 1)
            {
                $this->accept($accepted_quote);
            }
            $transaction->commit();
        }
    }

    private function accept($quote_query)
    {
        //incrementar accepted_quotes
        $supplier = $quote_query['Supplier'];
        $supplier['accepted_quotes']++;
        $this->Quote->Supplier->save($supplier);

        //crear orden
        $orderController = new OrdersController();
        $orderController->create_order_for_quote($quote_query['Quote'], $quote_query['Supplier'], $quote_query['Request']);

        //actualizal precio
        $product_supplier_controller = new ProductsSuppliersController();
        $product_supplier_controller->update_price_by_quote($quote_query['Quote'], $quote_query['Supplier']);

    }

    private function reject($quote_query)
    {
        //incrementar rejected_quotes
        $supplier = $quote_query['Supplier'];
        $supplier['rejected_quotes']++;
        $this->Quote->Supplier->save($supplier);

        //actualizar precio
        $product_supplier_controller = new ProductsSuppliersController();
        $product_supplier_controller->update_price_by_quote($quote_query['Quote'], $quote_query['Supplier']);
    }

}
