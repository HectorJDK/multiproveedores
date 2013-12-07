<!-- uses $supplier -->
<?php echo $this->Html->script('SuppliersTypes/suppliers_types'); ?>
<h2>Tipos de productos provistos por <?php echo $supplier['Supplier']['corporate_name']; ?></h2>

<?php echo $this->Form->hidden('supplier_id', array('id' => 'supplier_id', 'value' => $supplier['Supplier']['id'])); ?>

<table class="table table-striped">
    <?php
        echo $this->Html->tableHeaders(array('Tipo', ''));
        foreach ($types as $type) :
            echo $this->Html->tableCells(
                array(
                        $type['Type']['type_name'],
                        $this->Form->button('Eliminar relación', array('onclick' => 'remove_type_from_supplier(' . $type['Type']['id'] . ')', 'class'=>'btn btn-danger btn-small'), array('class'=>'btn btn-danger btn-small'))
                ),
                array('id' => 't-' . $type['Type']['id']),
                array('id' => 't-' . $type['Type']['id']) //sí, se necesita poner 2 veces. Uno para odds, otro para evens.
            );
        endforeach;
    ?>
</table>

<div class="grey-container suppliers_types" style="width:100%;">
    <h2 class=""> Relacionar un tipo de producto con este proveedor </h2>
    <form class="inline-form">
        <div class="form-fields">
            <label for="new_type_name">Nombre del tipo: </label>
            <input id="new_type_name" placeholder="Indroduzca el nombre del tipo"></input>
        </div>

        <button onclick="ensure_that_supplier_supplies_type()" class="btn btn-success">Relacionar</button>
    </form>
    <?php echo $this->element('paginator'); ?>
</div>