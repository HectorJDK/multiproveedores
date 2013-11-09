<div class="filters">
<span>Ordenar por:</span>
<ul class="pagination pagination-inverse">
	<li><?php echo $this->Paginator->sort('category_id'); ?></li>
	<li><?php echo $this->Paginator->sort('created'); ?></li>
</ul>
</div>
<?php foreach ($requests as $request): ?>
<div class="row striped">
	<h4>
		Página Origen: <?php echo $this->Html->link($request['Category']['url'], array('controller' => 'categories', 'action' => 'view', $request['Category']['id'])); ?>
	</h4>
	<h4>
		Comentarios: <?php echo $this->Html->link($request['Content']['comment'], array('controller' => 'contents', 'action' => 'view', $request['Content']['id'])); ?>
	</h4>
	<h4>Fecha Creación: <?php echo date('j M Y', strtotime(h($request['Request']['created']))); ?>&nbsp;</h4>
	<h4>Fecha Modificación: <?php echo date('j M Y', strtotime(h($request['Request']['modified']))); ?>&nbsp;</h4>
<!-- 		<h4><?php echo h($request['Request']['deleted']); ?>&nbsp;</h3>
	<h4><?php echo h($request['Request']['note']); ?>&nbsp;</h3> -->
	<div class="inner-actions">
		<?php echo $this->Html->link(__('Trabajar Solicitud'), array('action' => 'view', $request['Request']['id']), array('class'=>'btn btn-info view')); ?>
	</div>
</div>
<?php endforeach; ?>