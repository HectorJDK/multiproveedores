<h2>Tipos de Productos</h2>

  <div class="filters">
    <span>Ordenar por:</span>
    <ul class="pagination pagination-inverse">
      <li><?php echo $this->Paginator->sort('type_name', 'Nombre'); ?></li>
    </ul>
  </div>
  <?php foreach ($types as $type): ?>
  <div class="row striped slim">
    <div class="col-8">
        <div class="col-2 light">
          Id
        </div>
        <div class="col-2">
          <?php echo $type['Type']['id']; ?>
        </div>
        <div class="col-2 light">
          Nombre
        </div>
        <div class="col-2">
          <?php echo $type['Type']['type_name']; ?>
        </div>
    </div>
    <div class="col-2 text-center">
      <?php
        echo $this->Html->link("Ver", array('action' => 'view', $type['Type']['id']), array('class' => 'btn btn-info btn-block btn-small'));
      ?>
    </div>
    <div class="col-2 text-center">
      <?php echo $this->Html->link("Borrar", array('action' => 'delete', $type['Type']['id']), array('class' => 'btn btn-danger btn-block btn-small'));
      ?>
    </div>
  </div>
  <?php endforeach; ?>

  <?php echo $this->element('paginator'); ?>
</div>

