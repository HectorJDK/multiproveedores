<div class="row striped" id = "<?php echo 'q-' . $quote['id']; ?>">
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
        <?php
            if (is_null($quote['product_id']))
            {
                ?>
                    <div class="col-3">
                        <input name="Identificador" id="<?php echo 'm-'. $quote['id']; ?>"/>
                    </div>
                    <div>
                        Precio
                        <input name="Precio" id="<?php echo 'p-' . $quote['id']; ?>"/>
                    </div>
                    <input value="Agregar producto" type="button" onclick="<?php echo 'setProductToQuote(' . $quote['id'] .')'; ?>"/>
                <?php
            }
            else
            {
                ?>
                    <div class="col-3">
                        <?php echo $this->Html->link($quote['Product']['manufacturer_id'], array('controller' => 'products', 'action' => 'view', $quote['product_id'])); ?>
                    </div>
                <?php
            }
        ?>
      </div>
    </div>
    <div class="col-4">

    <input type="radio" name="<?php echo('data[quotes]['.$quote['id'].']');?>" value="1" <?php echo is_null($quote['product_id'])? 'disabled' : ''; ?> >Aceptar</input>
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