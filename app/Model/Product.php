<?php
App::uses('AppModel', 'Model');
App::uses('ProductSearch', 'Lib');
App::uses('ProductResult', 'Lib');
App::uses('SupplierResult', 'Lib');
App::uses('SupplierProductResult', 'Lib');
/**
 * Product Model
 *
 * @property Category $origin
 * @property Type $Type
 * @property Attribute $Attribute
 * @property Supplier $Supplier
 */
class Product extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'manufacturer_id';

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
		'origin_id' => array(
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
		'type_id' => array(
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
		'manufacturer_id' => array(
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
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Quote' => array(
			'className' => 'Quote',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
			),
		'AsOriginal' => array(
			'className' => 'EquivalencyRelation',
			'foreignKey' => 'original_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '',
			'table' => 'products',
		),
		'AsEquivalent' => array(
			'className' => 'EquivalencyRelation',
			'foreignKey' => 'equivalent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

	);

	/**
	* hasAndBelongsToMany associations
	*
	* @var array
	*/
	public $hasAndBelongsToMany = array(
		'Attribute' => array(
			'className' => 'Attribute',
			'joinTable' => 'attributes_products',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'attribute_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			),
		'Supplier' => array(
			'className' => 'Supplier',
			'joinTable' => 'products_suppliers',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'supplier_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			)
	);


	//		------	BUSQUEDAS	------

	public function search_by_attributes($search)
	{
		$preparation = $this->search_by_attributes_preparation($search);
		$db = $this->getDataSource();
				//return $preparation['values'];
		$result = $db->fetchAll($preparation['query'], $preparation['values']);
		return $this->group_products_result($result);
	}

	public function search_suppliers_for_products($products)
	{

		$splitted_products = $this->split_only_originals_from_with_equivalencies($products);

		$originals = $this->search_equivalencies($splitted_products[0], array(), 0);
		$originals_ids = $this->ids_from_product_results($originals);

		$generics = $this->search_equivalencies($splitted_products[1], $originals_ids, 1);
		$originals_generics = $this->merge_products($originals, $generics);
		$originals_generics_ids = $this->ids_from_product_results($originals_generics);

		$indistinct = $this->search_equivalencies($splitted_products[2], $originals_generics_ids, 2);
		$results = $this->merge_products($originals_generics, $indistinct);
		$results_ids = $this->ids_from_product_results($results);

		return $this->search_suppliers_for_ids($results_ids, $results);
	}

	public function search_products($products_ids)
	{
		$preparation = $this->search_products_with_id_preparation($products_ids);
		$db = $this->getDataSource();
				// return $preparation['query'];
		$result = $db->fetchAll($preparation['query'], $preparation['values']);
		return $this->group_products_result($result);
	}

	public function search_equivalencies($products_ids, $excluding, $kind)
	{
		switch ($kind) {
			case 0:
			$preparation = $this->search_equivalencies_no_generics_preparation($products_ids, $excluding);
			break;

			case 1:
			$preparation = $this->search_equivalencies_with_generics_preparation($products_ids, $excluding);
			break;

			case 2:
			$preparation = $this->search_equivalencies_indistinct_preparation($products_ids, $excluding);
			break;
		}

		$db = $this->getDataSource();
				// return $preparation['query'];
		$result = $db->fetchAll($preparation['query'], $preparation['values']);
		return $this->group_products_result($result);
	}

	public function search_suppliers_for_ids($products_ids, $products_results)
	{
		$preparation = $this->search_suppliers_that_supply_preparation($products_ids);
		$db = $this->getDataSource();
	   //return $preparation['query'];
		$result = $db->fetchAll($preparation['query'], $preparation['values']);
		//return $result;
		$supplierProductResults = array();

		$pr_id = 0;
		$last_product_id = -1;
		foreach ($result as $key => $value)
		{
			$supplierResult = new SupplierResult(
				$value[0]['supplier_id'],
				$value[0]['corporate_name'],
				$value[0]['moral_rfc'],
				$value[0]['contact_name'],
				$value[0]['contact_email'],
				$value[0]['contact_telephone'],
				$value[0]['rating'],
				$value[0]['accepted_quotes'],
				$value[0]['rejected_quotes'],
				$value[0]['deleted'],
				$value[0]['payed'],
				$value[0]['debt'],
				$value[0]['credit'],
				$value[0]['rejected_price'],
				$value[0]['rejected_existance'],
				$value[0]['rejected_response'],
				$value[0]['rejected_delivery']
			);
			$product_id = $value[0]['product_id'];
			while($products_results[$pr_id]->id != $product_id)
			{
				$pr_id++;
			}
			$supplierProductResult = new SupplierProductResult($supplierResult, $products_results[$pr_id], $value[0]['price']);

			array_push($supplierProductResults, $supplierProductResult);
		}
		return $supplierProductResults;
	}

	//	-----PREPARATIONS-------

	public function search_by_attributes_preparation($productSearch)
	{
		$not_empty_attributes = array();
		foreach ($productSearch->attributes as $key => $value)
		{
			if($value['value'] != '')
			{
				$not_empty_attributes[$value['attribute_id']] = $value['value'];
			}
		}

		if($productSearch->category == '')
		{
			return $this->attributes_no_category_preparation($productSearch->type, $not_empty_attributes);
		}else
		{
			return $this->attributes_category_preparation($productSearch->category, $productSearch->type, $not_empty_attributes);
		}
	}
	public function attributes_category_preparation($origin, $product_type, $not_empty_attributes)
	{
		$query = "select p.id, p.manufacturer_id, name, data_type_id, value ";
		$query .= "from products as p, attributes as a, attributes_products as ap, products_suppliers as ps ";
		$query .= "WHERE ps.deleted_supplier = 'false' AND "; //checar que el supplier no esté borrado
		$query .= "p.deleted = false AND ";      //Checar que el producto no esté borrado
		$query .= "p.id in ";
		$query .= "(select suppliers_filter.p_id ";
			$query .= "from ";
			$query .= "(select attributes_filter.p_id as p_id, ps.supplier_id as s_id ";
				$query .= "from (";
					$query .= "select ap.product_id as p_id ";
					$query .= "from ";
					$query .=         "( ";
						$query .= "select * ";
						$query .= "from attributes ";
						$query .= $this->ids_place_holders_possibly_empty('where attributes.id', count($not_empty_attributes));
						$query .= ") as a ";
		$query .= "inner join ";
		$query .= "attributes_products as ap ";
		$query .= "on a.id = ap.attribute_id ";
		$query .= $this->list_of_values_place_holders($not_empty_attributes) . " ";
		$query .= "group by p_id ";
		$query .= "Having Count(ap.product_id) >= " . count($not_empty_attributes);
		$query .= ") as attributes_filter, ";
		$query .= "products_suppliers as ps ";
		$query .= "where attributes_filter.p_id = ps.product_id ";
		$query .= ") as suppliers_filter, ";
		$query .= "origins_suppliers as cs ";
		$query .= "where ";
		$query .= "cs.supplier_id = suppliers_filter.s_id AND ";
		$query .= "cs.origin_id = ? AND ";
		$query .= "cs.deleted_origin = false ";  //Checar que el origen no esté borrado
		$query .= ") ";
		$query .= "AND p.generic = false ";
		$query .= "AND p.type_id = ? AND ap.product_id = p.id AND ap.attribute_id = a.id ";
		$query .= "AND p.id = ps.product_id "; //at least one supplier
		$query .= "ORDER BY p.id, attribute_id";

		$values = $this->attributes_search_values($origin, $product_type, $not_empty_attributes);
		return array('query' => $query, 'values' => $values);
	}

	public function attributes_no_category_preparation($product_type, $not_empty_attributes)
	{
		$query = "select p.id, p.manufacturer_id, name, data_type_id, value ";
		$query .= "from products as p, attributes as a, attributes_products as ap, products_suppliers as ps ";
		$query .= "WHERE ";
		$query .= "ps.deleted_supplier = false AND "; //checar que el supplier no esté borrado
		$query .= "p.id in ";
		$query .= "(select attributes_filter.p_id as p_id ";
			$query .= "from (";
				$query .= "select ap.product_id as p_id ";
				$query .= "from ";
				$query .=         "( ";
					$query .= "select * ";
					$query .= "from attributes ";
					$query .= $this->ids_place_holders_possibly_empty('where attributes.id', count($not_empty_attributes));
					$query .= ") as a ";
		$query .= "inner join ";
		$query .= "attributes_products as ap ";
		$query .= "on a.id = ap.attribute_id ";
		$query .= $this->list_of_values_place_holders($not_empty_attributes) . " ";
		$query .= "group by p_id ";
		$query .= "Having Count(ap.product_id) >= ". count($not_empty_attributes);
		$query .= ") as attributes_filter ";
		$query .= ") ";
		$query .= "AND p.deleted = false ";         //checar que el producto no esté borrado
		$query .= "AND p.generic = false ";
		$query .= "AND p.type_id = ? AND ap.product_id = p.id AND ap.attribute_id = a.id ";
		$query .= "AND p.id = ps.product_id "; //at least one supplier
		$query .= "ORDER BY p.id, attribute_id";

		$values = $this->attributes_search_values('', $product_type, $not_empty_attributes);
		return array('query' => $query, 'values' => $values);
	}

	public function search_products_with_id_preparation($ids)
	{
		$query = "select p.id, p.manufacturer_id, data_type_id, name, value ";
		$query .= "from ";
		$query .= "( ";
			$query .= "select products.id, products.manufacturer_id ";
			$query .= "from products ";
			$query .= $this->ids_place_holders('where products.id', count($ids));
			$query .= ") as p ";
		$query .= "inner join ";
		$query .= "attributes_products ";
		$query .= "on attributes_products.product_id = p.id, ";
		$query .= "attributes ";
		$query .= "where ";
		$query .= "attributes.id = attributes_products.attribute_id ";
		$query .= "p.deleted = false ";
		$query .= "order by p.id, attribute_id";

	return array('query' => $query, 'values' => $ids);
	}


	//Busqueda de productos seleccionados::::::

	public function search_equivalencies_no_generics_preparation($products_ids, $excluding)
	{
		$query = "select p.id, p.manufacturer_id, data_type_id, name, value ";
		$query .= "from ";
		$query .= "( ";
		$query .= "select equivalent_id as e_id, deleted_equivalent ";
		$query .= "from equivalency_relations as er ";
		$query .= $this->ids_place_holders('where er.original_id', count($products_ids));
		$query .= "AND er.deleted_equivalent = false ";
		$query .= ")as equivalencies ";
		$query .= "inner join ";
		$query .= "attributes_products ";
		$query .= "on attributes_products.product_id = equivalencies.e_id, ";
		$query .= "attributes, ";
		$query .= "products as p ";
		$query .= "where ";
		$query .= "p.generic = false AND ";
		$query .= "equivalencies.deleted_equivalent = false AND ";
		$query .= "attributes.id = attributes_products.attribute_id AND ";
		$query .= "p.id = equivalencies.e_id ";
		$query .= $this->exclude($excluding);
		$query .= "order by product_id, attribute_id ";

	return array('query' => $query, 'values' => array_merge($products_ids, $excluding));
	}

	public function search_equivalencies_with_generics_preparation($products_ids, $excluding)
	{
		$query = "select p.id, p.manufacturer_id, data_type_id, name, value ";
		$query .= "from ";
		$query .= "( ";
			$query .= "select equivalent_id as e_id, deleted_equivalent  ";
			$query .= "from equivalency_relations as er ";
			$query .= $this->ids_place_holders('where er.original_id', count($products_ids));
			$query .= "AND er.deleted_equivalent = false ";
			$query .= ")as equivalencies ";
		$query .= "inner join ";
		$query .= "attributes_products ";
		$query .= "on attributes_products.product_id = equivalencies.e_id, ";
		$query .= "attributes, ";
		$query .= "products as p ";
		$query .= "where ";
		$query .= "p.generic = true AND ";
		$query .= "equivalencies.deleted_equivalent = false AND ";
		$query .= "attributes.id = attributes_products.attribute_id AND ";
		$query .= "p.id = equivalencies.e_id ";
		$query .= $this->exclude($excluding);
		$query .= "order by product_id, attribute_id ";

	return array('query' => $query, 'values' => array_merge($products_ids, $excluding));
	}

	public function search_equivalencies_indistinct_preparation($products_ids, $excluding)
	{
		$query = "select p.id, p.manufacturer_id, data_type_id, name, value ";
		$query .= "from ";
		$query .= "( ";
		$query .= "select equivalent_id as e_id, deleted_equivalent  ";
		$query .= "from equivalency_relations as er ";
		$query .= $this->ids_place_holders('where er.original_id', count($products_ids));
		$query .= "AND er.deleted_equivalent = false ";
		$query .= ")as equivalencies ";
		$query .= "inner join ";
		$query .= "attributes_products ";
		$query .= "on attributes_products.product_id = equivalencies.e_id, ";
		$query .= "attributes, ";
		$query .= "products as p ";
		$query .= "where ";
		$query .= "equivalencies.deleted_equivalent = false AND ";
		$query .= "attributes.id = attributes_products.attribute_id AND ";
		$query .= "p.id = equivalencies.e_id ";
		$query .= $this->exclude($excluding);
		$query .= "order by product_id, attribute_id ";

		return array('query' => $query, 'values' => array_merge($products_ids, $excluding));
	}

	//   ::::::::: END OF Busqueda de productos seleccionados

	//providers that provide the given products
	public function search_suppliers_that_supply_preparation($products_ids)
	{
		$query = "select ps.product_id, ps.price as price, ps.supplier_id, ";
		$query .= "s.moral_rfc as moral_rfc, s.contact_name as contact_name, ";
		$query .= "s.contact_email as contact_email, s.contact_telephone as contact_telephone, ";
		$query .= "s.rating as rating, s.accepted_quotes as accepted_quotes, ";
		$query .= "s.rejected_quotes as rejected_quotes, s.deleted as deleted, ";
		$query .= "s.payed as payed, s.debt as debt, s.credit as credit, ";
		$query .= "s.rejected_price as rejected_price, s.rejected_existance as rejected_existance, ";
		$query .= "s.rejected_response as rejected_response, s.rejected_delivery as rejected_delivery, ";
		$query .= "s.corporate_name as corporate_name, s.contact_name, s.contact_email, s.credit, ";
		$query .= "s.contact_telephone, s.payed as payed, s.debt as debt, s.rating as rating ";
		$query .= "from ";
		$query .= "products_suppliers as ps, suppliers as s ";
		$query .= "WHERE ";
		$query .= "ps.supplier_id = s.id AND ";
		$query .= "ps.deleted_supplier = false ";
		$query .= $this->ids_place_holders('AND ps.product_id', count($products_ids));
		$query .= "order by ps.product_id, supplier_id";

		return array('query' => $query, 'values' => $products_ids);
	}

	//              -----------AUXILIARES-----------------

	public function ids_from_product_results($products)
	{
		$result = array();
		foreach ($products as $key => $value) {
			array_push($result, $value->id);
		}
		return $result;
	}

	public function merge_products($originals, $equivalencies)
	{
		$result = array();
		$o_i = 0;
		$e_i = 0;
		while($o_i < count($originals) && $e_i < count($equivalencies))
		{
			$o_id = $originals[$o_i]->id;
			$e_id = $equivalencies[$e_i]->id;
			if($o_id < $e_id)
			{
				array_push($result, $originals[$o_i]);
				$o_i++;
			}else
			{
				array_push($result, $equivalencies[$e_i]);
				$e_i++;
			}
		}

		if( $o_i < count($originals) )
		{
			while($o_i < count($originals))
			{
				array_push($result, $originals[$o_i]);
				$o_i++;
			}
		}else if($e_i < count($equivalencies))
		{
			while($e_i < count($equivalencies))
			{
				array_push($result, $equivalencies[$e_i]);
				$e_i++;
			} 
		}
		return $result;
	}

	public function exclude($excluding)
	{
		if(count($excluding) == 0) return '';
		$result = "AND p.id not in (? ";
			for($i = 0; $i < count($excluding) - 1; $i++)
			{
				$result .= ", ?";
			} 
			$result .= ") ";
	return $result;
	}

	public function split_only_originals_from_with_equivalencies($products_equivalencies)
	{

		$originals = array();
		$generics = array();
		$indistinct = array();

		foreach ($products_equivalencies as $key => $value)
		{
			switch ($value[1]) {
				case 1:
				array_push($originals, $value[0]);
				break;

				case 2:
				array_push($generics, $value[0]);
				break;

				case 3:
				array_push($indistinct, $value[0]);
				break;
			}
		}
		return array($originals, $generics, $indistinct);
	}

	public function ids_place_holders($condition, $how_many)
	{
		if($how_many == 0) {return $condition . ' in (0)';}
		$result = $condition . " in ( ?";
			for($i = 0; $i < $how_many - 1; $i++)
			{
				$result .= ", ?";
			} 
			$result .= ") ";
	return $result;
	}

	public function ids_place_holders_possibly_empty($condition, $how_many)
	{
		if($how_many == 0) {return '';}
		$result = $condition . " in ( ?";
			for($i = 0; $i < $how_many - 1; $i++)
			{
				$result .= ", ?";
			}
			$result .= ") ";
	return $result;
	}

	public function list_of_values_place_holders($attributes)
	{
		if (count($attributes) == 0) return '';

		$result = "WHERE ap.value = ?";
		for($i = 0; $i < count($attributes)-1; $i++)
		{
			$result .= " OR ap.value = ?";
		}
		return $result;
	}

	public function group_products_result($result)
	{
		$results = array();
		$current_product_id = 0;
		$aux = null;
				// $line = $result[0][0];
				// return array($line['data_type_id'], $line['name'], $line['value']);
		for($i = 0; $i < count($result); $i++)
		{
			$line = $result[$i][0];
			if($current_product_id == 0 || $current_product_id != $line['id'])
			{
				if($current_product_id != 0)
				{
					array_push($results, $aux);
				}
				$current_product_id = $line['id'];
				$aux = new ProductResult($line['id'], $line['manufacturer_id']);
			}
			array_push($aux->attributes, array($line['data_type_id'], $line['name'], $line['value']));
		}
		if($aux != null)
		{
			array_push($results, $aux);
		}
		return $results;
	}

	public function attributes_search_values($origin, $type, $not_empty_attributes)
	{
		$values = array();
		foreach ($not_empty_attributes as $key => $value)
		{
			array_push($values, $key);
		}
		foreach ($not_empty_attributes as $key => $value)
		{
			array_push($values, $value);
		}
		if($origin != '')
		{
			array_push($values, $origin);
		}
		array_push($values, $type);
		return $values;
	}

    public function update_product($product)
    {
        $db = $this->getDataSource();

        //update product
        $this->update_only_product($db, $product);

        //update each of its attributes
        foreach ($product['Product']['Attribute'] as $id => $value)
        {
            $this->update_attribute($db, $id, $value);
        }

        return true;
    }

    public function update_only_product($db, $product)
    {
        $sql = "UPDATE products ";
        $sql .= "SET manufacturer_id = ?, generic = ? ";
        $sql .= "WHERE id = ?; ";

        $values = array($product['Product']['manufacturer_id'], $product['Product']['generic'], $product['Product']['id']);


        $db->query($sql, $values);
    }

    public function update_attribute($db, $id, $value)
    {
        $sql = "UPDATE attributes_products ";
        $sql .= "SET value = ? ";
        $sql .= "WHERE id = ?; ";

        $values = array($value, $id);

        $db->query($sql, $values);
    }
}