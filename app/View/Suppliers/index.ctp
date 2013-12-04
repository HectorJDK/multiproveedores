<h1>Proveedores</h1>

<?php echo $this->element('suppliers_actions'); ?>

<div class="filters">
	<span>Ordenar por:</span>
	<ul class="pagination pagination-inverse">
		<li><?php echo $this->Paginator->sort('corporate_name', 'Empresa'); ?></li>
		<li><?php echo $this->Paginator->sort('contact_name', 'Contacto'); ?></li>
	</ul>
</div>

<?php foreach ($suppliers as $supplier): ?>
<div class="row striped slim">
	<div class="col-6">
		<div class="row">
			<h4><?php echo $supplier['Supplier']['corporate_name']; ?></h4>
		</div>
	</div>
	<div class="col-2 text-center">
		<?php echo $this->Html->link("Ver Catálogo", array('controller' => 'productsSuppliers', 'action' => 'catalog', $supplier['Supplier']['id']), array('class' => 'btn btn-warning btn-block btn-small')); ?>
	</div>
	<div class="col-2 text-center">
		<?php echo $this->Html->link("Ver", array('action' => 'view', $supplier['Supplier']['id']), array('class' => 'btn btn-info btn-block btn-small')); ?>
	</div>
	<div class="col-2 text-center">
		<?php echo $this->Html->link("Editar", array('action' => 'edit', $supplier['Supplier']['id']), array('class' => 'btn btn-success btn-block btn-small')); ?>
	</div>
	<!-- <div class="col-1 text-center">
		<?php echo $this->Form->postLink("Eliminar", array('action' => 'delete', $supplier['Supplier']['id']), array('class' => 'btn btn-success btn-block btn-small'), 'Seguro que desea eliminar el %s?', $supplier['Supplier']['corporate_name']); ?>
	</div> -->
</div>
<?php endforeach; ?>

<?php echo $this->element('paginator'); ?>