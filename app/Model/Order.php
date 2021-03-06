<?php
App::uses('AppModel', 'Model');
/**
 * Order Model
 *
 * @property Account $Account
 * @property User $User
 * @property Quote $Quote
 * @property State $State
 */
class Order extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

		'state_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Quote' => array(
			'className' => 'Quote',
			'foreignKey' => 'quote_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function currencyConversion($from, $to, $amount){                    
        $from = urlencode($from);
        $to = urlencode($to);
        $amount = urlencode($amount);
       
        //Yahoo api
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";  
        $yql_query = "select * from csv where url='http://download.finance.yahoo.com/d/quotes.csv?e=.csv&f=c4l1&s=".$to.$from."=X' and columns='symbol,price'";
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);  
        $yql_query_url .= "&format=json";  
        $session = curl_init($yql_query_url);          
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);      
        $json = curl_exec($session);  
        $currencyObj =  json_decode($json);

        return $amount * $currencyObj->query->results->row->price;
    } 
}
