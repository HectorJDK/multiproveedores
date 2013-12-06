<h1> Productos </h1>
<div class="filters">
  <span>Ordenar por:</span>
    <ul class="pagination pagination-inverse">
      <li><?php echo $this->Paginator->sort('id','Id'); ?></li>
      <li><?php echo $this->Paginator->sort('manufacturer_id', 'Número de Pieza'); ?></li>
    </ul>
</div>

<?php foreach ($products as $product): ?>
  <div class="row striped slim">
    <div class="col-9">

      <div class="row">
        <div class="col-3 text-right light">
          Tipo de Producto
        </div>
        <div class="col-3 bold">
          <?php echo $this->Html->link($product['Type']['type_name'], array('controller' => 'types', 'action' => 'view', $product['Type']['id'])); ?>
        </div>

        <div class="col-3 text-right light">
          No. de Pieza
        </div>
        <div class="col-3">
          <?php echo h($product['Product']['manufacturer_id']); ?>
        </div>
      </div>
    </div>

    <div class="col-1">
      <?php echo $this->Html->link('Ver', array('action' => 'view', $product['Product']['id']), array('class' => 'btn btn-info btn-block btn-small')); ?>
    </div>

    <div class="col-1">
      <?php echo $this->Html->link('Editar', array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-success btn-block btn-small')); ?>
    </div>

    <div class="col-1">
      <?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-danger btn-block btn-small') , __('Seguro que quiere eliminar el producto # %s?', $product['Product']['id'])); ?>
    </div>
  </div>
<?php endforeach; ?>

<?php echo $this->element('paginator'); ?>


