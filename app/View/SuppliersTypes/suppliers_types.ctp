<!-- uses $supplier -->
<?php echo $this->Html->script('SuppliersTypes/suppliers_types'); ?>
<div class="col-2">
  <?php echo $this->element('suppliers_actions_view'); ?>
</div>

<div class="col-10">
  <h3>Tipos de Productos Provistos por 
    <?php echo $this->Html->link($supplier['Supplier']['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $supplier['Supplier']['id'])); ?>
  </h3>

  <?php echo $this->Form->hidden('supplier_id', array('id' => 'supplier_id', 'value' => $supplier['Supplier']['id'])); ?>
  <div class="row">
    <div class="col-8">
      <table class="table table-striped">
        <thead>
            <th>URL</th>
            <th></th>
        </thead>

        <tbody>
          <?php foreach ($types as $type) :
            echo $this->Html->tableCells(
              array(
                $type['Type']['type_name'],
                $this->Form->button('Eliminar', array('onclick' => 'remove_type_from_supplier(' . $type['Type']['id'] . ')', 'class'=>'btn btn-danger btn-small pull-right'), array('class'=>'btn btn-danger btn-small'))
                ),
              array('id' => 't-' . $type['Type']['id']),
                        array('id' => 't-' . $type['Type']['id']) //sí, se necesita poner 2 veces. Uno para odds, otro para evens.
                        );
          endforeach; ?>
        </tbody>
      </table>
      <?php echo $this->element('paginator'); ?>
    </div>

    <div class="col-4">
      <div class="grey-container suppliers_types" style="width:100%;">
        <h4 class="light text-center"> Relacionar un tipo de producto con este proveedor </h4>
        <form class="text-right">
          <div class="form-fields">
            <label for="new_type_name">Nombre del tipo: </label>
            <input type="text" id="new_type_name" placeholder="Indroduzca el nombre del tipo" class="input-block"></input>
          </div>

          <a onclick="ensure_that_supplier_supplies_type()" class="btn btn-success">Relacionar</a>
        </form>
      </div>
    </div>
  </div>
</div>