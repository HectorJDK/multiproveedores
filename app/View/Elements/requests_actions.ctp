<ul class="dropdown-menu actions">
  <h4 class="text-center light">Acciones</h4>
	<li><?php echo $this->Html->link('Crear Solicitud', array('action' => 'add')); ?></li>
	<li><?php echo $this->Html->link('Pendientes', array('action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Mis Solicitudes', array('action' => 'myRequests')); ?></li>
</ul>