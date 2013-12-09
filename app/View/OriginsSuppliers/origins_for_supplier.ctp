<!-- uses $supplier, $origins, $all_origins -->
<?php echo $this->Html->script('originsSuppliers-originsForSupplier'); ?>
<div class="col-2">
  <?php echo $this->element('suppliers_actions_sections'); ?>
</div>
<div class="col-10">
  <h3>Orígenes para <?php echo $this->Html->link($supplier['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $supplier['id'])); ?>
  </h3>
  <?php echo $this->Form->hidden('supplier_id', array('id' => 'supplier_id', 'value' => $supplier['id'])); ?>

  <div class="row">
    <div class="col-8">
      <table class="table table-striped">
        <thead>
            <th>URL</th>
            <th></th>
        </thead>

        <tbody>
          <?php foreach ($origins as $origin) :
            echo $this->Html->tableCells(
              array(
                $origin['url'],
                $this->Form->button('Eliminar', array('onclick' => 'removeOriginFromSupplier(' . $origin['id'] . ')', 'class'=>'btn btn-danger btn-small pull-right'))
                ),
              array('id' => 'o-' . $origin['id']),
                        array('id' => 'o-' . $origin['id']) //sí, se necesita poner 2 veces. Uno para odd rows, otro para evens.
                        );
          endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="col-4">
      <div class="grey-container mini">
        <h4 class="light text-center"> Relacionar con otro Origen </h4>
        <form class="text-right" >
          <div class="form-fields">
            <label for="new_url">URL:</label>
            <select class="input-block" id="new_url">
              <?php
              foreach ($all_origins as $origin) :
                echo '<option value = "' . $origin['Origin']['id'] . '">' . $origin['Origin']['url'] . '</option>';
              endforeach;
              ?>
            </select>
          </div>
          <a onclick="addOriginToSupplier()" class="btn btn-success">Añadir</a>
          
        </form>
      </div>
    </div>
  </div>
</div>