<?php print_r($products)?>
<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Actions'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?></li>
		</ul>
</div>
<div class="products index">
	<h1><?php echo __('Productos'); ?></h1>
	<div class="filters">
		<span>Ordenar por:</span>
			<ul class="pagination pagination-inverse">
				<li><?php echo $this->Paginator->sort('manufacturer_id'); ?></li>
				<li><?php echo $this->Paginator->sort('type_id'); ?></li>
			</ul>
	</div>

	<?php foreach ($products as $product): ?>
	<div class="row striped slim">
		<div class="col-8">

			<div class="row">
				<div class="col-3 text-right light">
					Tipo de Producto
				</div>
				<div class="col-3 bold">
					<?php echo $this->Html->link($product['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $product['Type']['id'])); ?>
				</div>
			</div>


			<div class="row">
				<div class="col-3 text-right light">
					Proveedor
				</div>
				<div class="col-3">
					<?php echo h($product['Product']['manufacturer_id']); ?>
				</div>

				<div class="col-2 text-center">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id']), array('class' => 'btn btn-warning btn-block btn-small')); ?>
				</div>
				<div class="col-2 text-center">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-info btn-block btn-small')); ?>
				</div>
				<div class="col-2 text-center">
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id']), array('class' => 'btn btn-warning btn-block btn-small')); ?>
				</div>
			</div>
		</div>
	</div>

<?php endforeach; ?>

			<ul class="pagination pagination-center">
				<p class="light">
				<?php
				echo $this->Paginator->counter(array(
				'format' => __('Página {:page} de {:pages}. Mostrando {:current} records de {:count} en total'))); ?>
				</p>
				<?php
				echo $this->Paginator->prev('' . __('< '), array(), null, array('class' => 'previous'));
				echo $this->Paginator->numbers(array('separator' => ' '));
				echo $this->Paginator->next(__('') . ' >', array(), null, array('class' => 'next disabled')); ?>
			</ul>
		</div>
	</div>
</div>