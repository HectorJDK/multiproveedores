<?php
    class SupplierProductResult
    {
        var $supplier_result;
        var $product_result;
        var $price;
        function SupplierProductResult($supplier, $product, $price)
        {
            $this->supplier_result = $supplier;
            $this->product_result = $product;
            $this->price = $price;
        }

    }
?>