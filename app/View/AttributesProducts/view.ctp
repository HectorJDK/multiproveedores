<div class="attributesProducts view">
<h2><?php echo __('Attributes Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attributesProduct['AttributesProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attributesProduct['product']['id'], array('controller' => 'products', 'action' => 'view', $attributesProduct['product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attribute'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attributesProduct['attribute']['name'], array('controller' => 'attributes', 'action' => 'view', $attributesProduct['attribute']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($attributesProduct['AttributesProduct']['value']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
		<li><?php echo $this->Html->link(__('Edit Attributes Product'), array('action' => 'edit', $attributesProduct['AttributesProduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attributes Product'), array('action' => 'delete', $attributesProduct['AttributesProduct']['id']), null, __('Are you sure you want to delete # %s?', $attributesProduct['AttributesProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributes Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attributes Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>
