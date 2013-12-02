<div class="grey-container">
<h2>Molde para Correo #<?php echo $email['Email']['id'];?></h2>

	<div class="cheat-sheet">
		<h4>Códigos</h4>
		<p>Utiliza los siguientes código para blah blah</p>
		<p>Si no se ponen los codigos estos elementos no apareceran en el correo blah blah</p>
		<div class="row">
			<div class="col-3 text-right light">
				Proveedor
			</div>

			<div class="col-3">
				{*p*}
			</div>

			<div class="col-3 text-right light">
				Id Producto
			</div>

			<div class="col-3">
				{*p_id*}
			</div>		
		</div>
		<!-- otro renglon -->
		<div class="row">
			<div class="col-3 text-right light">
				Cantidad
			</div>

			<div class="col-3">
				{*qty*}
			</div>

			<div class="col-3 text-right light">
				Remitente
			</div>

			<div class="col-3">
				{*user_name*}
			</div>		
		</div>
	<!-- otro renglon -->
	</div>

	<hr />

	<?php 
		echo $this->Form->create('Email', $options_for_form);
		echo $this->Form->input('with_copy', array('label' => 'Con copia:','class' => 'input-block', 'rows' => 1));
		echo $this->Form->input('email_body', array('label' => 'Comentarios', 'class' => 'input-block', 'rows' => 20));
	?>

	<div class="text-right">
  <?php
    echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
  ?>
  </div>

</div>
