<div class="grey-container">
  <h2>Nuevo Origen</h2>
  <?php echo $this->Form->create('Origin', $options_for_form);
    echo $this->Form->input('url', array('label' => 'Url'));
  ?>
  <div class="text-right">
  <?php
    echo $this->Html->link("Cancelar", array('action' => 'index'), array('class' => 'btn btn-danger'));
    echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));?>
  </div>
</div>


<?php echo $this->element('requests_actions'); ?>

