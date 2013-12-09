<ul class="dropdown-menu actions">
  <h4 class="text-center light">Acciones</h4>
  <li><?php echo $this->Html->link ('Productos', array('controller'=>'products', 'action'=>'index')) ; ?></li>
  <li><?php echo $this->Html->link ('Agregar Producto', array('controller'=>'products', 'action'=>'add')) ; ?></li>
  <li class="divider"></li>
  <li><?php echo $this->Html->link ('Tipos de Producto', array('controller'=>'types', 'action'=>'index')) ; ?></li>
  <li><?php echo $this->Html->link ('Agregar Tipo', array('controller'=>'types', 'action'=>'add')) ; ?></li>
</ul>
