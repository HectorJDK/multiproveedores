<!-- uses $results, $request_id  -->
<?php echo $this->Html->script('suppliers-suppliers_for_category_product_type'); ?>


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
			<div class="col-3"> <?php echo $result->credit;?></div>
		</div>
		<div class="row">
			<div class="col-3 light">Rating</div>
			<div class="col-3"> <?php echo $result->rating; ?></div>
		</div>
		<div class="row">
			<div class="col-3 light">Comprado</div>
			<div class="col-3 green"><?php echo $result->payed; ?></div>
		</div>
		<div class="row">
			<div class="col-3 light">Adeudos</div>
			<div class="col-3 red"><?php echo $result->debt; ?></div>
		</div>
	<div class="col-4 text-center inner-actions">
		<button class="btn btn-info btn-large" data-furatto="modal" data-target="#modal-<?php echo $result->id?>" data-transition="8" data-theme="info">Enviar Cotización</button>		
	</div>
</div>
 <!-- Div de modal -->
 <div class="modal" id="modal-<?php echo $result->id;?>">
    <div class="modal-content">
      <h3>Enviar cotizaci&oacute;n</h3>
      <div>      	     	
  		Agregar descripci&oacute;n del producto      		
  		<textarea name="description-<?php echo $result->id;?>" id="description-<?php echo $result->id;?>" rows="4" cols="50"></textarea>
	    <button class="btn-info" onclick='enviar_cotizacion(<?php echo ($request_id . ', '. $result->id) ?>)'>Enviar</button>
    	<button class="modal-close btn btn-danger">Cancelar</button>	
      </div>
    </div>
  </div>
 <?php endforeach; ?>
