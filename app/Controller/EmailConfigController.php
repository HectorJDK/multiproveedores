<?php
App::uses('AppController', 'Controller');
App::uses('Xml', 'Utility');
/**
 * EmailConfig Controller
 *
 * @property EmailConfig $EmailConfig
 * @property PaginatorComponent $Paginator
 */
class EmailConfigController extends AppController {	
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

	$this->edit();
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit() {	
	if ($this->request->is(array('post', 'put'))) {

		$xmlArray = array('EmailConfig' => array(
			'host' => $this->request->data["EmailConfig"]["host"], 
			'port' => $this->request->data["EmailConfig"]["port"],		 
		 	'transport' => $this->request->data["EmailConfig"]["transport"],
		    'username' => $this->request->data["EmailConfig"]["username"], 
			'password' => $this->request->data["EmailConfig"]["password"]));
		$xmlObject = Xml::fromArray($xmlArray, array('format' => 'tags')); // You can use Xml::build() too
		if ($xmlString = $xmlObject->asXML("../Config/emailConfig.xml")){
			$this->Session->setFlash(__('La configuración del correo se ha actualizado'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('La configuración del correo no se pudo actualizar.'));
		}
	} else {
		$xml = Xml::build('../Config/emailConfig.xml');
		$xmlArray = Xml::toArray($xml);		
		$this->request->data = $xmlArray;
	}		
}


}
