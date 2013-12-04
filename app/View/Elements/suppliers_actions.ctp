<div class="actions dropdown pull-right">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo "Acciones"; ?><b class="caret bottom-up"></b></a>
  <ul class="dropdown-menu bottom-up pull-right">
    <li><?php echo $this->Html->link("Ver Origenes", array('controller' => 'originsSuppliers', 'action' => 'originsForSupplier', $supplier['Supplier']['id'])); ?> </li>
  </ul>
</div>