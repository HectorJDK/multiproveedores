<div class="col-2">
  <?php echo $this->element('origins_actions'); ?>
</div>

<div class="col-10">

	<h2>Origenes</h2>

	<div class="small-content">
		<div class="filters">
			<span>Ordenar por:</span>
			  <ul class="pagination pagination-inverse">
			    <li><?php echo $this->Paginator->sort('id'); ?></li>
			    <li><?php echo $this->Paginator->sort('url'); ?></li>
			  </ul>
		</div>

		<table class="table table-striped" width="500px">
			<thead>
				<tr>
					<th width="50px;">Id</th>
					<th width="300px;">URL</th>
					<th width="200px;"></th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($origins as $origin): ?>
					<tr>
						<td><?php echo $origin['Origin']['id']; ?></td>
						<td><?php echo $origin['Origin']['url']; ?></td>
						<td>
							<?php
								echo $this->Html->link("Editar", array('action' => 'edit', $origin['Origin']['id']), array('class' => 'btn btn-success btn-block btn-small'));
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php echo $this->element('paginator'); ?>
	</div>
</div>
