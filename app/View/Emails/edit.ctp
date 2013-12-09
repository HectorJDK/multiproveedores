<div class="col-2">
	<ul class="dropdown-menu actions">
	  <h4 class="text-center light">Acciones</h4>
		<li><?php echo $this->Html->link('Correo 1', array('controller' => 'emails', 'action'=>'edit',1)); ?></li>
		<li><?php echo $this->Html->link('Correo 2', array('controller' => 'emails', 'action'=>'edit',2)); ?></li>
		<li><?php echo $this->Html->link('Correo 3', array('controller' => 'emails', 'action'=>'edit',3)); ?></li>
	</ul>
</div>
<div class="col-10">
	<div class="grey-container mini">
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
			<p>Utiliza los siguientes códigos entre llaves para reemplazarlos al momento de enviar los correos.</p>
			<p>Si no se ponen los códigos, estos datos no aparecerán en el correo.</p>
			<p>Ejemplo:<i>Hola {nombreContacto} necesito...</i></p>
			<h4 class="light">Códigos de proveedor</h4>
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
					Teléfono del contacto
				</div>

				<div class="col-3">
					{telefonoContacto}
				</div>		
			</div>
			<br />
			<h4 class="light">Códigos de producto</h4>
			<?php 
			//Correo producto conocido
			if($email['Email']['id']==1 || $email['Email']['id']==3){?>
			<!-- otro renglon -->
			<div class="row">
				<div class="col-3 text-right light">
					Identificador del producto
				</div>

				<div class="col-3">
					{identificadorProducto}
				</div>
				<div class="col-3 text-right light">
					Tipo de producto
				</div>

				<div class="col-3">
					{tipoProducto}
				</div>
			</div>
			<br />
			<h4 class="light">Códigos de atributos</h4>
			<div class="row">
				<div class="col-3 text-right light">
					Atributos
				</div>

				<div class="col-3">
					{atributos}
				</div>
				
			</div>
		<?php }
	 		if($email['Email']['id']==2){?>
			<div class="row">
				<div class="col-3 text-right light">
					Descripción del producto
				</div>

				<div class="col-3">
					{descripcionProducto}
				</div>
			
			</div>
		<?php }?>
		<?php 
	 		if($email['Email']['id']==3){?>
		<div class="row">
				<div class="col-3 text-right light">
					Logística de envío
				</div>

				<div class="col-3">
					{logisticaEnvio}
				</div>
			
			</div>
		<?php }?>

		<!-- otro renglon -->
		</div>
		<hr />

		<?php 
			echo $this->Form->create('Email', $options_for_form);
			echo $this->Form->input('with_copy', array('label' => 'Con copia (separados por comas):','class' => 'input-block', 'rows' => 1));
			echo $this->Form->input('email_body', array('label' => 'Comentarios', 'class' => 'input-block', 'rows' => 20));
		?>

		<div class="text-right">
	  <?php
	    echo $this->Form->end(array('label' => 'Guardar', 'div' => false, 'class' => 'btn btn-info'));
	  ?>
	  </div>

	</div>
</div>
