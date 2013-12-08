<!-- uses 'original', 'equivalency_relations' -->
<?php echo $this->Html->script('products-has_as_equivalents'); ?>

<div class="row">
  <div class="col-8">
    <div class="grey-container mini">
      <h3>Producto #<?php echo $original['Product']['id']; ?></h3>
      <div class="row">
        <div class="col-3 text-right light">
          No. de Pieza
        </div>
        <div class="col-3">
          <?php echo $original['Product']['manufacturer_id']; ?>
        </div>

        <div class="col-3 text-right light">
          Tipo
        </div>
        <div class="col-3">
          <?php echo $this->Html->link($original['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $original['Type']['id'])); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 text-right light">
          Genérico
        </div>
        <div class="col-3">
          <?php 
            if ($original['Product']['generic'])
              echo 'Si';
            else
              echo 'No';
          ?>
        </div>
      </div>

      <div class="row">
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
            <?php foreach ($original['Attribute'] as $attribute): ?>

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
  </div>
</div>

<div class="row">
  <div class="col-8">
    <h4>Equivalencias:</h4>

    <?php echo $this->Form->hidden('original_id', array('id' => 'original_id', 'value' => $original['Product']['id'])); ?>
    <?php echo $this->Form->hidden('original_manufacturer_id', array('id' => 'original_manufacturer_id', 'value' => $original['Product']['manufacturer_id'])); ?>
    <table class="table table-striped">
        <?php foreach($equivalency_relations as $relation) :?>
          <tr>
            <td>
              <?php echo $this->Html->link($relation['Equivalent']['manufacturer_id'], array('action' => 'view', $relation['Equivalent']['id'])); ?>
            </td>
            <td width="220px;">
              <a style="color:#e74c3c;" onclick="delete_equivalency_between_original_and_equivalent(<?php echo $relation['Equivalent']['id']; ?>)">
                <i class="icon-remove">Eliminar equivalencia</i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->element('paginator'); ?>
  </div>
  <div class="col-4 text-right">
    <h4 class='light' style="display: block; margin-bottom: 10px;">Añadir equivalencia:</h4>
    <div class="form-fields" style="display: inline;">
      <input type="text" id="new_equivalent_manufacturer_id" /> 
    </div>
    <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="Escribe No. de Pieza del producto que se desea agregar como equivalencia">
      <i class="icon-question"></i>
    </a>
    <br/>
    <button onclick="add_product_as_equivalent_of_this()" class="btn btn-warning btn-small">Añadir</button>
  </div>
</div>