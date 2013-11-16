<div class="categoriesSuppliers view">
<h2><?php echo __('Categories Supplier'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($categoriesSupplier['CategoriesSupplier']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($categoriesSupplier['Category']['url'], array('controller' => 'categories', 'action' => 'view', $categoriesSupplier['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($categoriesSupplier['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $categoriesSupplier['Supplier']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('Edit Categories Supplier'), array('action' => 'edit', $categoriesSupplier['CategoriesSupplier']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete Categories Supplier'), array('action' => 'delete', $categoriesSupplier['CategoriesSupplier']['id']), null, __('Are you sure you want to delete # %s?', $categoriesSupplier['CategoriesSupplier']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List Categories Suppliers'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Categories Supplier'), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		</ul>
</div>
