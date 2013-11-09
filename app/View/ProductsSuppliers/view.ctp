<div class="productsSuppliers view">
<h2><?php echo __('Products Supplier'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productsSupplier['ProductsSupplier']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productsSupplier['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $productsSupplier['Supplier']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productsSupplier['Product']['id'], array('controller' => 'products', 'action' => 'view', $productsSupplier['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($productsSupplier['ProductsSupplier']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($productsSupplier['ProductsSupplier']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($productsSupplier['ProductsSupplier']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
		<li><?php echo $this->Html->link(__('Edit Products Supplier'), array('action' => 'edit', $productsSupplier['ProductsSupplier']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Products Supplier'), array('action' => 'delete', $productsSupplier['ProductsSupplier']['id']), null, __('Are you sure you want to delete # %s?', $productsSupplier['ProductsSupplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products Suppliers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Products Supplier'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
