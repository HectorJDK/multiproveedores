<ul class="dropdown-menu actions">
  <li><?php echo $this->Html->link("Nuevo Proveedor", array('action' => 'add')); ?></li>
  <li class="divider"></li>
  <li><?php echo $this->Html->link("Categorias", array('controller' => 'categories', 'action' => 'index')); ?> </li>
  <li><?php echo $this->Html->link("Nueva Categoria", array('controller' => 'categories', 'action' => 'add')); ?> </li>
</ul>
