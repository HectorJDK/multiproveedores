<h2>Tipos de Productos</h2>	

<div class="small-content">
	<div class="filters">
		<span>Ordenar por:</span>
		<ul class="pagination pagination-inverse">
			<li><?php echo $this->Paginator->sort('type_name', 'Nombre'); ?></li>
		</ul>
	</div>
	<table class="table table-striped" width="500px">
		<thead>
			<tr>
				<th width="50px;">Id</th>
				<th width="300px;">Nombre</th>
				<th width="200px;">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($types as $type): ?>
				<tr>
					<td><?php echo $type['Type']['id']; ?></td>
					<td><?php echo $type['Type']['type_name']; ?></td>
					<td>
						<?php
							echo $this->Html->link("Ver", array('action' => 'view', $type['Type']['id']), array('class' => 'btn btn-info btn-small'));
							echo $this->Html->link("Editar", array('action' => 'edit', $type['Type']['id']), array('class' => 'btn btn-success btn-small'));
						?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		
	</table>
	<?php echo $this->element('paginator'); ?>
</div>

