<!-- uses $catalog -->
<?php echo $this->Html->script('productsSuppliers-catalog'); ?>
<h2>Catálogo de <?php echo $catalog->supplier['corporate_name'] ?></h2>
<?php echo $this->Form->hidden('supplier_id', array('id' => 'supplier_id', 'value' => $catalog->supplier['id'])); ?>

<table class="table table-striped">
    <?php
        echo $this->Html->tableHeaders(array('Producto', 'Precio', 'Fecha de actualización', ''));
        foreach ($catalog->catalog_items as $catalog_item) :
            echo $this->Html->tableCells(
                array(
                        $catalog_item->product['manufacturer_id'],
                        $catalog_item->price,
                        $catalog_item->last_update,
                        $this->Form->button('borrar', array('onclick' => 'remove_product_from_supplier(' . $catalog_item->product['id'] . ')', 'class'=>'btn btn-danger btn-small'), array('class'=>'btn btn-danger btn-small'))
                ),
                array('id' => 'p-' . $catalog_item->product['id']),
                array('id' => 'p-' . $catalog_item->product['id']) //sí, se necesita poner 2 veces. Uno para odds, otro para evens.
            );
        endforeach;
    ?>
</table>
<div class="grey-container catalog" style="width:100%;">
    <h2 class=""> Añadir nuevo producto </h2>
        <form class="inline-form">
            <div class="form-fields">
                <label for="new_manufacurer_id">Identificador: </label>
                <input id="new_manufacturer_id" placeholder=""></input>
            </div>
            <div class="form-fields">
                <label for="new_price">Precio: </label>
                <input id="new_price" placeholder=""></input>
            </div>

                <button onclick="ensure_that_supplier_supplies_product()" class="btn btn-success">Añadir</button>

<?php echo $this->element('paginator'); ?>
</div>