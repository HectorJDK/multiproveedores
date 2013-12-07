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
				$this->Email->id=$id;
			if ($this->Email->save($this->request->data)) {
				$this->Session->setFlash(__('El correo molde ha sido actualizado.'));
				return $this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash(__('El correo molde no se pudo actualizar.'));
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
	public function sendEmailForQuote($proveedor, $producto=null, $datosProducto = null, $email) { 	


 		//Envio de correo 	    
	    $configEmail = new EmailConfig();
		//Cargar configuracion de mail
		$datosConfig = $configEmail->cargarConfiguracion();

	    $Email = new CakeEmail($datosConfig);
	    
	    //Reemplazar correo molde con los datos y enviar
	    $correoMolde = new Email();	                      
        
        //Reemplazar valores en correo molde
        if($producto != null)
        {
        	//Obtener molde con producto
        	$correo = $correoMolde->find('first', array('conditions'=>array('Email.id'=>1))); 	    
	        //Claves del correo molde
	        $claves = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}",
	        	"{telefonoContacto}","{identificadorProducto}","{tipoProducto}", "{atributos}");
	        //Valores a reemplaazar de proveedor y tipo
	        $valores = array($proveedor["corporate_name"],$proveedor["moral_rfc"],$proveedor["contact_name"],
	        	$proveedor["contact_email"], $proveedor["contact_telephone"],
	        	$producto["manufacturer_id"], $producto["type_id"]       	
	        	);
    	} else  if($datosProducto != null){  
    		//Obtener molde sin producto
    		$correo = $correoMolde->find('first', array('conditions'=>array('Email.id'=>2))); 	    
	      	 
	        //Claves del correo molde
	        $claves = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}",
	        	"{telefonoContacto}","{descripcionProducto}");
	        //Valores a reemplaazar de proveedor y producto
	        $valores = array($proveedor["corporate_name"],$proveedor["moral_rfc"],$proveedor["contact_name"],
	        	$proveedor["contact_email"],$proveedor["contact_telephone"],
	        	$datosProducto
	        	);
    	}

    	//Mensaje del molde original
    	$mensaje = $correo['Email']['email_body'];  
        //Mensaje modificado
        $mensaje = str_replace($claves, $valores, $mensaje);
        
        //Enviar el correo
        $Email->from(array('no-reply@multiproveedores.com' => 'Sistema Multiproveedores'));
		$Email->to($proveedor["contact_email"]);
		$Email->replyTo($email);
        if(!is_null($correo['Email']['with_copy']))
            $Email->addCc(str_replace(' ', '', $correo['Email']['with_copy']));
		$Email->subject('Solicitud de cotización');
		$Email->send($mensaje);
    }

    public function sendEmailForOrder($order, $supplier, $request, $email, $logistics, $product, $copy )
    {

        //Envio de correo
        $configEmail = new EmailConfig();
        //Cargar configuracion de mail		
		$datosConfig=$configEmail->cargarConfiguracion();		
	    $Email = new CakeEmail($datosConfig);

        //Reemplazar correo molde con los datos y enviar
        $correoMolde = new Email(); 
        $correo = $correoMolde->find('first', array('conditions'=>array('Email.id'=>'3')));
        $message = $correo['Email']['email_body'];

        $attributes = $this->formatAttributes($product);
        
        //Claves del correo molde
        $keys = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}",
            "{telefonoContacto}","{logisticaEnvio}", "{atributos}");
        //Valores a reemplaazar de proveedor y producto
        $values = array($supplier["corporate_name"], $supplier["moral_rfc"], $supplier["contact_name"],
            $supplier["contact_email"], $supplier["contact_telephone"],$logistics, $attributes
        );
        //Inicializacion
        $cc = "";
        //Mensaje modificado
        $message = str_replace($keys, $values, $message);

        //Enviar el correo
        $Email->from(array('no-reply@multiproveedores.com' => 'Sistema Multiproveedores'));
        $Email->to($supplier["contact_email"]);
        $Email->replyTo($email);
        if(!empty($correo['Email']['with_copy']))	
        {
        	$cc .= str_replace(' ', '', $correo['Email']['with_copy']);
    	}
    	elseif(!empty($copy))
    	{
    		$cc .= str_replace(' ', '', $copy);
    	} 

    	if (!empty($cc)) 
    	{
    		$Email->addCc($cc);
    	}

        $Email->subject('Orden de compra');
        $Email->send($message);
    }

    public function formatAttributes($product){
    	$attributes = "";
    	foreach($product['Attribute'] as $attribute){
    		$attributes.=$attribute['name']."-".$attribute['AttributesProduct']['value']."\r\n";
    	}
    	return $attributes;
    }
}
