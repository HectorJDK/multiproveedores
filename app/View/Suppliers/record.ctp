<!-- uses $supplier, $payed_orders -->
<h2>Historial de <?php echo $supplier['corporate_name']; ?></h2><br/>
Cotizaciones aceptadas: <?php echo $supplier['accepted_quotes']; ?><br/>
Cotizaciones rechazadas: <?php echo $supplier['rejected_quotes']; ?><br/>
Deuda hacia el proveedor: <?php echo $supplier['debt']; ?><br/>
Total pagado al proveedor: <?php echo $supplier['payed']; ?><br/>

<h3>Órdenes pagadas:<h3>
<table>
    <?php
        echo $this->Html->tableHeaders(array('Producto', 'Precio unitario', 'Cantidad', 'Total', 'Rating', 'Fecha de pago')); //la fecha de pago es en realidad la última fecha de modificación. Debería de ser la fecha de pago, pues cuando se paga es la última vez que se moficida la orden.
        foreach ($payed_orders as $payed_order) :
            echo $this->Html->tableCells(
                array(
                    $payed_order->product['manufacturer_id'],
                    $payed_order->unitary_price,
                    $payed_order->quantity,
                    $payed_order->total,
                    $payed_order->rating,
                    $payed_order->date
                )
            );
        endforeach;
    ?>
</table>

<?php echo $this->element('paginator'); ?>