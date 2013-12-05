<div class="grey-container">
	<?php 
		//Correo producto conocido
		if($email['Email']['id']==1){?>
		<h2>Correo molde para cotizaciones con producto</h2>
		
	<?php } else if($email['Email']['id']==2){
		//Correo producto desconocido?>
		<h2>Correo molde para cotizaciones sin producto</h2>
	<?php } elseif($email['Email']['id']==3){
		//Correo orden de compra?>
		<h2>Correo molde para ordenes de compra</h2>
	<?php }?>
	
<div class="cheat-sheet">
		<h4>Códigos</h4>
		<p>Utiliza los siguientes códigos entre llaves para reemplazarlos al momento de enviar los correos.</p>
		<p>Si no se ponen los códigos, estos datos no aparecerán en el correo.</p>
		<p>Ejemplo:<i>Hola {nombreContacto} necesito...</i></p>
		<h4>Códigos de proveedor</h4>
		<div class="row">
			<div class="col-3 text-right light">
				Organización del Proveedor
			</div>

			<div class="col-3">
				{organizacionProveedor}
			</div>

			<div class="col-3 text-right light">
				RFC del proveedor
			</div>

			<div class="col-3">
				{rfc}
			</div>		
		</div>
		<!-- otro renglon -->
		<div class="row">
			<div class="col-3 text-right light">
				Nombre del contacto
			</div>

			<div class="col-3">
				{nombreContacto}
			</div>

			<div class="col-3 text-right light">
				Email del contacto
			</div>

			<div class="col-3">
				{emailContacto}
			</div>		
		</div>
		<!-- otro renglon -->
		<div class="row">
			<div class="col-3 text-right light">
				Credito
			</div>

			<div class="col-3">
				{credito}
			</div>

			<div class="col-3 text-right light">
				Teléfono del contacto
			</div>

			<div class="col-3">
				{telefonoContacto}
			</div>		
		</div>
		<h4>Códigos de producto</h4>
		<?php 
		//Correo producto conocido
		if($email['Email']['id']==1 || $email['Email']['id']==3){?>
		<!-- otro renglon -->
		<div class="row">
			<div class="col-3 text-right light">
				Datos del producto
			</div>

			<div class="col-3">
				{datosProducto}
			</div>
		
		</div>
	<?php }
 		if($email['Email']['id']==2 || $email['Email']['id']==3){?>
		<div class="row">
			<div class="col-3 text-right light">
				Identificador del producto
			</div>

			<div class="col-3">
				{claveProducto}
			</div>
		
		</div>
	<?php }?>
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
