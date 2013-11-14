<div class="equivalencies view">
<h2><?php echo __('Equivalency'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($equivalency['Equivalency']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Original Id'); ?></dt>
		<dd>
			<?php echo h($equivalency['Equivalency']['original_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Equivalent Id'); ?></dt>
		<dd>
			<?php echo h($equivalency['Equivalency']['equivalent_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Equivalency'), array('action' => 'edit', $equivalency['Equivalency']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Equivalency'), array('action' => 'delete', $equivalency['Equivalency']['id']), null, __('Are you sure you want to delete # %s?', $equivalency['Equivalency']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Equivalencies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Equivalency'), array('action' => 'add')); ?> </li>
	</ul>
</div>
