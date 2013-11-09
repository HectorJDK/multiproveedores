<div class="results form">
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">

			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Result.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Result.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List Results'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('List Quotes'), array('controller' => 'quotes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Quote'), array('controller' => 'quotes', 'action' => 'add')); ?> </li>
		</ul>
</div>
<?php echo $this->Form->create('Result'); ?>
	<fieldset>
		<legend><?php echo __('Edit Result'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

