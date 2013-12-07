<?php echo $this->AssetCompress->script('products-add'); ?>

<div class="grey-container add products">
  <h2>Nuevo Producto</h2>

  <div class="row">
    <div class="col-6">
      <?php echo $this->Form->create('Product', $options_for_form + array('id'=>'ProductAddForm')); ?>

      <?php echo $this->Form->input('manufacturer_id', array('type' => 'Text', 'label' => 'Numero Fabricante')); ?>
      <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="Numero de Pieza/ Original">
        <i class="icon-question"></i>
      </a>
      <br/>
      <?php echo $this->Form->input('generic', array('label' => array('class'=>'inline', 'text'=>'Generico'), 'class' => 'checkbox')); ?>
      <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Seleccionar si es de tipo generico">
        <i class="icon-question"></i>
      </a>


      <?php echo $this->Form->input('type_id',
          array('id' => 'type_id', 'onchange'=>"type_changed()", 'label' => 'Tipo Producto')); ?>
      <?php echo $this->Form->hidden('Attributes.attributes_values', array("id" => 'attributes_values')); ?>
      <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="Seleccionar tipo de producto">
        <i class="icon-question"></i>
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



