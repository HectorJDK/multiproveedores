<div class="grey-container">

  <h2>Nueva Solicitud</h2>

  <?php 
  echo $this->Form->create('Request', $options_for_form);
  echo $this->Form->input('Request.note', array('label' => 'Notas', 'class' => 'input-block', 'rows' => 5));
  ?>
  <div class="text-right">
  <?php echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));?>
  </div>
</div>