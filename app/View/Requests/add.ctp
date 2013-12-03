<?php echo $this->element('requests_actions'); ?>

<div class="grey-container">
  <h2>Nueva Solicitud</h2>

  <?php echo $this->Form->create('Request', $options_for_form);  ?>

   <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Escriba el nombre del cliente que pide la solicitud"><?php echo $this->Form->input('XML.cl-nombre', array('id' => 'cl-nombre', 'label' => 'Nombre Cliente')); ?></a>

   <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Escriba el numero de contacto del cliente"><?php echo $this->Form->input('XML.cl-numero', array('id' => 'cl-numero', 'label' => 'Numero de Contacto'));?></a>

  <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Escriba el tipo de producto del cual se hace la solicitud"><?php echo $this->Form->input('XML.pd-tipo', array('id' => 'pd-tipo', 'label' => 'Tipo de Producto'));?></a>

  <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Espacio para comentarios acerca de esta solicitud"> <?php echo $this->Form->input('Request.comment', array('label' => 'Comentarios', 'class' => 'input-block', 'rows' => 5));?></a>

  <div class="text-right">
  <?php
    echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
  ?>
  </div>
</div>