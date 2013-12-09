<?php echo $this->Html->script('suppliers-suppliers_for_products'); ?>
<h2>Resultados de Búsqueda por Producto</h2>
<?php foreach($suppliers_products as $sp): ?>

	<div class="row striped slim">
		<div class="col-8">
            <div class="row">
                <div class="col-6">
                    <h4><?php echo $sp->supplier_result->corporate_name; ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-3 light">
                    Numero de Pieza
                </div>
                <div class="col-3">
                    <?php echo $sp->product_result->manufacturer_id; ?>
                </div>
                <div class="col-3 text-right light">
                    Credito
                </div>
                <div class="col-3">
                    <?php if($sp->supplier_result->credit > 0)
                    {
                        echo "Si";
                    }
                    else
                    {
                        echo "No";
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3 light">
                    Atributos
                </div>
                <table class="col-3 table condensed striped">
                    <?php foreach ($sp->product_result->attributes as $attribute) { ?>
                    <tr>
                        <td>
                            <?php echo $attribute[1]; ?>
                        </td>

                        <td>
                            <?php echo $attribute[2]; ?>
                        </td>
                    </tr>

                    <?php }; ?>
                </table>
            </div>
			<div class="row">
                <div class="col-3 light">
                    Precio
                </div>
                <div class="col-3">
                    <?php echo $sp->price; ?>
                </div>

                <div class="col-3 light text-right">
                    Pagado
                </div>
                <div class="col-3 green">
                    <?php echo $sp->supplier_result->payed; ?>
                </div>
			</div>

			<div class="row">
                <div class="col-3 light">
                    Correo Contacto
                </div>
                <div class="col-3">
                    <?php echo $sp->supplier_result->contact_email; ?>
                </div>

                <div class="col-3 light text-right">
                    Por pagar

                </div>
                <div class="col-3 red">
                    <?php echo $sp->supplier_result->debt; ?>
                </div>
    		</div>
            <div class="row">
                <div class="col-3 light">
                    Telefono
                </div>
                <div class="col-3">
                    <?php echo $sp->supplier_result->contact_telephone;?>
                </div>
            </div>
    		<div class="row">
                <div class="col-3 light">
                    Razon de Cotizaciones
                </div>
                <div class="col-3">
                <span class="green"> <?php echo $sp->supplier_result->accepted_quotes; ?></span> de <?php $total_quotes = $sp->supplier_result->accepted_quotes + $sp->supplier_result->rejected_quotes; echo $total_quotes;?>
                 <a href="#" class="red" data-toggle="tooltip" data-placement="right" title="" data-original-title=<?php echo 'Por'.'&nbsp;'.'precio:'.$sp->supplier_result->rejected_price.','.'&nbsp;'.'Por'.'&nbsp;'.'Existencia:'.$sp->supplier_result->rejected_existance.','. '&nbsp;', 'Por'.'&nbsp;'.'Tiempo'.'&nbsp;'.'de'.'&nbsp;'.'Respuesta:'.$sp->supplier_result->rejected_response,',', '&nbsp;', 'Por'.'&nbsp;'.'Tiempo'.'&nbsp;'.'de'.'&nbsp;'.'Entrega:'.$sp->supplier_result->rejected_deliver ;?>>
              <i class="icon-arrow-down"></i>
            </a>
            </div>

                <div class="col-3 text-right light">
                    Rating
                </div>
			</div>



		</div>
        <div class="col-4 text-center inner-actions">
		  <button class="btn btn-info" onclick='enviar_cotizacion(<?php echo ($request_id . ', ' . $sp->supplier_result->id . ', '. $sp->product_result->id) ?>)'>Enviar Cotización</button>
        </div>
	</div>
<?php endforeach; ?>