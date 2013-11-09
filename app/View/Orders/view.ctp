<div class="grey-container" >
  <h2>Orden de Compra #<?php echo h($order['Order']['id']); ?></h2>

  <!-- Fecha -->
  <div class="row">
    <div class="col-9 text-right light">
      Fecha de creación
    </div>
    <div class="col-3 bold">
      <?php echo $this->Time->format($order['Order']['created'], '%d/%m/%y', 'invalid'); ?>
    </div>
  </div>

  <!-- Status -->
  <div class="row">
    <div class="col-9 text-right light">
      Status
    </div>
    <div class="col-3 bold">
      <?php echo $order['State']['value']; ?>
    </div>
  </div>

  <!-- Proveedor -->
  <div class="row">
    <div class="col-3 text-right light">
      Proveedor
    </div>
    <div class="col-9">
      <?php echo $this->Html->link($quote['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $quote['Supplier']['id'])); ?>
    </div>
  </div>

  <!-- Producto -->
  <div class="row">
    <div class="col-3 text-right light">
      Producto
    </div>
    <div class="col-3">
      <?php echo $this->Html->link($quote['Quote']['product_id'], array('controller' => 'products', 'action' => 'view', $quote['Quote']['product_id'])); ?>
    </div>

    <div class="col-3 text-right light">
      Precio Unitario
    </div>
    <div class="col-3">
      <?php echo "$".h($order['Order']['unitary_price']); ?>
    </div>
  </div>

  <div class="row">
    <div class="col-3 text-right light">
      Cantidad
    </div>
    <div class="col-3">
      <?php echo h($order['Order']['quantity']); ?>
    </div>

    <div class="col-3 text-right light">
      Precio Total
    </div>
    <div class="col-3">
      <?php echo "$".h($order['Order']['total_price']); ?>
    </div>
  </div>
  <!-- Rating -->
  <div class="row">
  	<hr />
  	<div class="col-3 text-right light">
      Rating
    </div>
    <div class="col-9">
      <?php for($i = 1; $i <= $order['Order']['rating']; $i++){
      	echo "<i class=\"icon-star\"></i>";
      } 
      ?>
    </div>
  </div>
</div>