<div class="products view">
<br>
<br>
    <h1><?php echo __('Producto'); ?></h1>
	<div class="row striped slim">
		<div class="col-8">

			<div class="row">
				<div class="col-3 text-right light">
					Identificador
				</div>
				<div class="col-3">
					<?php echo h($product['Product']['id']); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-3 text-right light">
					Tipo
				</div>
				<div class="col-3">
					<?php echo $this->Html->link($product['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $product['Type']['id'])); ?>
				</div>
			</div>

			<div class-"row">
				<div class="col-3 text-right light">
					Proveedor
				</div>
				<div class="col-3">
					<?php echo h($product['Product']['manufacturer_id']); ?>
			
				</div>
			</div>
			<br>
			<div class-"row">
				<div class="col-3">
					Atributos
				</div>
				<div class="col-3">
					&nbsp;
				</div>
			</div>
			<?php foreach ($product['Attribute'] as $attribute) {?>

			<div class-"row">
				<div class="col-3 text-right light">
					<?php echo h($attribute["name"]);?>
				</div>
				<div class="col-3">
					<?php echo h($attribute['AttributesProduct']['value']); ?>			
				</div>
			</div>
			<?php }?>		
		</div>

		<div class="col-3 text-center inner-actions">
			<button class="btn btn-success btn-block"><?php echo $this->Html->link(__('Ver equivalencias'), array('action' => 'has_as_equivalents', $product['Product']['id'])); ?></button>
			<button class="btn btn-success btn-block"><?php echo $this->Html->link(__('Ver originales'), array('action' => 'equivalent_to', $product['Product']['id'])); ?></button>
			<button class="btn btn-info btn-block"><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?></button>
			<button class="btn btn-danger btn-block"><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?></button>
		</div>
	</div>

</div>
