<div class="equivalencies view">
<h2><?php echo __('Equivalencias'); ?></h2>
	<div class="row striped slim">
		<div class="col-8">
			<div class="row">
				<div class="col-3 text-right light">
					Identificador
				</div>
				<div class="col-3">
					<?php echo __('Id'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-3 text-right light">
					Equivalencia
				</div>
				<div class="col-3">
				<?php echo h($equivalency['Equivalency']['id']); ?>
				&nbsp;
				</div>
			</div>
			<div class="row">
				<div class="col-3 text-right light">
					Producto Original
				</div>
				<div class="col-3">
					<?php echo h($equivalency['Equivalency']['original_id']); ?>&nbsp;
				</div>
			</div>
			<div class="row">
				<div class="col-3 text-right light">
					Producto Equivalente
				</div>
				<div class="col-3">
					<?php echo h($equivalency['Equivalency']['equivalent_id']); ?>&nbsp;
				</div>
			</div>
		</div>

	<div class="col-4">
		<div class="light"><?php echo __('Actions'); ?></div>
		<ul>
			<li><?php echo $this->Html->link(__('Edit Equivalency'), array('action' => 'edit', $equivalency['Equivalency']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete Equivalency'), array('action' => 'delete', $equivalency['Equivalency']['id']), null, __('Are you sure you want to delete # %s?', $equivalency['Equivalency']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List Equivalencies'), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Equivalency'), array('action' => 'add')); ?> </li>
		</ul>
	</div>

</div>
