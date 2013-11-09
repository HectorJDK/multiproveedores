<div class="productsSuppliers index">
	<h2><?php echo __('Products Suppliers'); ?></h2>
	<div class="actions dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
			<ul class="dropdown-menu bottom-up pull-right">
				<li><?php echo $this->Html->link(__('New Products Supplier'), array('action' => 'add')); ?></li>
				<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
			</ul>
	</div>
	<table cellpadding="10" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($productsSuppliers as $productsSupplier): ?>
	<tr>
		<td><?php echo h($productsSupplier['ProductsSupplier']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($productsSupplier['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $productsSupplier['Supplier']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($productsSupplier['Product']['id'], array('controller' => 'products', 'action' => 'view', $productsSupplier['Product']['id'])); ?>
		</td>
		<td><?php echo h($productsSupplier['ProductsSupplier']['price']); ?>&nbsp;</td>
		<td><?php echo h($productsSupplier['ProductsSupplier']['created']); ?>&nbsp;</td>
		<td><?php echo h($productsSupplier['ProductsSupplier']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $productsSupplier['ProductsSupplier']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $productsSupplier['ProductsSupplier']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $productsSupplier['ProductsSupplier']['id']), null, __('Are you sure you want to delete # %s?', $productsSupplier['ProductsSupplier']['id'])); ?>
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
