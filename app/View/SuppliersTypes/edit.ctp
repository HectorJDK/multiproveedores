<div class="suppliersTypes form">
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SuppliersType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SuppliersType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Suppliers Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php echo $this->Form->create('SuppliersType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Suppliers Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('type_id');
		echo $this->Form->input('supplier_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

