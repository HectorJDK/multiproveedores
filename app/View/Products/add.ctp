<?php echo $this->AssetCompress->script('products-add'); ?>

<?php echo $this->Form->create('Product', array('id'=>'ProductAddForm')); ?>
	<div class="grey-container">
	<h2>Nuevo Producto</h2>

	<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Numero de Pieza/ Original">
		<?php echo $this->Form->input('manufacturer_id', array('type' => 'Text', 'label' => 'Numero Fabricante')); ?>
	</a>
	<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Seleccionar el nombre de Proveedor, en caso de no estar, crearlo en la pestaña de Proveedores">
		<?php echo $this->Form->input('Supplier.supplier_id', array('label' => 'Proveedor')); ?>
	</a>
	<?php echo $this->Form->input('Supplier.price', array('label' => 'Precio')); ?>
	<a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Seleccionar si es de tipo generico">
		<?php echo $this->Form->input('generic', array('label' => 'Generico')); ?>
	</a>
	<a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Seleccionar tipo de producto">
	<?php echo $this->Form->input('type_id',
			array('id' => 'type_id', 'onchange'=>"type_changed()", 'label' => 'Tipo Producto')); ?>
	<?php echo $this->Form->hidden('Attributes.attributes_values', array("id" => 'attributes_values')); ?>
	</a>

<?php echo $this->Form->submit(__('Submit',true), array('class'=>'btn btn-info'));
    echo $this->Form->end(); ?>
</div>
<fieldset>
	<div id="atributos">
		<legend>Atributos</legend>
	</div>
</fieldset>



