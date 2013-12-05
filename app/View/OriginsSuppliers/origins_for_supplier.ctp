<!-- uses $supplier, $origins, $all_origins -->
<?php echo $this->Html->script('originsSuppliers-originsForSupplier'); ?>
<h2>Orígenes para <?php echo $supplier['corporate_name'] ?></h2>
<?php echo $this->Form->hidden('supplier_id', array('id' => 'supplier_id', 'value' => $supplier['id'])); ?>
<table class="table table-striped">
    <?php
        echo $this->Html->tableHeaders(array('URL', ''));
        foreach ($origins as $origin) :
            echo $this->Html->tableCells(
                array(
                        $origin['url'],
                        $this->Form->button('Eliminar relación', array('onclick' => 'removeOriginFromSupplier(' . $origin['id'] . ')', 'class'=>'btn btn-danger btn-small pull-right'))
                ),
                array('id' => 'o-' . $origin['id']),
                array('id' => 'o-' . $origin['id']) //sí, se necesita poner 2 veces. Uno para odd rows, otro para evens.
            );
        endforeach;
    ?>
</table>
<div class="grey-container">
    <h3> Relacionar con otro origen </h3>
    <form class="inline-form">
    URL :
    <div class="form-fields">
        <select id="new_url">
        <?php
            foreach ($all_origins as $origin) :
                echo '<option value = "' . $origin['Origin']['id'] . '">' . $origin['Origin']['url'] . '</option>';
            endforeach;
        ?>
        </select>
    </div>
    <button onclick="addOriginToSupplier()" class="btn btn-info">Añadir</button>
</div>
<?php echo $this->element('paginator'); ?>