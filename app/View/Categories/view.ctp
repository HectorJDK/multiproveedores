<div class="categories view">
	<div class="actions dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo __('Acciones'); ?><b class="caret bottom-up"></b></a>
			<ul class="dropdown-menu bottom-up pull-right">
				<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
				<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
				<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
			</ul>
	</div>
<h2><?php echo __('Category'); ?></h2>
	<div class="row striped slim">
		<div class="col-8">

			<div class="row">
				<div class="col-3 text-right light">
					Identificador
				</div>
				<div class="col-3">
					<?php echo h($category['Category']['id']); ?>
			
				</div>
			</div>
			<div class="row">
				<div class="col-3 text-right light">
					<?php echo __('Url'); ?></dt>
				</div>
				<div class="col-3">
					<?php echo h($category['Category']['url']); ?>
				</div>
			</div>
		</div>
	</div>
</div>
