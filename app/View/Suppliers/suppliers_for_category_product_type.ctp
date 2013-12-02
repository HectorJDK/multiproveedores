<!-- uses $results, $request_id  -->
<?php echo $this->Html->script('suppliers-suppliers_for_category_product_type'); ?>
<h2>Resultados de Búsqueda por Tipo</h2>

<?php foreach ($results as $result): ?>

<div class="row striped slim">
	<div class="col-8">
		<div class="row">
			<div class="col-6">
				<h4><?php echo $result->corporate_name; ?></h4>
			</div>
		</div>
		<div class="row">
			<div class="col-3 light"> Correo Contacto </div>
			<div class="col-3"> <?php echo $result->contact_email; ?> </div>

			<div class="col-3 light text-right">Credito</div>
			<div class="col-3"> <?php echo $result->credit;?></div>
		</div>
		<div class="row">
			<div class="col-3 light"> Nombre de Contacto</div>
			<div class="col-3"> <?php echo $result->contact_name; ?> </div>

			<div class="col-3 light text-right">Rating</div>
			<div class="col-3">
				<?php for($i = 1; $i <= $result->rating; $i++)
				{
            		echo "<i class=\"icon-star\"></i>";
          		}
        		?>
      		</div>
		</div>

		<div class="row">
			<div class="col-3 light"> Telefono </div>
			<div class="col-3"> <?php echo $result->contact_telephone; ?> </div>

			<div class="col-3 light text-right">Comprado</div>
			<div class="col-3 green"><?php echo $result->payed; ?></div>
		</div>

		<div class="row">
			<!-- Aqui se deben de mostrar las cotizaciones perdidas -->
			<div class="col-3 light">
				Cotizaciones Perdidas:
			</div>
			<div class="col-3"></div>

			<div class="col-3 light text-right">Adeudos</div>
			<div class="col-3 red"><?php echo $result->debt; ?></div>
		</div>
	<div class="col-4 text-center inner-actions">
		<button class="btn btn-info" data-furatto="modal" data-target="#modal-<?php echo $result->id?>" data-transition="8" data-theme="info">Enviar Cotización</button>
	</div>
</div>
 <!-- Div de modal -->
 <div class="modal" id="modal-<?php echo $result->id;?>">
    <div class="modal-content">
      <h3 class="modal-header">Enviar cotizaci&oacute;n</h3>
      <div>
  		Agregar descripci&oacute;n del producto
  		<textarea name="description-<?php echo $result->id;?>" id="description-<?php echo $result->id;?>" rows="4" cols="50"></textarea>
	    <button class="btn btn-info" onclick='enviar_cotizacion(<?php echo ($request_id . ', '. $result->id) ?>)'>Enviar</button>
    	<button class="modal-close btn btn-danger">Cancelar</button>
      </div>
    </div>
  </div>
 <?php endforeach; ?>
