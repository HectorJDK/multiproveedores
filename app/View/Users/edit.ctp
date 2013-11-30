<!-- app/View/Users/add.ctp -->
<div class="users form">
	<h2>Editar Usuario</h2>
<?php echo $this->Form->create('User'); ?>
    <fieldset>

        <?php
        	echo $this->Form->input('id');
	        echo $this->Form->input('name', array('autocomplete' => 'off'));
	        echo $this->Form->input('email');
	        echo $this->Form->input('username', array('autocomplete' => 'off'));
	        echo $this->Form->input('password', array('autocomplete' => 'off'));
    	?>
    </fieldset>
<div class="text-right">
	  <?php
	    echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
	  ?>
	</div>
</div>