<?php echo $this->AssetCompress->script('products-add'); ?>

<div class="grey-container">
  <h2>Nuevo Producto</h2>

  <div class="row">
    <div class="col-6">
      <?php echo $this->Form->create('Product', $options_for_form + array('id'=>'ProductAddForm')); ?>

      <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Numero de Pieza/ Original">
        <?php echo $this->Form->input('manufacturer_id', array('type' => 'Text', 'label' => 'Numero Fabricante')); ?>
      </a>
      <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Seleccionar si es de tipo generico">
        <?php echo $this->Form->input('generic', array('label' => 'Generico', 'class' => '')); ?>
      </a>

      <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Seleccionar tipo de producto">
        <?php echo $this->Form->input('type_id',
            array('id' => 'type_id', 'onchange'=>"type_changed()", 'label' => 'Tipo Producto')); ?>
        <?php echo $this->Form->hidden('Attributes.attributes_values', array("id" => 'attributes_values')); ?>
      </a>    
    </div>

    <div class="col-6" id="atributos">
      Atributos
      <hr />
    </div>
  </div>

  <div class="row text-right">
    <?php
      echo $this->Html->link("Cancelar", array('action' => 'index'), array('class' => 'btn btn-danger'));
      echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info')); 
    ?>
  </div>
</div>



