<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Acciones'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
		<li><?php echo $this->Html->link(__('Crear Solicitud'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Solicitudes Pendientes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Mis Solicitudes'), array('action' => 'myRequests')); ?></li>
	</ul>
</div>
