<div class="suppliersTypes view">
<h2><?php echo __('Suppliers Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($suppliersType['SuppliersType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($suppliersType['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $suppliersType['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($suppliersType['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $suppliersType['Supplier']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
		<li><?php echo $this->Html->link(__('Edit Suppliers Type'), array('action' => 'edit', $suppliersType['SuppliersType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Suppliers Type'), array('action' => 'delete', $suppliersType['SuppliersType']['id']), null, __('Are you sure you want to delete # %s?', $suppliersType['SuppliersType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Suppliers Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
	</ul>
</div>
