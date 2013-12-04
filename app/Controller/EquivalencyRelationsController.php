<?php
App::uses('AppController', 'Controller');

/**
 * EquivalencyRelations Controller
 *
 * @property EquivalencyRelation $EquivalencyRelation
 * @property Original $Original
 * @property Equivalent $Equivalent
 * @property PaginatorComponent $Paginator
 */
class EquivalencyRelationsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public $uses = array('Product', 'EquivalencyRelation');


    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        $this->autoRender = false;
        $this->EquivalencyRelation->Original->recursion = -1;
        $this->EquivalencyRelation->Equivalent->recursion = -1;

        $original_manufacturer_id = $this->request->data['original_manufacturer_id'];
        $equivalent_manufacturer_id = $this->request->data['equivalent_manufacturer_id'];

        $original =   $this->EquivalencyRelation->Original->findByManufacturerId($original_manufacturer_id);
        $original_id = $original['Original']['id'];

        $equivalent = $this->EquivalencyRelation->Equivalent->findByManufacturerId($equivalent_manufacturer_id);
        $equivalent_id = $equivalent['Equivalent']['id'];

        $already_existing = $this->EquivalencyRelation->find('all',
            array('conditions' => array(
            'original_id' => $original_id,
            'equivalent_id' => $equivalent_id
        )));

        if(count($already_existing) > 0)
        {
            return;
        }

        $this->EquivalencyRelation->save(array(
            'original_id' => $original_id,
            'equivalent_id' => $equivalent_id
        ));
        return true;
    }

    public function delete()
    {
        $this->autoRender = false;
        $original_id = $this->request->data['original_id'];
        $equivalent_id = $this->request->data['equivalent_id'];
        if($original_id == $equivalent_id)
        {
            throw new InternalErrorException("Un producto no puede dejar de ser equivalente de si mismo.");
        }
        $this->EquivalencyRelation->deleteAll(array(
            'original_id' => $original_id,
            'equivalent_id' => $equivalent_id
        ));
    }
}
