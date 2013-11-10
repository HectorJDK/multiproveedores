<?php echo $this->AssetCompress->script('products-add'); ?>

<?php echo $this->Form->create('Product', array('id'=>'ProductAddForm')); ?>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
	<?php
		echo $this->Form->input('type_id', array('id' => 'type_id', 'onchange'=>"type_changed()"));
		echo $this->Form->input('manufacturer_id', array('type' => 'Text', 'label' => 'Numero Fabricante'));
		echo $this->Form->hidden('attributes_values', array("id" => 'attributes_values'));
	?>
	</fieldset>

<?php echo $this->Form->end(__('Submit')); ?>

<fieldset>
	<div id="atributos">
		<legend>Atributos</legend>
	</div>
</fieldset>



