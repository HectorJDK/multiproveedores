<div class="grey-container">
	<h2>Nuevo Proveedor</h2>
	<?php echo $this->Form->create('Supplier', $options_for_form); ?>

		<?php echo $this->Form->input('corporate_name', array('label' => 'Nombre de Empresa')); ?>
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="RFC de la Empresa">
			<?php echo $this->Form->input('moral_rfc', array('label' => 'RFC')); ?>
		</a>
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nombre del contacto en la Empresa">
			<?php echo $this->Form->input('contact_name', array('label' => 'Contacto')); ?>
		</a>
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Correo del contacto en la Empresa">
			<?php echo $this->Form->input('contact_email', array('label' => 'Email')); ?>
		</a>
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Telefono de contacto de la Empresa">
			<?php echo $this->Form->input('contact_telephone', array('label' => 'Teléfono')); ?>
		</a>
		<a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Seleccionar si acepta credito">
			<?php echo $this->Form->input('credit', array('label' => 'Crédito', 'class' => '')); ?>
		</a>

	<div class="text-right">
  <?php
  	echo $this->Html->link("Cancelar", array('action' => 'index'), array('class' => 'btn btn-danger'));
  	echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));?>
  </div>
</div>

<?php echo $this->element('suppliers_actions'); ?>