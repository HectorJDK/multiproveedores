<?php
class AttributeServicesController extends AppController {
	public $uses = array('Attributes');
	public $components = array('RequestHandler');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('attributes_for_type_id');
	}

	public function attributes_for_type_id($id)
	{
		$this->autoRender = false;
		echo json_encode($this->Attributes->find('all', array('conditions' => array('type_id' => $id))));

	}
}