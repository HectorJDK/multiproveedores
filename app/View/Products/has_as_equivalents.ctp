<!-- uses 'original', 'equivalency_relations' -->

<?php echo $this->Html->script('products-has_as_equivalents'); ?>
<h2><?php echo $original['Product']['manufacturer_id']; ?> tiene como equivalencias:</h2>

<?php echo $this->Form->hidden('original_id', array('id' => 'original_id', 'value' => $original['Product']['id'])); ?>
<?php echo $this->Form->hidden('original_manufacturer_id', array('id' => 'original_manufacturer_id', 'value' => $original['Product']['manufacturer_id'])); ?>
<table>
    <?php
        echo $this->Html->tableHeaders(array('Equivalencias'));
        foreach($equivalency_relations as $relation) :
            echo $this->Html->tableCells(
                array(
                        $relation['Equivalent']['manufacturer_id'],
                        $this->Form->button('Eliminar relación', array('onclick' => 'delete_equivalency_between_original_and_equivalent(' . $relation['Equivalent']['id'] . ')'))
                )
            );
        endforeach;
    ?>
</table>

<h3>Añadir el siguiente producto como equivalente de este:</h3>
Identificador: <input id="new_equivalent_manufacturer_id"></input> <br/>
<button onclick="add_product_as_equivalent_of_this()">Añadir</input> <br/>

<?php echo $this->element('paginator'); ?>