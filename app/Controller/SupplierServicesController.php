<?php
class SupplierServicesController extends AppController
{
	public $uses = array('Content', 'Supplier');

	public $components = array('RequestHandler');

    public function suppliers_for_category_product_type()
    {
        $this->autoRender = false;

        $product_description = $this->request->data;

        $category = $this->request->data[0];
        $product_type = $this->request->data[1];

        $result = $this->Supplier->search_by_product_type($category, $product_type);
        echo json_encode($result);
    }

}
?>