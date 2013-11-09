<div class="products view">
<h2><?php echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['Category']['url'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $product['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manufacturer Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['manufacturer_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Quotes'), array('controller' => 'quotes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Quote'), array('controller' => 'quotes', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Quotes'); ?></h3>
	<?php if (!empty($product['Quote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Request Id'); ?></th>
		<th><?php echo __('Supplier Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Result Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['Quote'] as $quote): ?>
		<tr>
			<td><?php echo $quote['id']; ?></td>
			<td><?php echo $quote['request_id']; ?></td>
			<td><?php echo $quote['supplier_id']; ?></td>
			<td><?php echo $quote['user_id']; ?></td>
			<td><?php echo $quote['result_id']; ?></td>
			<td><?php echo $quote['product_id']; ?></td>
			<td><?php echo $quote['created']; ?></td>
			<td><?php echo $quote['modified']; ?></td>
			<td><?php echo $quote['deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'quotes', 'action' => 'view', $quote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'quotes', 'action' => 'edit', $quote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'quotes', 'action' => 'delete', $quote['id']), null, __('Are you sure you want to delete # %s?', $quote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('New Quote'), array('controller' => 'quotes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Attributes'); ?></h3>
	<?php if (!empty($product['Attribute'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Data Type'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['Attribute'] as $attribute): ?>
		<tr>
			<td><?php echo $attribute['id']; ?></td>
			<td><?php echo $attribute['name']; ?></td>
			<td><?php echo $attribute['data_type']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attributes', 'action' => 'view', $attribute['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attributes', 'action' => 'edit', $attribute['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attributes', 'action' => 'delete', $attribute['id']), null, __('Are you sure you want to delete # %s?', $attribute['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Suppliers'); ?></h3>
	<?php if (!empty($product['Supplier'])): ?>
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
	<?php foreach ($product['Supplier'] as $supplier): ?>
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
