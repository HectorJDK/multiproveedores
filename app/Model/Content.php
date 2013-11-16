<?php
App::uses('AppModel', 'Model');
/**
 * Content Model
 *
 * @property Request $Request
 */
class Content extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'comment';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'xml' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'comment' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Request' => array(
			'className' => 'Request',
			'foreignKey' => 'content_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	//Funciones extras de guardado
	public function new_xml($xml)
	{
		$xmlDoc = new DOMDocument('1.0');
		$xmlDoc->formatOutput = true;

		//Elemento raiz
		$root = $xmlDoc->createElement('Request');
		$root = $xmlDoc->appendChild($root);

		//Elemento cliente
		$customer = $xmlDoc->createElement('Customer');
		$customer = $root->appendChild($customer);

		//Elemento producto
		$product = $xmlDoc->createElement('Product');
		$product = $root->appendChild($product);


		//Iterar y agregar los campos
		foreach ($xml as $campos => $value) {
			$tipo = substr($campos, 0, 2);
			$campo = substr($campos, 3);
			switch($tipo){

				//Campo de cliente
				case "cl":
				$campo = $xmlDoc->createElement($campo);
				$campo = $customer->appendChild($campo);
				$valor = $xmlDoc->createTextNode($value);
				$valor = $campo->appendChild($valor);
				break;

				//Campo de producto
				case "pd":
				$campo = $xmlDoc->createElement($campo);
				$campo = $product->appendChild($campo);
				$valor = $xmlDoc->createTextNode($value);
				$valor = $campo->appendChild($valor);
				break;
			}
		}
		$xml =  $xmlDoc->saveXML();
		return $xml;
	}

}
