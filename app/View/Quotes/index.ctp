<?php echo $this->Html->script('quotes-index'); ?>
<h3>Cotizaciones Pendientes</h3>

<div class="filters">
	<span>Ordenar por:</span>
	<ul class="pagination pagination-inverse">
		<li><?php echo $this->Paginator->sort('created', 'Fecha'); ?></li>
	</ul>
</div>

<?php 
 //echo "<pre>". print_r($this->element('sql_dump'),TRUE)."</pre>";
foreach ($requests as $request): ?>
	
<form id="<?php echo $request['Request']['id'] ?>" method="post" action="quotes/processQuotes">
    <input type="hidden" name="data[request_id]" value="<?php echo $request['Request']['id'] ?>"/>
	<div class="row slim">
		<!-- Request -->
		<div class="row striped shaded">
			<div class="col-6">
				<?php echo $this->Html->link("Solicitud #".$request['Request']['id'], array('controller' => 'requests', 'action' => 'view', $request['Request']['id'])); ?>
			</div>
		  <div class="col-3">
		  	Fecha de creación: <?php echo $this->Time->format($request['Request']['created'], '%d/%m/%y', 'invalid'); ?>
		  </div>

		  <div class="col-3">
		  	<input type='submit' class="btn btn-small btn-info" value='Procesar Orden de Compra'/input>
		  </div>
		</div>

		<?php foreach ($request['Quote'] as $keyQ =>$quote):
            echo $this->element('Quotes/pending', array('quote' => $quote, 'keyQ'=>$keyQ));
		 endforeach;?>
	</div>
</form>
<?php endforeach; ?>
<?php echo $this->element('paginator'); ?>