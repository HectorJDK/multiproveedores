<?php echo $this->Html->script('types-add'); ?>

<div class="grey-container">
  <div class="row">
    <h3>Nuevo Tipo de Producto</h3>
    <div class="col-6">
      <?php echo $this->Form->create('Type');
        echo $this->Form->input('type_name', array('label' => 'Nombre'));
        echo $this->Form->hidden('attributes', array("id" => 'attributes')); 
      ?>
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
      <p>Añadir atributo</p>
      Nombre <input type="text" id="attribute_name" required="required"/>
      Tipo de Dato
      <?php echo $this->Form->select('Tipo', $data_types, array('id' => 'attribute_type', 'empty' => "Seleccionar")); ?>

      <input type="button" value="Añadir atributo" onClick="add_attribute()" class="btn btn-mini btn-warning" />
    </div>   
  </div>
  <div class="row">
    <?php echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info')); ?>
  </div>         
</div>