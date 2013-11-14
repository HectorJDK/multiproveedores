<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('custom');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('furatto');
		echo $this->Html->css('ui-lightness/jquery-ui');
		echo $this->Html->css('pagination');


		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery-ui');
		echo $this->Html->script('furatto');
		echo $this->Html->script('bootstrap-tab');
		


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php if ($this->Session->read('Auth.User')){ 
		$this->BootstrapNavbar->create (array('fixed'=>'top', 'responsive'=>'false')) ;
        $this->BootstrapNavbar->brand('Multiproveedores', array('controller'=>'requests', 'action'=>'index')) ;
        $this->BootstrapNavbar->beginMenu ('Solicitudes') ;
            $this->BootstrapNavbar->link ('Mis Solicitudes', array('controller'=>'requests', 'action'=>'myRequests')) ;
            $this->BootstrapNavbar->link ('Solicitudes Activas', array('controller' => 'requests', 'action'=>'index')) ;
            $this->BootstrapNavbar->link ('Crear Solicitud', array('controller' => 'requests', 'action'=>'add')) ;
        $this->BootstrapNavbar->endMenu () ;
        $this->BootstrapNavbar->beginMenu ('Cotizaciones') ;
            $this->BootstrapNavbar->link ('Cotizaciones Pendientes', array('controller'=>'quotes', 'action'=>'index')) ;
        $this->BootstrapNavbar->endMenu () ;
        $this->BootstrapNavbar->beginMenu ('Ordenes') ;
            $this->BootstrapNavbar->link ('Ordenes por Cerrar', array('controller'=>'orders', 'action'=>'index')) ;
        $this->BootstrapNavbar->endMenu () ;
        $this->BootstrapNavbar->beginMenu ('Cuentas') ;
            $this->BootstrapNavbar->link ('Cuentas por Pagar', array('controller'=>'accounts', 'action'=>'index')) ;
            $this->BootstrapNavbar->link ('Historial de Pagos', array('controller' => 'accounts', 'action'=>'index')) ;
        $this->BootstrapNavbar->endMenu () ;
        $this->BootstrapNavbar->beginMenu ('Usuario') ;
            $this->BootstrapNavbar->link ('Cambiar Contraseña', array('controller'=>'users', 'action'=>'index')) ;
            $this->BootstrapNavbar->divider() ;
            $this->BootstrapNavbar->link ('Cerrar Sesión', array('controller' => 'users', 'action'=>'logout')) ;
        $this->BootstrapNavbar->endMenu () ;
    $this->BootstrapNavbar->end () ;
    
    echo $this->BootstrapNavbar->compile () ;

	} ?>

		<div id="content" class="inner-960">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
      
		</div>
	</div>
</body>
</html>
