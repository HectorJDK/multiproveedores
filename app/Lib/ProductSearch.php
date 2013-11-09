<?php
    class ProductSearch {
        var $category;
        var $type;
        var $attributes;

        function ProductSearch($category, $type, $attributes)
        {
            $this->category = $category;
            $this->type = $type;
            $this->attributes = $attributes;
        }

    }
?>