<div class="grey-container">
  <h2>Producto #<?php echo $product['Product']['id']; ?></h2>
  <div class="row">
    <div class="col-9">

      <div class="row">
        <div class="col-3 text-right light">
          No. de Pieza
        </div>
        <div class="col-3">
          <?php echo $product['Product']['manufacturer_id']; ?>
        </div>
        
        <div class="col-3 text-right light">
          Tipo
        </div>
        <div class="col-3">
          <?php echo $this->Html->link($product['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $product['Type']['id'])); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 text-right light">
          Genérico
        </div>
        <div class="col-3">
          <?php 
            if ($product['Product']['generic'])
              echo 'Si';
            else
              echo 'No';
          ?>
        </div>
      </div>

      <div class-"row">
        <div class="col-3 text-right light">
          Atributos
        </div>
        <div class="col-9">
          <table id="attributes_table" name="attributes_table" class="table table-condensed table-stripped">
            <tr>
              <th>nombre</th>
              <th>valor</th>
            </tr>

            <!-- atributos existentes -->
            <?php foreach ($product['Attribute'] as $attribute): ?>

              <tr>
                <td><?php echo $attribute['name'] ?></td>

                <td>
                  <?php echo h($attribute['AttributesProduct']['value']); ?>
                </td>
              </tr>
            <?php endforeach; ?>
            
          </table>
        </div>
      </div>
    </div>

    <div class="col-3">
      <?php 

        echo $this->Html->link('Ver equivalencias', array('action' => 'has_as_equivalents', $product['Product']['id']), array('class' => 'btn btn-warning btn-block'));

        echo $this->Html->link('Editar', array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-success btn-block'));

        echo $this->Form->postLink('Eliminar', array('action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-danger btn-block') , __('Seguro que quiere eliminar el producto # %s?', $product['Product']['id'])); ?>
    </div>
  </div>

</div>
