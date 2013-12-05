<?php
App::uses('AppController', 'Controller');
App::uses('EmailConfig', 'Model');
App::uses('Email', 'Model');
App::uses('CakeEmail', 'Network/Email');
/**
 * Emails Controller
 *
 * @property Email $Email
 * @property PaginatorComponent $Paginator
 */
class EmailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Email->recursive = 0;
		$this->set('emails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Email->exists($id)) {
			throw new NotFoundException(__('Invalid email'));
		}
		$options = array('conditions' => array('Email.' . $this->Email->primaryKey => $id));
		$this->set('email', $this->Email->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Email->create();
			if ($this->Email->save($this->request->data)) {
				$this->Session->setFlash(__('The email has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Email->exists($id)) {
			throw new NotFoundException(__('Invalid email'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Email->save($this->request->data)) {
				$this->Session->setFlash(__('The email has been saved.'));
				return $this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash(__('The email could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Email.' . $this->Email->primaryKey => $id));
			$email = $this->Email->find('first', $options);
			$this->set('email', $email);
			$this->request->data = $email;
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Email->id = $id;
		if (!$this->Email->exists()) {
			throw new NotFoundException(__('Invalid email'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Email->delete()) {
			$this->Session->setFlash(__('The email has been deleted.'));
		} else {
			$this->Session->setFlash(__('The email could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
 * sendEmailForQuote method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function sendEmailForQuote($proveedor, $producto=null, $datosProducto = null, $email, $pass_email) { 	


 		//Envio de correo 	    
	    $configEmail = new EmailConfig();
		//Cargar configuracion de mail		
		$datosConfig=$configEmail->cargarConfiguracion();
		$datosConfig['username']= $email;
		$datosConfig['password'] = $pass_email;
	    $Email = new CakeEmail($datosConfig);
	    
	    //Reemplazar correo molde con los datos y enviar
	    $correoMolde = new Email();
	    $mensaje = $correoMolde->find('first'); 	    
	    $mensaje = $mensaje['Email']['email_body'];                            
        
        //Reemplazar valores en correo molde
        if($datosProducto != null)
        {
	        //Claves del correo molde
	        $claves = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}","{credito}",
	        	"{telefonoContacto}","{datosProducto}");
	        //Valores a reemplaazar de proveedor y tipo
	        $valores = array($proveedor["corporate_name"],$proveedor["moral_rfc"],$proveedor["contact_name"],
	        	$proveedor["contact_email"], $proveedor["credit"],$proveedor["contact_telephone"],$datosProducto        	
	        	);
    	} else {    	 
	        //Claves del correo molde
	        $claves = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}","{credito}",
	        	"{telefonoContacto}","{claveProducto}");
	        //Valores a reemplaazar de proveedor y producto
	        $valores = array($proveedor["corporate_name"],$proveedor["moral_rfc"],$proveedor["contact_name"],
	        	$proveedor["contact_email"], $proveedor["credit"],$proveedor["contact_telephone"],
	        	$producto["manufacturer_id"]
	        	);
    	}
        //Mensaje modificado
        $mensaje = str_replace($claves, $valores, $mensaje);
        
        //Enviar el correo
        $Email->from(array('no-reply@multiproveedores.com' => 'Sistema Multiproveedores'))
    		->to($proveedor["contact_email"])
   			->subject('Solicitud de cotización')
    		->send($mensaje);
    }

    public function sendEmailForOrder($order, $supplier, $request, $product=null)
    {

        //Envio de correo
        $configEmail = new EmailConfig();
        //Cargar configuracion de mail
        $Email = new CakeEmail($configEmail->cargarConfiguracion());

        //Reemplazar correo molde con los datos y enviar
        $correoMolde = new Email();
        $message = $correoMolde->find('first');
        $message = $message['Email']['email_body'];

        //Reemplazar valores en correo molde
        if($product != null)
        {
            //Claves del correo molde
            $keys = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}","{credito}",
                "{telefonoContacto}","{datosProducto}");
            //Valores a reemplaazar de proveedor y tipo
            $values = array($supplier["corporate_name"], $supplier["moral_rfc"], $supplier["contact_name"],
                $supplier["contact_email"], $supplier["credit"], $supplier["contact_telephone"], $product
            );
        } else {
            //Claves del correo molde
            $keys = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}","{credito}",
                "{telefonoContacto}","{claveProducto}");
            //Valores a reemplaazar de proveedor y producto
            $values = array($supplier["corporate_name"], $supplier["moral_rfc"], $supplier["contact_name"],
                $supplier["contact_email"], $supplier["credit"], $supplier["contact_telephone"],
                $product["manufacturer_id"]
            );
        }
        //Mensaje modificado
        $message = str_replace($keys, $values, $message);

        //Enviar el correo
        $Email->from(array('no-reply@multiproveedores.com' => 'Sistema Multiproveedores'))
            ->to($supplier["contact_email"])
            ->subject('Orden')
            ->send($message);
    }


}
