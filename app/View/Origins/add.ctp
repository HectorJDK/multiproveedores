<div class="categories form">

<?php echo $this->Form->create('Origin'); ?>
	<h2>Agregar Origen</h2>

	<a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="URL del origen que desea agregar">
	<?php
		echo $this->Form->input('url');
	?>
	</a>

<?php echo $this->Form->end(array('label' => 'Agregar', 'class'=>'btn')); ?>
</div>