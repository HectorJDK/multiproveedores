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
        <?php echo $this->Html->link($quote['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $quote['supplier_id'])); ?>
        </div>

       
      </div>

      <div class="row">
          <div class="col-3 text-right light">
            RFC
        </div>
        <div class="col-3">
            <?php echo $quote['Supplier']['moral_rfc']; ?>
        </div>
        <?php if(isset($quote['Product']['type_id'])){?>
        <div class="col-3 text-right light">
            Tipo de Producto
        </div>
        <div class="col-3">
            <?php echo $quote['Product']['type_id']?>
        </div>
        <?php }?>
 
      </div>

      <div class="row">
          <div class="col-3 text-right light">
              Credito
          </div>
          <div class="col-3">
              <?php
                if($quote['Supplier']['credit'] != 0){
                    echo 'Si';
                }
                    else {
                        echo "No";
                    }?>
          </div>
          <?php if(isset($quote['Product']['manufacturer_id'])){?>
          <div class="col-3 text-right light">
              Numero de Pieza
          </div>
          <div class="col-3">
              <?php echo $quote['Product']['manufacturer_id']; ?>
          </div>
          <?php } else { ?>
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
                   
          <?php } else { ?>
                    <div class="col-3">
                        <?php echo $this->Html->link($quote['Product']['manufacturer_id'], array('controller' => 'products', 'action' => 'view', $quote['product_id'])); ?>
                    </div>
          <?php } ?>
        <?php }?>
          
      </div>

      <div class="row">
          <div class="col-3 text-right light">
              Rating
          </div>
          <div class="col-3">
            <?php for($i = 1; $i <= $quote['Supplier']['rating']; $i++){
            echo "<i class=\"icon-star\"></i>";
          }
          ?>
          </div>
            <?php if (is_null($quote['product_id'])){?>
           <div class="col-3 text-right light">
                        Precio
                      </div>
                        <div class="col-3">
                        <input name="Precio" id="<?php echo 'p-' . $quote['id']; ?>"/>
                      </div>
                      <div class="col-3 text-right light">
                       
                      </div>
                    <div class="col-3 text-right light">
                    <input value="Agregar producto" type="button" onclick="<?php echo 'setProductToQuote(' . $quote['id'] .')'; ?>"/>
                  </div>
                    <?php }?>
      </div>

      <div class="row">
          <div class="col-3 text-right light">
              Adeudo
          </div>
          <div class="col-3 red">
              <?php echo $quote['Supplier']['debt']?>
          </div>
      </div>

      <div class="row">
          <div class="col-3 text-right light">
              Razon de Perdida
          </div>
          <div class="col-3">
            <?php echo ($quote['Supplier']['accepted_quotes'] / $quote['Supplier']['rejected_quotes'])?>
          </div>
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