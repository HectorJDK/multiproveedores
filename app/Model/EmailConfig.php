<?php
App::uses('AppModel', 'Model');

/**
 * DataType Model
 *
 * @property Attribute $Attribute
 */
class EmailConfig extends AppModel {

   protected $_schema = array(
        'host' => array('type' => 'string' , 'null' => false, 'default' => ''),
        'port' => array('type' => 'number' , 'null' => false, 'default' => '' ),
        'username' => array('type' => 'string' , 'null' => false, 'default' => ''),
        'password' => array('type' => 'text' , 'null' => false, 'default' => ''),
        'transport' => array('type' => 'string' , 'null' => false, 'default' => ''),
    );
 
    public $useTable = false;
 
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		
	);

	public function cargarConfiguracion(){
		$xml = Xml::build('../Config/emailConfig.xml');
		$xmlArray = Xml::toArray($xml);
		return $xmlArray["EmailConfig"];		
}
}
