<div class="equivalencies form">
<?php echo $this->Form->create('Equivalency'); ?>
	<fieldset>
		<legend><?php echo __('Add Equivalency'); ?></legend>
	<?php
		echo $this->Form->input('original_id');
		echo $this->Form->input('equivalent_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Equivalencies'), array('action' => 'index')); ?></li>
	</ul>
</div>
