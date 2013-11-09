<div class="productsSuppliers form">
<?php echo $this->Form->create('ProductsSupplier'); ?>
	<fieldset>
		<legend><?php echo __('Edit Products Supplier'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('supplier_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('price');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">

			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductsSupplier.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProductsSupplier.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List Products Suppliers'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
</div>
