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
		<div class="row">
			<div class="col-3 text-right light">
				Página Origen: 
			</div>
			<div class="col-9">
				<?php echo $this->Html->link($request['Category']['url'], array('controller' => 'categories', 'action' => 'view', $request['Category']['id'])); ?>
			</div>
		</div>

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

		<div class="row">
			<div class="col-3 text-right light">
				Fecha Modificación: 
			</div>
			<div class="col-9">
				<?php echo date('j M Y', strtotime(h($request['Request']['modified']))); ?>&nbsp;
			</div>
		</div>

		<div class="inner-actions">
			<?php echo $this->Html->link(__('Trabajar Solicitud'), array('action' => 'view', $request['Request']['id']), array('class'=>'btn btn-info view')); ?>
		</div>
	</div>
</div>
<?php endforeach; ?>