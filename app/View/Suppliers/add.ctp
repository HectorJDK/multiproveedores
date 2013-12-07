<?php echo $this->element('suppliers_actions'); ?>

<div class="grey-container add supplier">
	<h2>Nuevo Proveedor</h2>
	<?php echo $this->Form->create('Supplier', $options_for_form); ?>

		<?php echo $this->Form->input('corporate_name', array('label' => 'Nombre de Empresa')); ?>
		<?php echo $this->Form->input('moral_rfc', array('label' => 'RFC')); ?>
		<a data-toggle="tooltip" data-placement="bottom" title="" data-original-title="RFC de la Empresa" id="#rfc">
			<i class="icon-question"></i>
		</a>

		<?php echo $this->Form->input('contact_name', array('label' => 'Contacto')); ?>
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nombre del contacto en la Empresa">
			<i class="icon-question"></i>
		</a>

		<?php echo $this->Form->input('contact_email', array('label' => 'Email')); ?>
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Correo del contacto en la Empresa">
			<i class="icon-question"></i>
		</a>

		<?php echo $this->Form->input('contact_telephone', array('label' => 'Teléfono')); ?>
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Telefono de contacto de la Empresa">
			<i class="icon-question"></i>
		</a>
		<br/>
		<?php echo $this->Form->input('credit', array('label' => array('class'=>'inline', 'text'=>'Crédito'), 'class' => 'checkbox')); ?>
		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Seleccionar si acepta credito">
			<i class="icon-question"></i>
		</a>

	<div class="text-right">
  <?php
  	echo $this->Html->link("Cancelar", array('action' => 'index'), array('class' => 'btn btn-danger'));
  	echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));?>
  </div>
</div>