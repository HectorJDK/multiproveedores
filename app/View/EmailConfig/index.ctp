<div class="emailconfig form">
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
</ul>
</div>
<?php echo $this->Form->create('EmailConfig'); ?>
	<fieldset>
		<legend><?php echo __('Edit Email configuration'); ?></legend>
	<?php
		echo $this->Form->input('host');
		echo $this->Form->input('port');
		echo $this->Form->input('username');
		echo $this->Form->input('password');		
		echo $this->Form->input('transport');	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
