<div class="pull-left grey-container">

  <h2>Nueva Solicitud</h2>

<?php 
  echo $this->Form->create('Request', $options_for_form);
  echo $this->Form->input('Request.category_id', array('label' => 'Categoría'));

  echo $this->Form->input('Request.note', array('label' => 'Notas', 'class' => 'input-block'));

  echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info')); 
?>
</div>

<?php echo $this->element('requests_actions'); ?>