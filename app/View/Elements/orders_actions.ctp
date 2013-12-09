<ul class="dropdown-menu actions">
  <h4 class="text-center light">Acciones</h4>

  <li><?php echo $this->Html->link ('Ordenes por Cerrar', array('controller'=>'orders', 'action'=>'index')) ; ?> </li>
  <li><?php echo $this->Html->link ('Ordenes por Pagar', array('controller'=>'orders', 'action'=>'ordersToPay')) ; ?> </li>
  <li><?php echo $this->Html->link ('Historial de Ordenes', array('controller'=>'orders', 'action'=>'ordersHistory')) ; ?> </li>
</ul>