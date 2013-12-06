<?php 
  echo $this->element('suppliers_actions');
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
          Cotizaciones
        </div>
        <div class="col-7 bold">
          <?php echo $supplier['Supplier']['accepted_quotes']."/".($supplier['Supplier']['accepted_quotes'] + $supplier['Supplier']['rejected_quotes']); ?>
        </div>
      </div>

      <!-- Rating -->
      <div class="row">
        <div class="col-5 text-right light">
          Rating
        </div>
        <div class="col-7">
          <?php for($i = 1; $i <= $supplier['Supplier']['rating']; $i++){
            echo "<i class=\"icon-star\"></i>";
          } 
          ?>
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

  <div class="text-right">
    <?php echo $this->Html->link("Editar", array('action' => 'edit', $supplier['Supplier']['id']), array('class' => 'btn btn-success')); ?>
    <?php echo $this->Form->postLink('Borrar', array('action' => 'delete', $supplier['Supplier']['id']), null, __('¿Estás seguro de querer borrar a %s?', $supplier['Supplier']['corporate_name'])); ?>
  </div>
</div>
