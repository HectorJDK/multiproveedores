<!-- uses $supplier, $origins, $all_origins -->
<?php echo $this->Html->script('originsSuppliers-originsForSupplier'); ?>
<h2>Orígenes para <?php echo $supplier['corporate_name'] ?></h2>
<?php echo $this->Form->hidden('supplier_id', array('id' => 'supplier_id', 'value' => $supplier['id'])); ?>
<table>
    <?php
        echo $this->Html->tableHeaders(array('URL'));
        foreach ($origins as $origin) :
            echo $this->Html->tableCells(
                array(
                        $origin['url'],
                        $this->Form->button('Eliminar relación', array('onclick' => 'removeOriginFromSupplier(' . $origin['id'] . ')'))
                ),
                array('id' => 'o-' . $origin['id']),
                array('id' => 'o-' . $origin['id']) //sí, se necesita poner 2 veces. Uno para odd rows, otro para evens.
            );
        endforeach;
    ?>
</table>

<h3> Relacionar con otro origen </h3>
URL :
<select id="new_url">
<?php
    foreach ($all_origins as $origin) :
        echo '<option value = "' . $origin['Origin']['id'] . '">' . $origin['Origin']['url'] . '</option>';
    endforeach;
?>
</select>
<button onclick="addOriginToSupplier()">Añadir</button>
<?php echo $this->element('paginator'); ?>