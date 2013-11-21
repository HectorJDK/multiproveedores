<div class="grey-container">

  <h2>Nueva Solicitud</h2>

  <?php 
  echo $this->Form->create('Request', $options_for_form);
  echo $this->Form->input('XML.cl-nombre', array('id' => 'cl-nombre', 'label' => 'Nombre Cliente'));
  echo $this->Form->input('XML.cl-numero', array('id' => 'cl-numero', 'label' => 'Numero de Contacto'));
  echo $this->Form->input('XML.pd-tipo', array('id' => 'pd-tipo', 'label' => 'Tipo de Producto'));
  echo $this->Form->input('Request.comment', array('label' => 'Comentarios', 'class' => 'input-block', 'rows' => 5));

  ?>
  <div class="text-right">
  <?php echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));?>
  </div>
</div>