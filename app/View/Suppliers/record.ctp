<!-- uses $supplier, $payed_orders -->
<div class="col-2">
  <?php echo $this->element('suppliers_actions_sections'); ?>
</div>

<div class="col-10">
  <h3>Historial de <?php echo $this->Html->link($supplier['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $supplier['id'])); ?></h3>
  <div class="row striped slim shaded">
    <div class="col-8">
      <div class="row">
        <div class="col-3 text-right light">
          Cotizaciones aceptadas:
        </div>
        <div class="col-3">
          <?php echo $supplier['accepted_quotes']; ?>
        </div>

        <div class="col-3 text-right light">
          Total pagado al proveedor:
        </div>
        <div class="col-3">
          <?php echo $supplier['payed']; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-3 text-right light">
          Cotizaciones rechazadas:
        </div>
        <div class="col-3">
          <?php echo $supplier['rejected_quotes']; ?>
        </div>

        <div class="col-3 text-right light">
          Rating promedio:
        </div>
        <div class="col-3">
         <?php for($i = 1; $i <= $supplier['rating']; $i++){
          echo "<i class=\"icon-star\"></i>";
        }?>
      </div>

    </div>
    <div class="row">
      <div class="col-3 text-right light">
        Deuda hacia el proveedor:
      </div>
      <div class="col-3 red">
        <?php echo $supplier['debt']; ?>
      </div>
    </div>



  </div>
</div>

<h3>Órdenes pagadas:</h3>

<?php
        // echo $this->Html->tableHeaders(array('Producto', 'Precio unitario', 'Cantidad', 'Total', 'Rating', 'Fecha de pago')); //la fecha de pago es en realidad la última fecha de modificación. Debería de ser la fecha de pago, pues cuando se paga es la última vez que se moficida la orden.
  foreach ($payed_orders as $payed_order) : ?>
<div class="row striped slim">
  <!-- INFO -->
  <div class="col-8">
    <div class="row">
      <div class="col-6">
        Rating<?php for($i = 1; $i <= $payed_order->rating; $i++){
          echo "<i class=\"icon-star\"></i>";
        }?>
      </div>
      <div class="col-3    text-right light">
        Fecha de creación
      </div>
      <div class="col-3 bold">
        <?php echo $payed_order->date; ?>
      </div>
    </div>

    <!-- Proveedor -->
    <div class="row">
      <div class="col-3 text-right light">
        Producto
      </div>
      <div class="col-9">
        <?php echo $payed_order->product['manufacturer_id']; ?>
      </div>

      <div class="col-3 text-right light">
        Precio Unitario
      </div>
      <div class="col-3">
        <?php echo $payed_order->unitary_price; ?>
      </div>

      <div class="row">
        <div class="col-3 text-right light">
          Cantidad
        </div>
        <div class="col-3">
          <?php echo $payed_order->quantity; ?>
        </div>

        <div class="col-3 text-right light">
          Precio Total
        </div>
        <div class="col-3">
          <?php echo $payed_order->total; ?>
        </div>
      </div>

      <?php
      endforeach;
      ?>


      <?php echo $this->element('paginator'); ?>
</div>