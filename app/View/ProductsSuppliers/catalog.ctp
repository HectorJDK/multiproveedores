<!-- uses $catalog -->
<?php echo $this->Html->script('productsSuppliers-catalog'); ?>

<h3>Catálogo de 
  <?php echo $this->Html->link($catalog->supplier['corporate_name'], array('controller' => 'suppliers', 'action' => 'view', $catalog->supplier['id'])); ?>
</h3>
<?php echo $this->Form->hidden('supplier_id', array('id' => 'supplier_id', 'value' => $catalog->supplier['id'])); ?>

<div class="row">
  <div class="col-9">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No. de Pieza</th>
          <th>Precio</th>
          <th>Fecha de Actualización</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($catalog->catalog_items as $catalog_item) :
        echo $this->Html->tableCells(
          array(
            $catalog_item->product['manufacturer_id'],
            $catalog_item->price,
            $catalog_item->last_update,
            $this->Form->button('Eliminar', array('onclick' => 'remove_product_from_supplier(' . $catalog_item->product['id'] . ')', 'class'=>'btn btn-danger btn-small'), array('class'=>'btn btn-danger btn-small'))

            ),
          array('id' => 'p-' . $catalog_item->product['id']),
                    array('id' => 'p-' . $catalog_item->product['id']) //sí, se necesita poner 2 veces. Uno para odds, otro para evens.
                    );
      endforeach;
      ?>
      </tbody>
    </table>
    <?php echo $this->element('paginator'); ?>
  </div>

  <div class="col-3">
    <div class="grey-container mini">
      <h4 class="light text-center"> Añadir producto a Catálogo </h4>
      <form class="text-right">
        <div class="form-fields">
          <label for="new_manufacurer_id">No. de Pieza: </label>
          <input type= "text" id="new_manufacturer_id" class="input-block"></input>
        </div>
        <div class="form-fields">
          <label for="new_price">Precio: </label>
          <input type= "text" id="new_price" class="input-block"></input>
        </div>

        <div class="text-right">
          <a onclick="ensure_that_supplier_supplies_product()" class="btn btn-success">Añadir</a>
        </div>
      </form>
    </div>    
  </div>
</div>


