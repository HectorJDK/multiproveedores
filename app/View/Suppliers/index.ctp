<div class="suppliers index">
	<h2><?php echo __('Suppliers'); ?></h2>
	<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
		<li><?php echo $this->Html->link(__('New Supplier'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Quotes'), array('controller' => 'quotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quote'), array('controller' => 'quotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<table cellpadding="10" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('corporate_name'); ?></th>
			<th><?php echo $this->Paginator->sort('moral_rfc'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_name'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_email'); ?></th>
			<th><?php echo $this->Paginator->sort('credit'); ?></th>
			<th><?php echo $this->Paginator->sort('contact_telephone'); ?></th>
			<th><?php echo $this->Paginator->sort('rating'); ?></th>
			<th><?php echo $this->Paginator->sort('accepted_quotes'); ?></th>
			<th><?php echo $this->Paginator->sort('rejected_quotes'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($suppliers as $supplier): ?>
	<tr>
		<td><?php echo h($supplier['Supplier']['id']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['corporate_name']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['moral_rfc']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['contact_name']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['contact_email']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['credit']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['contact_telephone']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['rating']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['accepted_quotes']); ?>&nbsp;</td>
		<td><?php echo h($supplier['Supplier']['rejected_quotes']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $supplier['Supplier']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $supplier['Supplier']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $supplier['Supplier']['id']), null, __('Are you sure you want to delete # %s?', $supplier['Supplier']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
