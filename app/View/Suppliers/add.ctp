<?php echo $this->element('suppliers_actions'); ?>
<div class="grey-container">
	<h2>Nuevo Proveedor</h2>
	<?php echo $this->Form->create('Supplier', $options_for_form); 
		echo $this->Form->input('corporate_name', array('label' => 'Nombre de Empresa'));
		echo $this->Form->input('moral_rfc', array('label' => 'RFC'));
		echo $this->Form->input('contact_name', array('label' => 'Contacto'));
		echo $this->Form->input('contact_email', array('label' => 'Email'));
		echo $this->Form->input('contact_telephone', array('label' => 'Teléfono'));
		echo $this->Form->input('credit', array('label' => 'Crédito', 'class' => ''));
	?>
	<div class="text-right">
  <?php 
  	echo $this->Html->link("Cancelar", array('action' => 'index'), array('class' => 'btn btn-danger'));
  	echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));?>
  </div>	
</div>

<?php echo $this->element('suppliers_actions'); ?>