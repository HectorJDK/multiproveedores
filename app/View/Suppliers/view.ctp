<?php
  echo $this->element('suppliers_actions_view');
  echo $this->Html->script('suppliers-view');
?>

<div class="grey-container" >
  <h2><?php echo $supplier['Supplier']['corporate_name']; ?></h2>
  <div class="row">
    <div class="col-6">
      <!-- RFC -->
      <div class="row">
        <div class="col-5 text-right light">
          RFC
        </div>
        <div class="col-7 bold">
          <?php echo $supplier['Supplier']['moral_rfc']; ?>
        </div>
      </div>

      <!-- Credito -->
      <div class="row">
        <div class="col-5 text-right light">
          Crédito
        </div>
        <div class="col-7 bold">
          <?php
            if($supplier['Supplier']['credit']){
              echo "Si";
            }else{
              echo "No";
            }
          ?>
        </div>
      </div>

      <!-- Cotizaciones aceptadas -->
      <div class="row">
        <div class="col-5 text-right light">
          Razon de Cotizaciones
        </div>
        <div class="col-7 bold">
          <?php echo'<span class="green">'.$supplier['Supplier']['accepted_quotes'].'</span>'." de ".($supplier['Supplier']['accepted_quotes'] + $supplier['Supplier']['rejected_quotes']); ?>
          <a href="#" class="red" data-toggle="tooltip" data-placement="right" title="" data-original-title=<?php echo 'Por'.'&nbsp;'.'precio:'.$supplier['Supplier']['rejected_price'].','.'&nbsp;'.'Por'.'&nbsp;'.'Existencia:'.$supplier['Supplier']['rejected_existance'].','. '&nbsp;', 'Por'.'&nbsp;'.'Tiempo'.'&nbsp;'.'de'.'&nbsp;'.'Respuesta:'.$supplier['Supplier']['rejected_response'],',', '&nbsp;', 'Por'.'&nbsp;'.'Tiempo'.'&nbsp;'.'de'.'&nbsp;'.'Entrega:'.$supplier['Supplier']['rejected_delivery'] ;?>>
              <i class="icon-arrow-down"></i>
            </a>
        </div>
      </div>

    </div>

    <!-- Datos de Contacto -->
    <div class="col-6">
      <div class="row">
        <div class="col-5 text-right light">
          Contacto
        </div>
        <div class="col-7 bold">
          <?php echo $supplier['Supplier']['contact_name']; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-5 text-right light">
          Email
        </div>
        <div class="col-7 bold">
          <?php echo $this->Text->autoLinkEmails($supplier['Supplier']['contact_email']); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-5 text-right light">
          Contacto
        </div>
        <div class="col-7 bold">
          <?php echo $supplier['Supplier']['contact_name']; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-5 text-right light">
          Teléfono
        </div>
        <div class="col-7 bold">
          <?php echo $supplier['Supplier']['contact_telephone']; ?>
        </div>
      </div>
    </div>
  </div>

    <!-- Rating -->
  <hr/>
  <div class="row">
    <div class="col-2 light">
      Rating
    </div>
    <div class="col-2">
      <?php for($i = 1; $i <= $supplier['Supplier']['rating']; $i++){
        echo "<i class=\"icon-star\"></i>";
      }
      ?>
    </div>

    <div class="col-2 text-right light">
      Pagado
    </div>
    <div class="col-2 green">
      <?php echo $supplier['Supplier']['payed']?>
    </div>

    <div class="col-2 text-right light">
      Deuda
    </div>
    <div class="col-2 red">
      <?php echo $supplier['Supplier']['debt']?>
    </div>
  </div>

  <div class="text-right" style="margin-top: 30px;">
    <?php echo $this->Html->link("Ver Catálogo", array('controller' => 'productsSuppliers', 'action' => 'catalog', $supplier['Supplier']['id']), array('class' => 'btn btn-warning')); ?>
    <?php echo $this->Html->link("Editar", array('action' => 'edit', $supplier['Supplier']['id']), array('class' => 'btn btn-success')); ?>
    <?php echo $this->Form->postLink("Eliminar", array('action' => 'delete', $supplier['Supplier']['id']), array('class' => 'btn btn-danger'), __('¿Estás seguro de querer borrar %s?', $supplier['Supplier']['corporate_name'])); ?>
  </div>
</div>
