<div class="grey-container" >
  <h2>Editar Solicitud #<?php echo $request['Request']['id']; ?></h2>
  
  <!-- Categoria -->
  <div class="row">
    <div class="col-3 text-right light">
      Categoría
    </div>
    <div class="col-9">
      <?php echo $this->Html->link($request['Category']['url'], array('controller' => 'categories', 'action' => 'view', $request['Category']['id'])); ?>
    </div>
  </div>

  <!-- Datos Cliente -->
  <div class="row">
    <div class="col-3 text-right light">
      Datos del Cliente
    </div>
    <div class="col-9">
      <?php foreach ($request['Content']['xml']['Customer'] as $client_field): ?>
        <?php echo $client_field; ?><br />
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Datos Cliente -->
  <div class="row">
    <div class="col-3 text-right light">
      Datos del Producto
    </div>
    <div class="col-9">
      <?php foreach ($request['Content']['xml']['Product'] as $product_field): ?>
        <?php echo $product_field; ?><br />
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Comentario -->
  <div class="row">
    <div class="col-3 text-right light">
      Comentario
    </div>
    <div class="col-9">
      <?php echo $request['Content']['comment']; ?>
    </div>
  </div>

  <!-- Fecha -->
  <div class="row">
    <div class="col-3 text-right light">
      Fecha de creación
    </div>
    <div class="col-9">
      <?php echo $this->Time->format($request['Request']['created'], '%d/%m/%y', 'invalid'); ?>
    </div>
  </div>

  <div class="row">
    <div class="col-3 text-right light">
      Fecha de modificación
    </div>
    <div class="col-9">
      <?php echo $this->Time->format($request['Request']['modified'], '%d/%m/%y', 'invalid'); ?>
    </div>
  </div>

  <!-- Notas -->
  <hr />
  <div class="row">
	  <?php 
	  	echo $this->Form->create('Request', $options_for_form);
	  	echo $this->Form->input('Request.note', array('label' => 'Notas', 'class' => 'input-block', 'rows' => 5));
	  ?>
	  <div class="text-right">
	  	<?php echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));?>
	  	<?php echo $this->Html->link('Cancelar', array('controller' => 'requests', 'action' => 'view', $request['Request']['id']), array('class' => "btn btn-danger btn-highlight")); ?>
	  </div>
	</div>
</div>