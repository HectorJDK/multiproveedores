<?php echo $this->Html->script('suppliers-suppliers_for_category_product_type'); ?>

<!-- uses $results, $request_id  -->
request id: <?php echo  $request_id ?>

<?php foreach ($results as $result): ?>
<div class="row striped slim">
	<div class="col-8">
		<div class="row">
			<h2><?php echo $result->corporate_name; ?></h2>
		</div>
		<div class="row">
			<div class="col-3 light"> Correo Contacto </div>
			<div class="col-3"> <?php echo $result->contact_email; ?> </div>
		</div>
		<div class="row">
			<div class="col-3 light"> Nombre de Contacto</div>
			<div class="col-3"> <?php echo $result->contact_name; ?> </div>
		</div>
		<div class="row">
			<div class="col-3 light"> Telefono </div>
			<div class="col-3"> <?php echo $result->contact_telephone; ?> </div>
		</div>
		<div class="row">
			<div class="col-3 light">Credito</div>
			<div class="col-3"> <?php echo $result->credit;?>
		</div>
	</div>
	<div class="col-4 text-center inner-actions">
		<button class="btn " onclick='enviar_cotizacion(<?php echo ($request_id . ', '. $result->id) ?>)'>Enviar Cotización</button>
	</div>
</div>

 <?php endforeach; ?>