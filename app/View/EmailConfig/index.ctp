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