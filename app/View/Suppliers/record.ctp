<!-- uses $supplier, $payed_orders -->
<h2>Historial de <?php echo $supplier['corporate_name']; ?></h2><br/>
Cotizaciones aceptadas: <?php echo $supplier['accepted_quotes']; ?><br/>
Cotizaciones rechazadas: <?php echo $supplier['rejected_quotes']; ?><br/>
Deuda hacia el proveedor: <?php echo $supplier['debt']; ?><br/>
Total pagado al proveedor: <?php echo $supplier['payed']; ?><br/>
Rating promedio: <?php for($i = 1; $i <= $supplier['rating']; $i++){
                    echo "<i class=\"icon-star\"></i>";
                    }?>

<h3>Órdenes pagadas:</h3>

    <?php
        // echo $this->Html->tableHeaders(array('Producto', 'Precio unitario', 'Cantidad', 'Total', 'Rating', 'Fecha de pago')); //la fecha de pago es en realidad la última fecha de modificación. Debería de ser la fecha de pago, pues cuando se paga es la última vez que se moficida la orden.
        foreach ($payed_orders as $payed_order) : ?>
        <div class="row striped slim">
            <!-- INFO -->
            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                  Rating<?php for($i = 1; $i <= $payed_order->rating; $i++){
                        echo "<i class=\"icon-star\"></i>";
                        }?>
                    </div>
                    <div class="col-3    text-right light">
                      Fecha de creación
                    </div>
                    <div class="col-3 bold">
                        <?php echo $payed_order->date; ?>
                    </div>
                </div>

                <!-- Proveedor -->
                <div class="row">
                    <div class="col-3 text-right light">
                    Producto
                    </div>
                    <div class="col-9">
                      <?php echo $payed_order->product['manufacturer_id']; ?>
                    </div>

                    <div class="col-3 text-right light">
                      Precio Unitario
                    </div>
                    <div class="col-3">
                        <?php echo $payed_order->unitary_price; ?>
                    </div>

                <div class="row">
                    <div class="col-3 text-right light">
                      Cantidad
                    </div>
                    <div class="col-3">
                        <?php echo $payed_order->quantity; ?>
                    </div>

                    <div class="col-3 text-right light">
                      Precio Total
                    </div>
                    <div class="col-3">
                        <?php echo $payed_order->total; ?>
                    </div>
                </div>

                <?php
        endforeach;
    ?>


<?php echo $this->element('paginator'); ?>