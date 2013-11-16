<div class="categories index">
	<div class="actions dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Acciones'); ?><b class="caret bottom-up"></b></a>
		<ul class="dropdown-menu bottom-up pull-right">
			<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
		</ul>
	</div>
	
	<h2><?php echo __('Categories'); ?></h2>

	<div class="filters"> Ordenar por:
			<?php echo $this->Paginator->sort('id'); ?>
			<?php echo $this->Paginator->sort('url'); ?>
	</div>

	<?php foreach ($categories as $category): ?>
	<div class="row striped slim">
		<div class="col-8">
			<div class="row">
				<div class="col-3 text-right light">
					Id
				</div>
				<div class="col-3">
					<?php echo h($category['Category']['id']); ?>&nbsp;
				</div>
			</div>

			<div class="row">
				<div class="col-3 text-right light">
					Cateogria
				</div>
				<div class="col-3">
					<?php echo h($category['Category']['url']); ?>&nbsp;
				</div>
			</div>

		</div>
		<div class="col-4">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?>
		</div>
	</div>
<?php endforeach; ?>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="pagination pagination-center">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
