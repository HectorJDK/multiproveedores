<div class="col-2">
  <?php echo $this->element('products_actions'); ?>
</div>

<div class="col-10">
  <div class="grey-container">
    <div class="row">
      <h3>Editar Tipo de Producto #<?php echo $type['Type']['id']; ?></h3>
      <div class="col-6">
        <?php echo $this->Form->create('Type', $options_for_form);
          echo $this->Form->input('type_name', array('label' => 'Nombre'));
        ?>
      </div>

      <div class="col-6">
        <p>Atributos</p>
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
    <div class="row text-right">
      <?php echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info')); ?>
    </div>         
  </div>
</div>