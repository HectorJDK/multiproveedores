<?php echo $this->Html->script('suppliers-suppliers_for_products'); ?>
<?php foreach($suppliers_products as $sp): ?>
	<div class="row striped slim">
		<div class="col-8">
			<div class="row">
				<div class="col-3 text-right light">
					Contacto
				</div>
				<div class="col-3">
					<?php echo $sp->supplier_result->contact_email; ?>
				</div>
			</div>

			<div class="row">
				<div class="col-3 text-right light">
					Proveedor
				</div>
				<div class="col-3">
    				<?php echo $sp->product_result->manufacturer_id; ?>
    			</div>
    		</div>

    		<div class="row">
    			<div class="col-3 text right light">
    				Precio
    			</div>
    			<div class="col-3">
					<?php echo $sp->price; ?>
				</div>
			</div>
			<div class="row">
                <div class="col-3 text right light">
                    Pagado
                </div>
                <div class="col-3">
                    <?php echo $sp->supplier_result->payed; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3 text right light">
                    Por pagar

                </div>
                <div class="col-3">
                    <?php echo $sp->supplier_result->debt; ?>
                </div>
            </div>
		</div>
		<button class="btn " onclick='enviar_cotizacion(<?php echo ($request_id . ', ' . $sp->supplier_result->id . ', '. $sp->product_result->id) ?>)'>Enviar Cotización</button>
	</div>
<?php endforeach; ?>