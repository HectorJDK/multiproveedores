<div class="col-2">
  <?php echo $this->element('products_actions'); ?>
</div>

<div class="col-10">
  <h1>Tipos de Productos</h1>
  <div class="filters">
    <span>Ordenar por:</span>
    <ul class="pagination pagination-inverse">
      <li><?php echo $this->Paginator->sort('type_name', 'Nombre'); ?></li>
    </ul>
  </div>
  <?php foreach ($types as $type): ?>
    <div class="row striped slim">
      <div class="col-1 light">
        <?php echo $type['Type']['id']; ?>
      </div>
      <div class="col-8">
        <?php echo $type['Type']['type_name']; ?>
      </div>
      <div class="col-1 text-center">
        <?php
          echo $this->Html->link("Ver", array('action' => 'view', $type['Type']['id']), array('class' => 'btn btn-info btn-block btn-small'));
        ?>
      </div>
      <div class="col-1 text-center">
        <?php echo $this->Html->link("Editar", array('action' => 'edit', $type['Type']['id']), array('class' => 'btn btn-success btn-block btn-small')); ?>
      </div>
      <div class="col-1 text-center">
        <?php echo $this->Form->postLink("Eliminar", array('action' => 'delete', $type['Type']['id']), array('class' => 'btn btn-danger btn-block btn-small'), __('¿Estás seguro de querer borrar el tipo de producto  %s?', $type['Type']['type_name'])); ?>
      </div>
    </div>
  <?php endforeach; ?>

  <?php echo $this->element('paginator'); ?>
</div>
