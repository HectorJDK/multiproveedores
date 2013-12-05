<?php
    class CatalogItem
    {
        var $id;
        var $product;
        var $price;
        var $last_update;

        function CatalogItem($id, $product, $price, $last_update)
        {
            $this->id = $id;
            $this->product = $product;
            $this->price = $price;
            $this->last_update = $last_update;
        }
    }

?>