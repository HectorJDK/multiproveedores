<h3>Cotizaciones Pendientes</h3>

<div class="filters">
	<span>Ordenar por:</span>
	<ul class="pagination pagination-inverse">
		<li><?php echo $this->Paginator->sort('created', 'Fecha'); ?></li>
	</ul>
</div>

<?php foreach ($requests as $request): ?>
<form id="<?php echo $request['Request']['id'] ?>" method="post" action="quotes/processQuotes">
    <input type="hidden" name="data[request_id]" value="<?php echo $request['Request']['id'] ?>"/>
	<div class="row slim">
		<!-- Request -->
		<div class="row striped shaded">
			<div class="col-6">
				<?php echo $this->Html->link("Solicitud #".$request['Request']['id'], array('controller' => 'requests', 'action' => 'view', $request['Request']['id'])); ?>
			</div>
		  <div class="col-3">
		  	Fecha de creación: <?php echo $this->Time->format($request['Request']['created'], '%d/%m/%y', 'invalid'); ?>
		  </div>

		  <div class="col-3">
		  	<input type='submit' class="btn btn-small btn-info" value='Procesar Orden de Compra'/input>
		  </div>
		</div>

		<?php foreach ($request['Quote'] as $quote): ?>
		<div class="row striped">
			<div class="col-8">
			 	<div class="row">
			 		<div class="col-5">
			      Cotizacion #<?php echo h($quote['id']); ?>
					</div>
			    <div class="col-5 text-right light">
			      Fecha de creación
			    </div>
			    <div class="col-2 bold">
			      <?php echo $this->Time->format($quote['created'], '%d/%m/%y', 'invalid'); ?>
			    </div>

			  </div>

			  <!-- Detalle -->
			  <div class="row">
			  	<div class="col-3 text-right light">
		      	Proveedor
		    	</div>
		    	<div class="col-3">
		      	<?php echo $this->Html->link($quote['supplier_id'], array('controller' => 'suppliers', 'action' => 'view', $quote['supplier_id'])); ?>
		    	</div>
		    	<div class="col-3 text-right light">
		      	Producto
		    	</div>
		    	<div class="col-3">
		      	<?php echo $this->Html->link($quote['product_id'], array('controller' => 'products', 'action' => 'view', $quote['product_id'])); ?>
		    	</div>
			  </div>
			</div>
			<div class="col-4">


            <input type="radio" name="<?php echo('data[quotes]['.$quote['id'].']');?>" value="1">Aceptar</input>
				<hr />
				<p>Rechazar por:</p>
				<ul class="unstyled">
					<li><input type="radio" name="<?php echo('data[quotes]['.$quote['id'].']');?>" value="2" checked='checked'>Precio</input></li>
					<li><input type="radio" name="<?php echo('data[quotes]['.$quote['id'].']');?>" value="3">Sin Existencias</input></li>
					<li><input type="radio" name="<?php echo('data[quotes]['.$quote['id'].']');?>" value="4">Sin Respuesta</input></li>
					<li><input type="radio" name="<?php echo('data[quotes]['.$quote['id'].']');?>" value="5">Tiempo entrega</input></li>
				</ul>

			</div>
		</div>
		<?php endforeach;?>
	</div>
</form>
<?php endforeach; ?>
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