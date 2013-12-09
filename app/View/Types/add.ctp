<?php echo $this->Html->script('types-add'); ?>
<div class="col-2">
  <?php echo $this->element('products_actions'); ?>
</div>

<div class="col-10">
  <div class="grey-container add">
    <div class="row">
      <h3>Nuevo Tipo de Producto</h3>
      <div class="col-6">
        <?php echo $this->Form->create('Type', $options_for_form); ?>

        <?php echo $this->Form->input('type_name', array('label' => 'Nombre')); ?>
          <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="Nombre de tipo de producto">
            <i class="icon-question"></i>
          </a>

          <?php echo $this->Form->hidden('attributes', array("id" => 'attributes')); ?>

      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <p>Atributos</p>
        <table id="attributes_table" name="attributes_table" class="table table-condensed table-stripped">
          <tr>
            <th>nombre</th>
            <th>tipo</th>
            <th></th>
          </tr>

        </table>
      </div>
      <div class="col-1"></div>
      <div class="col-5">
        Añadir atributo
        <hr />
        Nombre
        <input type="text" id="attribute_name" required="required"/>
      <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="Nombre de atributo a agregar">
        <i class="icon-question"></i>
      </a>
      <br/>
        Tipo de Dato
        <?php echo $this->Form->select('Tipo', $data_types, array('id' => 'attribute_type', 'empty' => "Seleccionar")); ?>

        <input type="button" value="Añadir atributo" onClick="add_attribute()" class="btn btn-mini btn-warning" />
      </div>
    </div>
    <div class="row text-right">
      <?php
        echo $this->Html->link("Cancelar", array('action' => 'index'), array('class' => 'btn btn-danger'));
        echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
      ?>
    </div>
  </div>
</div>