<h1>Ordenes por Cerrar</h3>

<div class="filters">
	<span>Ordenar por:</span>
	<ul class="pagination pagination-inverse">
		<li><?php echo $this->Paginator->sort('created', 'Fecha'); ?></li>
	</ul>
</div>

<?php foreach ($orders as $order): ?>
<div class="row striped slim">
	<!-- INFO -->
	<div class="col-8">
		<div class="row">
			<div class="col-12">
	      Orden #<?php echo h($order['Order']['id']); ?>
	    </div>
		</div>
	 	<div class="row">
	    <div class="col-9 text-right light">
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
	      <?php echo $this->Html->link($order['Quote']['product_id'], array('controller' => 'products', 'action' => 'view', $order['Quote']['product_id'])); ?>
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
	  <hr />

	  <!-- Rating -->
	  <form id=<?php echo "order-".$order['Order']['id'] ?>  >
	  <div class="row">
	  	<div class="col-2 text-right light">
	  		<label for="rating">Rating</label>
	  	</div>
	  	<div class="col-1">
	  		<input type="text" id="rating" class="input-large"/>
	  	</div>
	  	<div class="col-2 text-right light">
	  		<label for="delivery_date">Fecha de Entrega</label>
	  	</div>
	  	<div class="col-2">
	  		<input type="text" id="delivery_date" class="input-block" data-datepicker/>
	  	</div>
	  	<div class="col-2 text-right light">
	  		<label for="pay_date">Fecha de Pago</label>
	  	</div>
	  	<div class="col-2">
	  		<input type="text" id="pay_date" class="input-block" data-datepicker/>
	  	</div>
	  	<div class="col-1"></div>
	  </div>
	  </form>		
	</div>

	<!-- Acctions -->
	<div class="col-4 text-center inner-actions">
		<button class="btn btn-info btn-block"><i class="icon-ok"></i>Generar Cuenta por Pagar</button>
		<button class="btn btn-danger btn-block"><i class="icon-remove"></i>Cancelar Orden de Compra</button>
	</div>
</div>
<?php endforeach; ?>

</div>

<ul class="pagination pagination-center">
	<p class="light">
	<?php 
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}. Mostrando {:current} records de {:count} en total'))); ?>
	</p>
	<?php
	echo $this->Paginator->prev('' . __('< '), array(), null, array('class' => 'previous'));
	echo $this->Paginator->numbers(array('separator' => ' '));
	echo $this->Paginator->next(__('') . ' >', array(), null, array('class' => 'next disabled')); ?>
</ul>