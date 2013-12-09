<div class="col-2">
  <ul class="dropdown-menu actions">
    <h4 class="text-center light">Acciones</h4>
    <li><?php echo $this->Html->link('Correo 1', array('controller' => 'emails', 'action'=>'edit',1)); ?></li>
    <li><?php echo $this->Html->link('Correo 2', array('controller' => 'emails', 'action'=>'edit',2)); ?></li>
    <li><?php echo $this->Html->link('Correo 3', array('controller' => 'emails', 'action'=>'edit',3)); ?></li>
  </ul>
</div>
<div class="col-10">
  <div class="grey-container">
    <h2>Configuración de Correo</h2>
    <?php echo $this->Form->create('EmailConfig', $options_for_form); 

        echo $this->Form->input('host', array('label' => 'Servidor'));
        echo $this->Form->input('port', array('label' => 'Puerto'));      
        echo $this->Form->input('transport', array('label' => 'Protocolo'));
        echo $this->Form->input('username', array('label' => 'Dirección de correo','autocomplete'=>'off'));
        echo $this->Form->input('password', array('label' => 'Contraseña'));
      ?>
    <div class="text-right">
      <?php
        echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
      ?>
    </div>
  </div>
</div>
