<?php echo $this->AssetCompress->script('products-edit'); ?>

<div class="grey-container products add">
  <h2>Editar Producto #<?php echo $product['Product']['id']; ?></h2>
  <div class="row">
    <?php
      echo $this->Form->hidden('product', array('id'=>'product', 'value' => json_encode($product)));
      echo $this->Form->create('Product', $options_for_form);
      echo $this->Form->hidden('id', array('id'=>'id', 'value' => $product['Product']['id']));

      echo $this->Form->input('Numero de pieza', array(
        'label' => 'No. de Pieza',
        'name' => 'data[Product][manufacturer_id]',
        'value' => $product['Product']['manufacturer_id']));
    ?>
    <br />
    <?php 
      echo $this->Form->input('generic', array(
        'label' => array('class'=>'inline', 'text'=>'Genérico'), 
        'class' => 'checkbox',
        'name' => 'data[Product][generic]',
        'type' => 'checkbox',
        'checked' => $product['Product']['generic']? '1' : '0')); ?>
      <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Seleccionar si es de tipo generico">
        <i class="icon-question"></i>
      </a>
    <br />
    <br />
    <span class='light'>Tipo de producto: </span> <?php echo $this->Html->link($product['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $product['Type']['id'])); ?>

    <br />
    <br />
    <div id="attributes">
      Atributos
    </div>
  </div>

  <div class="row text-right">
    <?php
      echo $this->Html->link("Cancelar", array('action' => 'index'), array('class' => 'btn btn-danger'));
      echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
    ?>
  </div>
</div>
