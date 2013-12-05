
<?php echo "<pre>".print_r($quote,TRUE),"</pre>";?>
<div class="grey-container">
  <h2> Generar Orden de Compra </h2>
  <div class="row">
    <div class="col-6">

      <!-- PROVEEDOR ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Proveedor
        </div>

        <div class="col-8">
          <?php echo $quote["Supplier"]["corporate_name"];?>
        </div>
      </div>

      <!-- PRODUCTO ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Producto
        </div>

        <div class="col-8">
          <?php echo $quote["Product"]["manufacturer_id"];?>
        </div>
      </div>

      <!-- CANTIDAD ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Cantidad
        </div>

        <div class="col-8">
           <?php echo $quote["Request"]["quantity"];?>
        </div>
      </div>

      <!-- Atributos ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Atributos
        </div>
      </div>

      <div class="row">
        <div class="col-1"></div>
        <div class="col-11">
          <table class="table table-condensed table-bordered">
            <?php foreach($quote["Product"]["Attribute"] as $attribute){?>
                <tr>
                  <td><?php echo $attribute["name"];?></td>
                  <td><?php echo $attribute["AttributesProduct"]["value"];?></td>
                </tr>
            <?php }?>           
          </table>
        </div>
      </div>

      <!-- PRECIO UNITARIO ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Precio Unitario
        </div>

        <div class="col-8">
          $<?php echo $quote["Quote"]["unitary_price"];?>
        </div>
      </div>

      <!-- PRECIO UNITARIO ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Precio Total
        </div>

        <div class="col-8 red">
          $<?php echo $quote["Quote"]["unitary_price"]*$quote["Request"]["quantity"];?>
        </div>
      </div>

      
    </div>

    <div class="col-6">
      <?php 
        echo $this->Form->create('Quote', array("action"=>"processQuotes"));        
        echo $this->Form->input('request_id', array('type' => 'hidden', 'value'=>$quote["Quote"]["id"]));
        echo $this->Form->input('logistics', array('label' => 'Logística de Envio', 'class' => 'input-block', 'rows' => 12));
      ?>

      <div class="form-fields">
        <label for="order_email_copy">Con copia:</label>
        <input id="order_email_copy" name="order_email_copy" type="text" class="input-block" />
      </div>

      <div class="text-right">
        <?php
          echo $this->Form->end(array('label' => 'Enviar Orden de Compra', 'div' => false, 'class' => 'btn btn-success')); 
        ?>
      </div>
    </div>
  </div>
</div>