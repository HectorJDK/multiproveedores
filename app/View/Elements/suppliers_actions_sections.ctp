<ul class="dropdown-menu actions">
  <h4 class="text-center light">Acciones</h4>
  <li><?php echo $this->Html->link("Catálogo", array('controller' => 'productsSuppliers', 'action' => 'catalog', $supplier['id'])); ?> </li>
  <li><?php echo $this->Html->link("Historial", array('controller' => 'suppliers', 'action' => 'record', $supplier['id'])); ?> </li>
  <li><?php echo $this->Html->link("Tipos", array('controller' => 'suppliersTypes', 'action' => 'suppliersTypes', $supplier['id'])); ?> </li>
  <li><?php echo $this->Html->link("Origenes", array('controller' => 'originsSuppliers', 'action' => 'originsForSupplier', $supplier['id'])); ?> </li>
</ul>
