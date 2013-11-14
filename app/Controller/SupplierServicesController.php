<?php
    class SupplierServicesController extends AppController
    {
        public $uses = array('Content', 'Supplier');

        public $components = array('RequestHandler');

    }
?>