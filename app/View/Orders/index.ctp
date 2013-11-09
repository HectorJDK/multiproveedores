<h1>Ordenes por Cerrar</h3>
<div class="filters">
<span>Ordenar por:</span>
<ul class="pagination pagination-inverse">
	<li><?php echo $this->Paginator->sort('created', 'Fecha'); ?></li>
</ul>
</div>
<?php foreach ($orders as $order): ?>
<div class="row striped slim">
	<!-- INFO -->
	<div class="col-8">
		<div class="row">
			<div class="col-12">
	      Orden #<?php echo h($order['Order']['id']); ?>
	    </div>
		</div>
	 	<div class="row">
	    <div class="col-9 text-right light">
	      Fecha de creación
	    </div>
	    <div class="col-3 bold">
	      <?php echo $this->Time->format($order['Order']['created'], '%d/%m/%y', 'invalid'); ?>
	    </div>
	  </div>

	  <!-- Proveedor -->
	  <div class="row">
	    <div class="col-3 text-right light">
	      Proveedor
	    </div>
	    <div class="col-9">
	      <?php echo $this->Html->link($order['Quote']['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $order['Quote']['Supplier']['id'])); ?>
	    </div>
	  </div>

	  <!-- Producto -->
	  <div class="row">
	    <div class="col-3 text-right light">
	      Producto
	    </div>
	    <div class="col-3">
	      <?php echo $this->Html->link($order['Quote']['product_id'], array('controller' => 'products', 'action' => 'view', $order['Quote']['product_id'])); ?>
	    </div>

	    <div class="col-3 text-right light">
	      Precio Unitario
	    </div>
	    <div class="col-3">
	      <?php echo "$".h($order['Order']['unitary_price']); ?>
	    </div>
	  </div>

	  <div class="row">
	    <div class="col-3 text-right light">
	      Cantidad
	    </div>
	    <div class="col-3">
	      <?php echo h($order['Order']['quantity']); ?>
	    </div>

	    <div class="col-3 text-right light">
	      Precio Total
	    </div>
	    <div class="col-3">
	      <?php echo "$".h($order['Order']['total_price']); ?>
	    </div>
	  </div>
		
	</div>

	<!-- Acctions -->
	<div class="col-4">
		
	</div>
</div>
<?php endforeach; ?>

<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	<div class="actions dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
			<ul class="dropdown-menu bottom-up pull-right">
				<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
				<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Quotes'), array('controller' => 'quotes', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Quote'), array('controller' => 'quotes', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
			</ul>
	</div>
	<table cellpadding="10" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quote_id'); ?></th>
			<th><?php echo $this->Paginator->sort('state_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('total_price'); ?></th>
			<th><?php echo $this->Paginator->sort('unitary_price'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th><?php echo $this->Paginator->sort('rating'); ?></th>
			<th><?php echo $this->Paginator->sort('logistics'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['User']['name'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($order['Quote']['created'], array('controller' => 'quotes', 'action' => 'view', $order['Quote']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($order['State']['value'], array('controller' => 'states', 'action' => 'view', $order['State']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['quantity']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['total_price']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['unitary_price']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['created']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['modified']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['rating']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['logistics']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
		<?php 
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?>
	</p>
	<ul class="pagination pagination-center">
		<?php
		echo $this->Paginator->prev('' . __('< '), array(), null, array('class' => 'previous'));
		echo $this->Paginator->numbers(array('separator' => ' '));
		echo $this->Paginator->next(__('') . ' >', array(), null, array('class' => 'next disabled')); ?>
	</ul>
</div>