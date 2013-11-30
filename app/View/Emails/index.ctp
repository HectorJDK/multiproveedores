<div class="emails index">
	<h2><?php echo __('Emails'); ?></h2>
	<div class="filters">
		<span>Ordenar por:</span>
		<ul class="pagination pagination-inverse">
			<li><?php echo $this->Paginator->sort('id'); ?></li>
			<li><?php echo $this->Paginator->sort('modified'); ?></li>
			<li><?php echo $this->Paginator->sort('created'); ?></li>
			<li><?php echo $this->Paginator->sort('with_copy'); ?></li>
		</ul>
	</div>
	<?php foreach ($emails as $email): ?>
	<div class="row striped slim">
		<div class="col-8">
			<div class="row">
				<div class="col-6">
					Email #<?php echo h($email['Email']['id']); ?>&nbsp;
				</div>
			</div>
			<div class="row">
				<div class="col-3 text-right light">
					Cuerpo:
				</div>
				<div class="col-3">
					<?php echo h($email['Email']['email_body']); ?>&nbsp;
				</div>
			</div>
			<div class="row">
				<div class="col-3 text-right light">
					Modificado :
				</div>
				<div class="col-3">
					<?php echo h($email['Email']['modified']); ?>&nbsp;
				</div>
			</div>
			<div class="row">
				<div class="col-3 text-right light">
					Creado :
				</div>
				<div class='col-3'>
					<?php echo h($email['Email']['created']); ?>&nbsp;
				</div>
			</div>
			<div class="row">
				<div class="col-3 text-right light"> Con copia :
				</div>
				<div class="col-3">
					<?php echo h($email['Email']['with_copy']); ?>&nbsp;
				</div>
			</div>
		</div>

		<div class="col-3 inner-actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $email['Email']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $email['Email']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $email['Email']['id']), null, __('Are you sure you want to delete # %s?', $email['Email']['id'])); ?>
		</div>
	</div>
<?php endforeach; ?>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Email'), array('action' => 'add')); ?></li>
	</ul>
</div>
