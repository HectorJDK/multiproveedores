<h2>Ordenes por Cerrar</h2>

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
	      <?php echo $this->Html->link($order['Quote']['product_id'], array('controller' => 'products', 'action' => 'view', $order['Quote']['product_id'])); ?>
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
	  <hr />

	  <!-- Rating -->
	  <form id='<?php echo $order['Order']['id']?>' action ="/multiproveedores/orders/orderToClose/" method="POST" >
	  <input type="hidden" name="order_id" value="<?php echo $order['Order']['id']?>"/>
	  <div class="row">
	  	<div class="col-2 text-right light">
	  		<label for="rating">Rating</label>
	  	</div>
	  	<div class="col-1">
	  		 <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Calidad del servicio en general del 1 al 5 (5 siendo la mejor calidad)">
	  			<input type="text" name="rating_<?php echo $order['Order']['id']?>" class="input-large"/>
			</a>
	  	</div>
	  	<div class="col-2 text-right light">
	  		<label for="delivery_date">Fecha de Entrega</label>
	  	</div>
	  	<div class="col-2">
	  		<input type="text" name="delivery_date_<?php echo $order['Order']['id']?>" class="input-block" data-datepicker/>
	  	</div>
	  	<div class="col-2 text-right light">
	  		<label for="pay_date">Fecha de Pago</label>
	  	</div>
	  	<div class="col-2">
	  		<input type="text" name="pay_date_<?php echo $order['Order']['id']?>" class="input-block" data-datepicker/>
	  	</div>
	  	<div class="col-1"></div>
	  </div>
	  <!-- Actions -->
	<div class="col-4 text-center inner-actions">
		<button type="submit" class="btn btn-info btn-block"><i class="icon-ok"></i>Generar Cuenta por Pagar</button>
		</form>
		<?php 
		echo $this->Form->postLink(__('<i class="icon-remove"></i>Cancelar Orden de Compra'), array('controller' => 'orders', 'action' => 'cancel', $order['Order']['id'], 'index'), array('class' => "btn btn-danger btn-block", 'escape'=>false));
		?>		
	</div>
	
	</div>

	
</div>

<?php endforeach; ?>
<?php echo $this->element('paginator'); ?>