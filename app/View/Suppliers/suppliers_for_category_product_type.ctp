<?php echo $this->Html->script('suppliers-suppliers_for_category_product_type'); ?>

<!-- uses $results, $request_id  -->
request id: <?php echo  $request_id ?>

<?php foreach ($results as $result): ?>
<div>
  <?php
    echo $result->contact_email;
    echo $result->contact_name;
    echo $result->contact_telephone;
    echo $result->corporate_name;
    echo $result->credit;
    echo $result->id;
    ?>

    <button class="btn " onclick='enviar_cotizacion(<?php echo ($request_id . ', '. $result->id) ?>)'>Enviar Cotización</button>
</div>

 <?php endforeach; ?>