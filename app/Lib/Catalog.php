<?php

class Catalog
{
    var $supplier;
    var $catalog_items;

    public function Catalog($supplier, $catalog_items)
    {
        $this->supplier = $supplier;
        $this->catalog_items = $catalog_items;
    }
}