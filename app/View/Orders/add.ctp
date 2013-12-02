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
          Ana's Repair
        </div>
      </div>

      <!-- PRODUCTO ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Producto
        </div>

        <div class="col-8">
          1
        </div>
      </div>

      <!-- CANTIDAD ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Cantidad
        </div>

        <div class="col-8">
          3
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
            <tr>
              <td>Watts</td>
              <td>50</td>
            </tr>

            <tr>
              <td>Color</td>
              <td>amarillo azul verd</td>
            </tr>
            <tr>
              <td>Vida</td>
              <td>5 años</td>
            </tr>
          </table>
        </div>
      </div>

      <!-- PRECIO UNITARIO ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Precio Unitario
        </div>

        <div class="col-8">
          $5.00
        </div>
      </div>

      <!-- PRECIO UNITARIO ******************************** -->
      <div class="row">
        <div class="col-4 text-right light">
          Precio Total
        </div>

        <div class="col-8 red">
          $15.00
        </div>
      </div>

      
    </div>

    <div class="col-6">
      <?php 
        echo $this->Form->create('Order', $options_for_form);
        echo $this->Form->input('logistics', array('label' => 'Logística de Envio', 'class' => 'input-block', 'rows' => 12));
      ?>

      <div class="form-fields">
        <label for="order_email_copy">Con copia:</label>
        <input id="order_email_copy" type="text" class="input-block" />
      </div>

      <div class="text-right">
        <?php
          echo $this->Form->end(array('label' => 'Enviar Orden de Compra', 'div' => false, 'class' => 'btn btn-success')); 
        ?>
      </div>
    </div>
  </div>
</div>