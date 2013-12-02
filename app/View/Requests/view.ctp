<?php
	echo $this->AssetCompress->script('requests-view');
?>
<input id="request_id" type="hidden" value='<?php echo $request['Request']['id'] ?>'/>
<div class="grey-container" >
	<!-- Here is the button to duplicate a request -->
	<div class="pull-right">
		<button class="btn btn-info btn-large" data-furatto="modal" data-target="#modal-1" data-transition="8" data-theme="info">Duplicar Solicitud</button>
	</div>
	<h2 class="">Solicitud #<?php echo $request['Request']['id']; ?></h2>

<!-- Origen -->
<?php if (is_null(!$request['Origin']['url'])): ?>
	<div class="row">
		<div class="col-3 text-right light">
			Pagina Origen
		</div>
		<div class="col-9">
			<?php echo $this->Html->link($request['Origin']['url'], array('controller' => 'origins', 'action' => 'view', $request['Origin']['id'])); ?>
		</div>
	</div>
<?php endif; ?>


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


  <!-- Notas -->
  <div class="row">
	<div class="col-3 text-right light">
	  Notas
	</div>
	<div class="col-9">
	  <?php echo $this->Form->textarea('Request.notes', array('id' => 'request_notes', 'label' => '', 'cols'=> 45,
	  'rows'=>5,'default'=>$request['Request']['note'],'onchange' => 'update_notes_request(this,'.$request['Request']['id'].')')); ?>
	</div>
  </div>
  <!-- Cantidad-->
  <div class="row">
	<div class="col-3 text-right light">
	  Cantidad
	</div>
	<div class="col-9">
	  <?php echo $this->Form->input('Request.quantity', array('id' => 'request_quantity', 'label' => '',
	  'onchange' => 'updateQty(this,'.$request['Request']['id'].')','default'=>h($request['Request']['quantity'])));?>
	</div>
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

	<?php echo $this->Form->create('Supplier', array('method' => 'GET', 'controller' =>'suppliers', 'action' => 'suppliers_for_category_product_type')); ?>

		<label>Categoría:</label>
		 <?php echo $this->Form->select('category', $categories, array('id' => '2-category_id')); ?>
		<label>Tipo:</label>
		 <?php echo $this->Form->select('type', $types, array('id' => '2-product_type_id', 'onchange' => 'type_changed()')); ?>
		 <?php echo $this->Form->hidden('request', array('value'=> $request['Request']['id'], 'name'=>'request_id')); ?>

	<?php echo $this->Form->end(array('label' => 'Buscar')); ?>

</div>

  <div id="search_result"> </div>

  <script>
	   $('#search-tabs a').click(function (e)
		{
		  e.preventDefault();
		  $(this).tab('show');
	   })
	 </script>

<!-- Div de modal -->
 <div class="modal" id="modal-1">
    <div class="modal-content">
      <h3>Nueva solicitud</h3>
      <div>
      	<form action="/multiproveedores/requests/duplicate" method="POST">
      		Nueva Nota
      		<input type="hidden" name="id_request" value="<?php echo $request['Request']['id']; ?>"/>
      		<textarea name="note" rows="4" cols="50"> </textarea>
    	    <button class="btn btn-info" type="submit">Guardar</button>
    	</form>
        	<button class="modal-close">Cancelar</button>
	    </form>
      </div>
    </div>
  </div>