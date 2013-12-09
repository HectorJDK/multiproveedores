<div id = "search_products">
  <?php if (count($result) == 0)
  {
    echo "No hubo resultados.";
  }
  else
  {
    foreach ($result as $product): ?>
    <div class="row striped slim" id= "<?php echo $product->id ?>">
      <div class="col-9">
        <div class="row">
          <div class="col-6">
            <?php echo $product->manufacturer_id ?>
          </div>
        </div>
        <div class="row">
          <div class="col-3 text-right light">
            Atributos:
          </div>
          <div class="col-5">
            <table id="attributes_table" name="attributes_table" class="table table-condensed">

              <!-- atributos existentes -->
              <?php foreach ($product->attributes as $attribute): ?>

                <tr>
                  <td><?php echo $attribute[1] ?></td>

                  <td>
                    <?php echo $attribute[2]; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
      <div class="col-3">
        <select class="select_id" id="<?php echo $product->id ?>">
          <option value="0">No buscar producto</option>
          <option value="1">Solo Originales</option>
          <option value="2">Solo Genericos</option>
          <option value="3">Originales y Genericos</option>
        </select>
      </div>
    </div>
  <?php endforeach; ?>

  <?php echo $this->Form->create('Suppliers', array( 'id'=>'suppliers_search',
    'controller' => 'suppliers',
    'action' => 'suppliers_for_products')); ?>
    <?php echo $this->Form->hidden('products_for_suppliers', array('id'=> 'products_for_suppliers')); ?>
    <?php echo $this->Form->hidden('request_id', array('id'=> 'suppliers_request_id')); ?>
    <?php echo $this->Form->end(array('label'=>'Buscar Proveedores', 'class'=>'btn btn-success pull-right', 'onclick'=>'update_suppliers_search_form_values()')); ?>
    <?php }  ?>
</div>