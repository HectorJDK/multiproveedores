<div class="categories view">
<h2><?php echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($category['Category']['url']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Requests'), array('controller' => 'requests', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Requests'); ?></h3>
	<?php if (!empty($category['Request'])): ?>
	<table cellpadding = "0" cellspacing = "0">
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
	<?php foreach ($category['Request'] as $request): ?>
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

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Products'); ?></h3>
	<?php if (!empty($category['Product'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Manufacturer Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($category['Product'] as $product): ?>
		<tr>
			<td><?php echo $product['id']; ?></td>
			<td><?php echo $product['category_id']; ?></td>
			<td><?php echo $product['type_id']; ?></td>
			<td><?php echo $product['manufacturer_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'products', 'action' => 'delete', $product['id']), null, __('Are you sure you want to delete # %s?', $product['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Suppliers'); ?></h3>
	<?php if (!empty($category['Supplier'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Corporate Name'); ?></th>
		<th><?php echo __('Moral Rfc'); ?></th>
		<th><?php echo __('Contact Name'); ?></th>
		<th><?php echo __('Contact Email'); ?></th>
		<th><?php echo __('Credit'); ?></th>
		<th><?php echo __('Contact Telephone'); ?></th>
		<th><?php echo __('Rating'); ?></th>
		<th><?php echo __('Accepted Quotes'); ?></th>
		<th><?php echo __('Rejected Quotes'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($category['Supplier'] as $supplier): ?>
		<tr>
			<td><?php echo $supplier['id']; ?></td>
			<td><?php echo $supplier['corporate_name']; ?></td>
			<td><?php echo $supplier['moral_rfc']; ?></td>
			<td><?php echo $supplier['contact_name']; ?></td>
			<td><?php echo $supplier['contact_email']; ?></td>
			<td><?php echo $supplier['credit']; ?></td>
			<td><?php echo $supplier['contact_telephone']; ?></td>
			<td><?php echo $supplier['rating']; ?></td>
			<td><?php echo $supplier['accepted_quotes']; ?></td>
			<td><?php echo $supplier['rejected_quotes']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'suppliers', 'action' => 'view', $supplier['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'suppliers', 'action' => 'edit', $supplier['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'suppliers', 'action' => 'delete', $supplier['id']), null, __('Are you sure you want to delete # %s?', $supplier['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
