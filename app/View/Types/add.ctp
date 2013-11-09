<?php echo $this->Html->script('add-type'); ?>

<div class="types form">
	<?php echo $this->Form->create('Type'); ?>
		<fieldset>
			<legend><?php echo __('Añadir tipo'); ?></legend>
		<?php
			echo $this->Form->input('type_name');
		?>
		<?php echo $this->Form->hidden('attributes', array("id" => 'attributes')); ?>
		<legend>Atributos:</legend>
		<table id="attributes_table" name="attributes_table">
			<?php echo $this->Html->tableHeaders(array('Atributo', 'Tipo', 'Borrar')); ?>
		</table>
		<?php echo $this->Form->end(__('Crear')); ?>

		</fieldset>
</div>

<div class="form">
		<fieldset>
			<legend> <?php echo __('Añadir atributo') ?> </legend>
			<label>Nombre:</label> <input type="text" id="attribute_name" required="required"/>
			<label>Tipo:</label>
			<?php echo $this->Form->select('Tipo', $data_types, array('id' => 'attribute_type')); ?>

			<input type="submit" value="Añadir atributo" onClick="add_attribute()"/>
		</fieldset>
</div>