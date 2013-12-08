
<div class="grey-container" >
  <h2>Tipo de Producto #<?php echo $type['Type']['id']  ; ?></h2>

  <div class="row">
    <div class="col-3 text-right light">
      Nombre
    </div>
    <div class="col-9">
      <?php echo $type['Type']['type_name']; ?>
    </div>
  </div>

  <!-- Atributos -->
  <div class="row">
    <div class="col-3 text-right light">
      Atributos
    </div>
    <div class="col-5">
      <table id="attributes_table" name="attributes_table" class="table table-condensed table-stripped">
        <tr>
          <th>nombre</th>
          <th>tipo</th>
          <th></th>
        </tr>

        <!-- atributos existentes -->
        <?php foreach ($type['Attribute'] as $attr): ?>

          <tr id = <?php echo $attr['name'] ?> >
            <td><?php echo $attr['name'] ?></td>

            <td>
              <?php
                switch($attr['data_type_id']){
                  case 1:
                    echo "Entero";
                    break;
                  case 2:
                    echo "Decimal";
                    break;
                  case 3:
                    echo "Texto";
                    break;
                  default:
                    echo "Fecha";
                    break;
                }
              ?>
            </td>
            <td>
              <!-- delete button -->
            </td>
          </tr>
        <?php endforeach; ?>

      </table>
    </div>
  </div>

  <div class="text-right">
    <?php echo $this->Html->link("Editar", array('action' => 'edit', $type['Type']['id']), array('class' => 'btn btn-success')); ?>
  </div>
</div>