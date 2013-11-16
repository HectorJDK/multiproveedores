<?php
App::uses('AppModel', 'Model');
/**
 * Email Model
 *
 */
class Email extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'email_body';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email_body' => array(
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
}
