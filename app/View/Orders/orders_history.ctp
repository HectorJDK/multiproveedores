<h2>Historial de ordenes</h2>

<div class = "filters">
	<?php echo $this->Html->link(__('Pagadas'), array('action' => 'ordersHistory/payed'), array('class'=>'btn btn-success')); ?>
	<?php echo $this->Html->link(__('Canceladas'), array('action' => 'ordersHistory/cancelled'), array('class'=>'btn btn-danger')); ?>
	<?php echo $this->Html->link(__('Todas'), array('action' => 'ordersHistory'), array('class'=>'btn btn-info')); ?>

</div>
<div class="filters">
	<span>Ordenar por:</span>
	<ul class="pagination pagination-inverse">
		<li><?php echo $this->Paginator->sort('created', 'Fecha'); ?></li>
	</ul>
</div>

<?php foreach ($orders as $key => $order): ?>
<div class="row striped slim">
	<!-- INFO -->
	<div class="col-8">
	 	<div class="row">
	 		<div class="col-6">
	      Orden #<?php echo h($order['Order']['id']); ?>
	    </div>
	    <div class="col-3 text-right light">
	      Fecha de creación
	    </div>
	    <div class="col-3 bold">
	      <?php echo $this->Time->format($order['Order']['created'], '%d/%m/%y', 'invalid'); ?>
	    </div>
	  </div>

	  <!-- Proveedor -->
	  <div class="row">
	    <div class="col-3 text-right light">
	      Proveedor
	    </div>
	    <div class="col-9">
	      <?php echo $this->Html->link($order['Quote']['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $order['Quote']['Supplier']['id'])); ?>
	    </div>
	  </div>

	  <!-- Producto -->
	  <div class="row">
	    <div class="col-3 text-right light">
	      Producto
	    </div>
	    <div class="col-3">
	      <?php echo $this->Html->link($order['Quote']['Product']['manufacturer_id'], array('controller' => 'products', 'action' => 'view', $order['Quote']['product_id'])); ?>
	    </div>

	    <div class="col-3 text-right light">
	      Precio Unitario
	    </div>
	    <div class="col-3">
	      <?php echo "$".h($order['Quote']['unitary_price']); ?>
	    </div>
	  </div>

	  <div class="row">
	    <div class="col-3 text-right light">
	      Cantidad
	    </div>
	    <div class="col-3">
	      <?php echo h($order['Quote']['Request']['quantity']); ?>
	    </div>

	    <div class="col-3 text-right light">
	      Precio Total
	    </div>
	    <div class="col-3">
	      <?php echo "$".h($order['Quote']['unitary_price'] * $order['Quote']['Request']['quantity']); ?>
	    </div>

	  </div>

	  <div class="row">
	  	<div class="col-3 text-right light">
	  		<label for="pay_date">Fecha de Pago</label>
	  	</div>
	  	<div class="col-3">
	  		<?php echo $order['Order']['due_date']?>
	  	</div>

	  	<div class="col-3 text-right light">
	    	Tipo de Producto
	    </div>
	    <div class="col-3">
	    	<?php echo h($tipos[$key]['type_name']);?>
	    </div>
	  </div>
	 </div>
	  <!-- Actions -->
	<div class="col-4 text-center inner-actions">
		<?php if(h($order['Order']['payed']) == 1)
		{
			echo '<div class="green">PAGADA</div>';
		}
		else if(h($order['Order']['cancelled']) == 1)
			{
				echo '<div class="red">CANCELADA</div>';
			}?>
	</div>
</div>

<?php endforeach; ?>
<?php echo $this->element('paginator'); ?>