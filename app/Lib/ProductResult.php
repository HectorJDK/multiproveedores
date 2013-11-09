<?php
    class ProductResult {
        var $id;
        var $manufacturer_id;
        var $attributes; //[i][0] id del tipo del atributo, [i][1] nombre del atributo, [i][2] valor del atributo

        function ProductResult($id, $manufacturer_id)
        {
            $this->id = $id;
            $this->manufacturer_id = $manufacturer_id;
            $this->attributes = array();
        }

    }
?>