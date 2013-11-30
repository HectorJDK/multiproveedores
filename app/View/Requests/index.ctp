
<h2>Solicitudes Abiertas</h2>
<?php echo $this->element('requests_actions'); ?>
<div class="filters">
	<span>Ordenar por:</span>
	<ul class="pagination pagination-inverse">
		<li><?php echo $this->Paginator->sort('category_id'); ?></li>
		<li><?php echo $this->Paginator->sort('created'); ?></li>
	</ul>
</div>

<?php foreach ($requests as $request): ?>
<div class="row striped slim">
	<div class="col-8">
		<?php if (is_null(!$request['Origin']['url'])): ?>
		<div class="row">
			<div class="col-3 text-right light">
				Página Origen:
			</div>
			<div class="col-9">
				<?php echo $this->Html->link($request['Origin']['url'], array('controller' => 'categories', 'action' => 'view', $request['Origin']['id'])); ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="row">
			<div class="col-3 text-right light">
				Comentarios:
			</div>
			<div class="col-9">
				<?php echo $this->Html->link($request['Content']['comment'], array('controller' => 'contents', 'action' => 'view', $request['Content']['id'])); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-3 text-right light">
				Fecha Creación: 
			</div>
			<div class="col-9">
				<?php echo date('j M Y', strtotime(h($request['Request']['created']))); ?>&nbsp;
			</div>
		</div>
	</div>

	<div class="col-4">
		<div class="inner-actions">
			<?php echo $this->Html->link(__('Ver Solicitud'), array('action' => 'view', $request['Request']['id']), array('class'=>'btn btn-info view')); ?>
			<?php echo $this->Form->postLink(__('Borrar Solicitud'), array('action' => 'virtualDelete', $request['Request']['id']), array('class' => "btn btn-danger btn-highlight")); ?>
		</div>
	</div>
</div>
<?php endforeach; ?>
<?php echo $this->element('paginator'); ?>
