<div class="grey-container">

  <h2>Nueva Solicitud</h2>

  <?php echo $this->Form->create('Request', $options_for_form);  ?>
  <?php
  echo $this->Form->input('XML.cl-nombre', array('id' => 'cl-nombre', 'label' => 'Nombre Cliente')); ?>
   <span class="help-block">Escriba el nombre del cliente al cual se le esta creando la solicitud.</span>
   <?php echo $this->Form->input('XML.cl-numero', array('id' => 'cl-numero', 'label' => 'Numero de Contacto'));?>
   <span class="help-block">Escriba el número del cliente con el cual se puede contactar al cliente.</span>
  <?php echo $this->Form->input('XML.pd-tipo', array('id' => 'pd-tipo', 'label' => 'Tipo de Producto'));?>
   <span class="help-block">Escriba el tipo de producto que el cliente pide.</span>
  <?php echo $this->Form->input('Request.comment', array('label' => 'Comentarios', 'class' => 'input-block', 'rows' => 5));?>
   <span class="help-block">Espacio para comentarios acerca de esta solicitud.</span>

  <div class="text-right">
  <?php
    echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
  ?>
  </div>
</div>