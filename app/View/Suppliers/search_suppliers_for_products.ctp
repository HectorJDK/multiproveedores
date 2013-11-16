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
		</div>
	</div>
<?php endforeach; ?>