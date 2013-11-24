
<div class="products index">
	<h1><?php echo __('Asignar equivalentes del producto ').$this->request->data['Product']['id']; ?></h1>
	<div class="filters">
		<span>Ordenar por:</span>
			<ul class="pagination pagination-inverse">
				<li><?php echo $this->Paginator->sort('manufacturer_id'); ?></li>
				<li><?php echo $this->Paginator->sort('type_id'); ?></li>
			</ul>
	</div>

	<?php foreach ($products as $product){
		if($product['Product']['id']!=$this->request->data['Product']['id']){
	 ?>
	<div class="row striped slim">
		<div class="col-8">

			<div class="row">
				<div class="col-3 text-right light">
					Tipo de Producto
				</div>
				<div class="col-3 bold">
					<?php echo $this->Html->link($product['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $product['Type']['id'])); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-3 text-right light">
					Proveedor
				</div>
				<div class="col-3">
					<?php echo h($product['Product']['manufacturer_id']); ?>
				</div>
			</div>
			<div class="row">
				<div class="inner-actions">
					<div class="row">
						<?php
						if(!in_array($product['Product']['id'], $equivalencias)){
						 echo $this->Html->link(__('Asignar'), array('action' => 'asignarEquivalencias', $this->request->data['Product']['id'],$product['Product']['id']));
						 } else {
						 	echo $this->Html->link(__('Asignado'), array('action' => 'asignarEquivalencias', $this->request->data['Product']['id'],$product['Product']['id']));
						 } ?>					
					</div>
				</div>	
			</div>
		</div>
	</div>
<?php }
}?>
	
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