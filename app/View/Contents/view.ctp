<div class="contents view">
<h2><?php echo __('Content'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($content['Content']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Xml'); ?></dt>
		<dd>
			<?php echo h($content['Content']['xml']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($content['Content']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('Edit Content'), array('action' => 'edit', $content['Content']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete Content'), array('action' => 'delete', $content['Content']['id']), null, __('Are you sure you want to delete # %s?', $content['Content']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List Contents'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Content'), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Requests'), array('controller' => 'requests', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
		</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Requests'); ?></h3>
	<?php if (!empty($content['Request'])): ?>
	<table>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Content Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($content['Request'] as $request): ?>
		<tr>
			<td><?php echo $request['id']; ?></td>
			<td><?php echo $request['category_id']; ?></td>
			<td><?php echo $request['content_id']; ?></td>
			<td><?php echo $request['user_id']; ?></td>
			<td><?php echo $request['created']; ?></td>
			<td><?php echo $request['modified']; ?></td>
			<td><?php echo $request['deleted']; ?></td>
			<td><?php echo $request['note']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'requests', 'action' => 'view', $request['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'requests', 'action' => 'edit', $request['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'requests', 'action' => 'delete', $request['id']), null, __('Are you sure you want to delete # %s?', $request['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
