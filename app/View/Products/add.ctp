<?php echo $this->AssetCompress->script('products-add'); ?>

<?php echo $this->Form->create('Product', array('id'=>'ProductAddForm')); ?>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
	<?php
		echo $this->Form->input('manufacturer_id', array('type' => 'Text', 'label' => 'Numero Fabricante'));
		echo $this->Form->input('Supplier.supplier_id', array('label' => 'Proveedor'));
		echo $this->Form->input('Supplier.price', array('label' => 'Precio'));
		echo $this->Form->input('generic', array('label' => 'Generico'));
		echo $this->Form->input('type_id', 
			array('id' => 'type_id', 'onchange'=>"type_changed()", 'label' => 'Tipo Producto'));
		echo $this->Form->hidden('Attributes.attributes_values', array("id" => 'attributes_values'));

	?>
	</fieldset>

<?php echo $this->Form->submit(__('Submit',true), array('class'=>'btn btn-info')); 
    echo $this->Form->end(); ?>

<fieldset>
	<div id="atributos">
		<legend>Atributos</legend>
	</div>
</fieldset>



