<?php foreach($suppliers_products as $sp): ?>

    <?php
        echo $sp->supplier_result->contact_email;

        echo $sp->product_result->manufacturer_id;

        echo "Precio: ";
        echo $sp->price;

    ?>

<?php endforeach; ?>