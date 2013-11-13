<?php echo $this->AssetCompress->script('requests-view'); ?>

<div class="grey-container" >
  <h2>Solicitud #<?php echo $request['Request']['id']; ?></h2>
  
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
  <div class="row">
    <div class="col-3 text-right light">
      Notas
    </div>
    <div class="col-9">
      <?php echo h($request['Request']['note']); ?>
    </div>
  </div>

  <div class="text-right light">
    <?php echo $this->Html->link('Editar Notas', array('controller' => 'requests', 'action' => 'edit', $request['Request']['id']), array('class' => "btn btn-info btn-highlight")); ?>
    <?php echo $this->Html->link('Borrar Solicitud', array('controller' => 'requests', 'action' => 'delete', $request['Request']['id']), array('class' => "btn btn-danger btn-highlight"), __('Seguro que quiere borrar la solicitud # %s?', $request['Request']['id'])); ?>
  </div>
</div>

<!-- Búsqueda de proveedores mediante búsqueda de producto -->
<ul class="nav nav-tabs" id="search-tabs">
	<li class="active"><a href="#attributes">Busqueda por Atributos</a></li>
	<li><a href="#type">Busqueda por Tipo</a></li>
</ul>
 
 <!-- Tabs for advanced search -->
<div class="tab-content">
    <div class="tab-pane active" id="attributes">
<!-- 1: Búsqueda por atributo -->

	<label>Categoría:</label>
		<?php echo $this->Form->select('Categoría', $categories, array('id' => '1-category_id')); ?>
	<label>Tipo:</label>
		<?php echo $this->Form->select('Tipo', $types, array('id' => '1-product_type_id', 'onchange' => 'type_changed1()')); ?>

	<label> <?php echo __('Atributos del producto:') ?> </label>
	<div id="1-atributos"> </div>
	<input type="submit" value="Buscar" onClick="search1()" class="btn"/>
</div>

 <!-- 2: Búsqueda por tipo -->
 <div class="tab-pane" id="type">
 
       <label>Categoría:</label>
         <?php echo $this->Form->select('Categoría', $categories, array('id' => '2-category_id')); ?>
       <label>Tipo:</label>
         <?php echo $this->Form->select('Tipo', $types, array('id' => '2-product_type_id', 'onchange' => 'type_changed()')); ?>
       <input type="submit" value="Buscar" onClick="search2()" class="btn"/>
 
  </div>

  <div id="search_result"> </div>

  <script>
     $('#search-tabs a').click(function (e)
      {
        e.preventDefault();
        $(this).tab('show');
     })
   </script>

