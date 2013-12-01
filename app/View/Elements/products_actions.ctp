<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Acciones'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
		  <li><?php echo $this->Html->link(__('New Type'), array('action' => 'add')); ?></li>
    <li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
    <li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
    <li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
    </ul>
	</ul>
</div>
