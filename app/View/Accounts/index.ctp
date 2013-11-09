<div class="accounts index">
	<h2><?php echo __('Accounts'); ?></h2>
	<div class="actions dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('New Account'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
	<table cellpadding="10" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_id'); ?></th>
			<th><?php echo $this->Paginator->sort('due_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($accounts as $account): ?>
	<tr>
		<td><?php echo h($account['Account']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($account['Order']['id'], array('controller' => 'orders', 'action' => 'view', $account['Order']['id'])); ?>
		</td>
		<td><?php echo h($account['Account']['due_date']); ?>&nbsp;</td>
		<td><?php echo h($account['Account']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $account['Account']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $account['Account']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $account['Account']['id']), null, __('Are you sure you want to delete # %s?', $account['Account']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
		<?php 
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?>
	</p>
	<ul class="pagination pagination-center">
		<?php
		echo $this->Paginator->prev('' . __('< '), array(), null, array('class' => 'previous'));
		echo $this->Paginator->numbers(array('separator' => ' '));
		echo $this->Paginator->next(__('') . ' >', array(), null, array('class' => 'next disabled')); ?>
	</ul>
</div>