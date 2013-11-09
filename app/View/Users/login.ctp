<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array(
'inputDefaults' => array(
    'div' => 'form-fields',
    'label' => array('class' => 'control-label'),
    'between' => '<div class="controls">',
    'after' => '</div>',
    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-error'))
))); ?>
    <div class="row login">
        <h2 class="text-center">Iniciar Sesion</h2>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
<?php echo $this->Form->submit(__('Login',true), array('class'=>'btn btn-success btn-block')); 
      echo $this->Form->end(); ?>
	</div>
</div>