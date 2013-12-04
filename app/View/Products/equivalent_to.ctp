<!-- 'equivalent', 'equivalency_relations'-->
<!-- lay rulz -->

<?php echo $this->Html->script('products-equivalent_to'); ?>
<h2><?php echo $equivalent['Product']['manufacturer_id']; ?> es equivalencia de:</h2>

<?php echo $this->Form->hidden('equivalent_id', array('id' => 'equivalent_id', 'value' => $equivalent['Product']['id'])); ?>
<?php echo $this->Form->hidden('equivalent_manufacturer_id', array('id' => 'equivalent_manufacturer_id', 'value' => $equivalent['Product']['manufacturer_id'])); ?>
<table>
    <?php
        echo $this->Html->tableHeaders(array('Originales'));
        foreach($equivalency_relations as $original):
            echo $this->Html->tableCells(
                array(
                        $original['Original']['manufacturer_id'],
                        $this->Form->button('Eliminar relación', array('onclick' => 'delete_equivalency_between_equivalent_and_original(' . $original['Original']['id'] . ')'))
                )
            );
        endforeach;
    ?>
</table>

<h3>Añadir este producto como equivalente del siguiente:</h3>
Identificador: <input id="new_original_manufacturer_id"></input><br/>
<button onclick="add_this_as_equivalent_of_product()"> Añadir </input><br/>

<?php echo $this->element('paginator'); ?>