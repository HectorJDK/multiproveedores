<div class="equivalencies index">
	<div class="actions dropdown">
		<?php echo $this->Html->link(__('Nueva Equivalencia'), array('action' => 'add')); ?>
	</div>
	<h2><?php echo __('Equivalencies'); ?></h2>
	<?php foreach ($equivalencies as $equivalency): ?>
	<div class="row striped slim">
		<div class="col-8">
			<div class="row">
				<div class="col-3 text-right light">
					Id
				</div>
				<div class="col-3">
					<?php echo h($equivalency['Equivalency']['id']); ?>&nbsp;
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
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $equivalency['Equivalency']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $equivalency['Equivalency']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $equivalency['Equivalency']['id']), null, __('Are you sure you want to delete # %s?', $equivalency['Equivalency']['id'])); ?>
		</div>
	</div>

<?php endforeach; ?>
	</table>
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
