<div class="grey-container">
	<div class="emailconfig form">
		<h2>Configuracion de Correo</h2>
	<?php echo $this->Form->create('EmailConfig'); ?>
		<?php
			echo $this->Form->input('host');
			echo $this->Form->input('port');
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->input('transport');
		?>
		</fieldset>
	<div class="text-right">
	  <?php
	    echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
	  ?>
	</div>
	</div>
</div>