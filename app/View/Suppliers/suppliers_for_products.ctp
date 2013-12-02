<?php echo $this->Html->script('suppliers-suppliers_for_products'); ?>
<h2>Resultados de Búsqueda por Producto</h2>
<?php foreach($suppliers_products as $sp): ?>

	<div class="row striped slim">
		<div class="col-8">
			<div class="row">
				<div class="col-3 light">
					Contacto
				</div>
				<div class="col-3">
					<?php echo $sp->supplier_result->contact_email; ?>
				</div>

                <div class="col-3 light text-right">
                    Pagado
                </div>
                <div class="col-3">
                    <?php echo $sp->supplier_result->payed; ?>
                </div>
			</div>

			<div class="row">
				<div class="col-3 light">
					Proveedor
				</div>
				<div class="col-3">
    				<?php echo $sp->product_result->manufacturer_id; ?>
    			</div>

                <div class="col-3 light text-right">
                    Por pagar

                </div>
                <div class="col-3">
                    <?php echo $sp->supplier_result->debt; ?>
                </div>
    		</div>

    		<div class="row">
    			<div class="col-3 light">
    				Precio
    			</div>
    			<div class="col-3">
					<?php echo $sp->price; ?>
				</div>

                <div class="col-3 text-right light">
                    Rating
                </div>
			</div>



		</div>
		<button class="btn btn-info" onclick='enviar_cotizacion(<?php echo ($request_id . ', ' . $sp->supplier_result->id . ', '. $sp->product_result->id) ?>)'>Enviar Cotización</button>
	</div>
<?php endforeach; ?>