<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses( 'EmailConfig', 'Model');
App::uses( 'Order', 'Model');
/**
 * Quotes Controller
 *
 * @property Quote $Quote
 * @property PaginatorComponent $Paginator
 */
class QuotesController extends AppController {

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
            'limit' => 1,
            'recursive'=>2,
            'conditions' => array('Request.deleted' => 0)
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


public function process_quote()
{
    $quotes = $this->request->data;
    foreach ($quotes as $id => $value)
    {
        if($value == 1)
        {
            aceptar($id);
        }
    }

}

    public function reject($id)
    {

    }

	/**
 * procesar method
 *
 * @return void
 */
	public function accept($id)
    {
		$this->Quote->id = $id;		
		if (!$this->Quote->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->Quote->saveField('deleted', '1')) {

			//Crear una orden nueva
			$this->Order = new Order();
			$this->Order->user_id = $this->Quote->user_id;
			$this->Order->quote_id = $this->Quote->id;
			$this->Order->state_id = 1;
			$this->Order->quantity = $quantity;
			
			print_r((array) $this->Order);
			$this->Session->setFlash(__('The quote has been processed.'));
		} else {
			$this->Session->setFlash(__('The quote could not be processed. Please, try again.'));
		}
		/*
		$this->Order->create();
		if ($this->Order->save($this->request->data)) {
			$this->Session->setFlash(__('The order has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
		}
	*/			
	}
}
