<div class="actions dropdown pull-right">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo "Acciones"; ?><b class="caret bottom-up"></b></a>
  <ul class="dropdown-menu bottom-up pull-right">
    <li><?php echo $this->Html->link("Agregar Proveedor", array('action' => 'add')); ?></li>
    <li><?php echo $this->Html->link("Ver Categorias", array('controller' => 'categories', 'action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link("Nueva Categoria", array('controller' => 'categories', 'action' => 'add')); ?> </li>
  </ul>
</div>