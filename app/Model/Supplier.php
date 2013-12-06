Su

<?php
App::uses('AppModel', 'Model');
App::uses('SupplierResult', 'Lib');
/**
 * Supplier Model
 *
 * @property Quote $Quote
 * @property Category $origin
 * @property Product $Product
 * @property Type $Type
 */
class Supplier extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'corporate_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),			
		),
		'corporate_name' => array(			
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'moral_rfc' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 14),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'contact_name' => array(			
			'maxLength' => array(
				'rule' => array('maxLength', 60),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'contact_email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 320),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'contact_telephone' => array(
			
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rating' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'accepted_quotes' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rejected_quotes' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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
		'Quote' => array(
			'className' => 'Quote',
			'foreignKey' => 'supplier_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Origin' => array(
			'className' => 'Origin',
			'joinTable' => 'origins_suppliers',
			'foreignKey' => 'supplier_id',
			'associationForeignKey' => 'origin_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'products_suppliers',
			'foreignKey' => 'supplier_id',
			'associationForeignKey' => 'product_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Type' => array(
			'className' => 'Type',
			'joinTable' => 'suppliers_types',
			'foreignKey' => 'supplier_id',
			'associationForeignKey' => 'type_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	public function search_by_product_type($origin, $type)
	{
		$preparation = $this->search_by_product_type_preparation($origin, $type);
		$db = $this->getDataSource();
		$query_result =  $db->fetchAll($preparation['query'], $preparation['values']);
		$result = array();
		foreach ($query_result as $supplier)
		{
			/* @var $result SupplierResult */
			array_push($result, new SupplierResult(
                $supplier[0]['id'],
                $supplier[0]['corporate_name'],
                $supplier[0]['moral_rfc'],
                $supplier[0]['contact_name'],
                $supplier[0]['contact_email'],
                $supplier[0]['contact_telephone'],
                $supplier[0]['rating'],
                $supplier[0]['accepted_quotes'],
                $supplier[0]['rejected_quotes'],
                $supplier[0]['deleted'],
                $supplier[0]['payed'],
                $supplier[0]['debt'],
                $supplier[0]['credit'],
                $supplier[0]['rejected_price'],
                $supplier[0]['rejected_existance'],
                $supplier[0]['rejected_response'],
                $supplier[0]['rejected_delivery']
			));
		}
		return $result;
	}

	public function search_by_product_type_preparation($origin, $type)
	{
		$query = "select s.id as id, s.corporate_name as corporate_name, ";
		$query .= "s.moral_rfc as moral_rfc, s.contact_name as contact_name, ";
		$query .= "s.contact_email as contact_email, s.contact_telephone as contact_telephone, ";
		$query .= "s.rating as rating, s.accepted_quotes as accepted_quotes, ";
		$query .= "s.rejected_quotes as rejected_quotes, s.deleted as deleted, ";
		$query .= "s.payed as payed, s.debt as debt, s.credit as credit, ";
		$query .= "s.rejected_price as rejected_price, s.rejected_existance as rejected_existance, ";
		$query .= "s.rejected_response as rejected_response, s.rejected_delivery as rejected_delivery ";
		$query .= "from suppliers as s ";
		if($origin != '')
		{
			$query .= ", origins_suppliers as os ";
		}
		$query .= "where ";
		$query .= "(";
			$query .= "exists (select * ";
			$query .= "From products_suppliers as ps, products as p ";
			$query .= "Where ";
			$query .= "ps.supplier_id = s.id AND ";
			$query .= "ps.product_id = p.id AND ";
			$query .= "ps.deleted_product = false AND ";  //checar que el producto no esté borrado
			$query .= "ps.deleted_supplier = false AND "; //checar que el supplier no esté borrado
			$query .= "p.type_id = ?";
			$query .= ") ";
		$query .= "OR ";
			$query .= "exists (select * ";
			$query .= "FROM suppliers_types AS st ";
			$query .= "WHERE st.type_id = ? AND ";
			$query .= "st.supplier_id = s.id ";
			$query .= ") ";
		$query .= ")";

		if($origin != '')
		{
			$query .= "AND ";
			$query .= "os.origin_id = ? AND ";
			$query .= "os.deleted_origin = false AND ";     //checar que el origen no esté borrado
			$query .= "os.supplier_id = s.id";
		}

		$values = array();
		array_push($values, $type, $type);
		if($origin != '')
		{
			array_push($values, $origin);
		}
		return array('query' => $query, 'values' => $values);
	}
}