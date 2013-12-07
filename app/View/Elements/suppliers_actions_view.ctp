<ul class="dropdown-menu actions">
  <li><?php echo $this->Html->link("Productos", array('controller' => 'productsSuppliers', 'action' => 'catalog', $supplier['Supplier']['id'])); ?> </li>
  <li><?php echo $this->Html->link("Historial", array('controller' => 'suppliers', 'action' => 'record', $supplier['Supplier']['id'])); ?> </li>
  <li><?php echo $this->Html->link("Tipos", array('controller' => 'suppliersTypes', 'action' => 'suppliersTypes', $supplier['Supplier']['id'])); ?> </li>
  <li><?php echo $this->Html->link("Origenes", array('controller' => 'originsSuppliers', 'action' => 'originsForSupplier', $supplier['Supplier']['id'])); ?> </li>
</ul>
