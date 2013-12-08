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
			<div class="col-9 blue">
				<?php echo $request['Content']['comment']; ?>
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

		<div class="inner-actions">
			<div class="col-15">
				<form action="/multiproveedores/quotes/index" method="POST">
					<input type="hidden" name="request_id" value="<?php echo $request['Request']['id']?>"/>
					<button type="submit" class="btn">Ver Cotizaciones</button>
				</form>
			</div>
			<?php echo $this->Html->link(__('Ver Solicitud'), array('action' => 'view', $request['Request']['id']), array('class'=>'btn btn-info view')); ?>
			<?php echo $this->Form->postLink(__('Liberar Solicitud'), array('action' => 'release', $request['Request']['id']), array('class' => "btn btn-danger btn-highlight")); ?>
		</div>
	</div>
</div>
<?php endforeach; ?>