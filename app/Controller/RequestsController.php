<?php
App::uses('AppController', 'Controller');
App::uses('TypesController', 'Controller');
App::uses('OriginsController', 'Controller');
App::uses('RequestServicesController', 'Controller');
App::uses('EmailConfig', 'Model');
App::uses('Email', 'Model');
App::uses('Supplier', 'Model');
App::uses('CakeEmail', 'Network/Email');
/**
* Requests Controller
*
* @property Request $Request
* @property PaginatorComponent $Paginator
*/
class RequestsController extends AppController {

	public $components = array('Paginator', 'RequestHandler');
	public $uses = array('Request', 'Type', 'Category');


	/**
	 * funcion index (Metodo de usuario)
	 * Esta funcion mostrara todos los "request" que no hayan sido tomados o "eliminados"
	 *
	 * @return void
	 */
	public function index() {
		$this->Request->recursive = 0;
		//Busqueda rápida
		if(isset($this->request->data["busqueda"])){
			//Solo mostrara las solicitudes que cumplan con el filtro
			$requests = $this->Paginator->paginate(array('Request.user_id' => null,'Request.id' => $this->request->data["busqueda"], 'Request.deleted' => 0));
			$this->set('busqueda', $this->request->data["busqueda"]);
		} else {
			//Mostrar todas las solicitudes
			$this->Paginator->settings = array(
            'limit' => 5);
			$requests = $this->Paginator->paginate(array('Request.user_id' => null, 'Request.deleted' => 0));
		}
		$this->set('requests', $requests);
	}

	/**
	 *
	 *@param string $id
	 *@return void
	 *
	 */
	public function myRequests()
	{
		$userId = $this->Auth->user('id');
		$this->Request->recursive = 0;
		$requests = $this->Paginator->paginate(array('Request.user_id' => $userId, 'Request.deleted' => 0));
		$this->set('requests', $requests);
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null)
	{
		//Marcar el nivel de recursion (mostrar datos dependientes de las llaves foraneas)
        $this->Request->id = $id;
		$this->Request->recursive = 0;

		//Vereficar que exista el id
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}

			//Obtener los datos del "request" que se desea mostrar
		$options = array('conditions' => array('Request.id' => $id));
		$request = $this->Request->find('first', $options);

			//Verificamos que el "request" no este tomado, si esta tomado por otro regresamos un error
		if(!isset($request['Request']['user_id']))
		{
			//El "request" esta vacio por lo tanto le asignamos el id del usuario logeado
			$this->Request->saveField('user_id', $this->Auth->user('id'));
		} elseif ($request['Request']['user_id'] != $this->Auth->user('id')) {
				//Verificamos que el "request" no le pertenezca de ser asi regresamos un error
			$this->Session->setFlash(__('La solicitud ha sido ya tomada. Favor de tomar otra'));
			return $this->redirect(array('action' => 'index'));
		}

		//Datos que se regresaran a la vista
		$request['Content']['xml'] = json_decode(json_encode((array) simplexml_load_string($request['Content']['xml'])),1);
		
		//Types
		$types = new TypesController();
		$this->set('types', $types->types_for_selector());

		//Categories
		$origins = new OriginsController();
		$this->set('categories', $origins->categories_for_selector());

		//Request
		$this->set('request', $request);
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {

			//Empezamos las transacciones
			$transaction = $this->Request->getDataSource();
			$transaction->begin();

			//Tenemos que crear el "content" y guardarlo
			$this->Request->Content->create();

			//Obtenemos los datos de Content
            $dataXML = $this->request->data['XML'];
			$content['comment'] = $this->request->data['Request']['comment'];
			$content['xml'] = $this->Request->Content->new_xml($dataXML);

			if ($this->Request->Content->save($content)) {
				
				//Obteniendo los datos para crear la solicitud
				$request = $this->request->data['Request'];
				$request['deleted'] = false;
				$request['user_id'] = $this->Auth->user('id');
				$request['content_id'] = $this->Request->Content->getInsertID();

				$this->Request->create();
				if ($this->Request->save($request)) {
					//Se ha guardado exitosamente el registro por lo tanto hacemos 
					$transaction->commit();
					$this->Session->setFlash(__('The request has been saved.'));
					return $this->redirect(array('action' => 'myRequests'));

				} else{
					$transaction->rollback();
					$this->Session->setFlash(__('The request could not be saved. Please, try again.'));	
				}

			} else {
				$transaction->rollback();
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));	
			}
		}

		//Valores que obtiene para mostrar no POST
		$categories = $this->Request->Origin->find('list');
		$contents = $this->Request->Content->find('list');
		$this->set(compact('categories', 'contents', 'users'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
			$request = $this->Request->find('first', $options);
			//Datos que se regresaran a la vista
			$request['Content']['xml'] = json_decode(json_encode((array) simplexml_load_string($request['Content']['xml'])),1);
			$this->set('request', $request);
			
			$this->Request->find('first', $options);
		}
		$categories = $this->Request->Origin->find('list');
		$contents = $this->Request->Content->find('list');
		$users = $this->Request->User->find('list');
		$this->set(compact('categories', 'contents', 'users'));

	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Request->delete()) {
			$this->Session->setFlash(__('The request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The request could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	/**
	 * Virtual delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function virtualDelete($id = null) {
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Request->saveField('deleted', '1')) {
			$this->Session->setFlash(__('The request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The request could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * release request
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function release($id = null) {
        //Damos el valor del id al objeto Request
        $this->Request->id = $id;

        //Solo se podra acceder a este metodo con las siguientes acciones HTTP
        $this->request->onlyAllow('post', 'delete');

        //Verificamos que exista el request a liberar
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}

        //Buscamos si tiene cotizaciones activas pendientes
        $this->Request->Quote->recursive = -1;
        $options = array('conditions' => array('Quote.request_id' => $id, 'Quote.deleted' => false));
        $quote = $this->Request->Quote->find('first', $options);

        //Verificamos que para poder liberar una cotizacion esta no tenga ninguna cotizacion activa
         if(count($quote) == 0)
         {
             if ($this->Request->saveField('user_id', null))
             {
                 $this->Session->setFlash(__('The request has been released.'));
             }
             else
             {
                 $this->Session->setFlash(__('The request could not be released. Please, try again.'));
             }
         }
         else
         {
             $this->Session->setFlash(__('No se puede liberar una solicitud que tenga cotizaciones activas'));
         }

        //Regresamos a la pagina mis request con el mensaje correspondiente
		return $this->redirect(array('action' => 'myRequests'));
	}

	/**
	 * duplicate method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function duplicate($id = null) {

        $id = $this->request->data["id_request"];

		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}

        //Limitar la busqueda
        $this->Request->recursive = -1;
		//Obtener los datos de la solicitud a duplicar
		$data = $this->Request->find('first', array('conditions' => array('Request.id' => $id)));

		//Quitar el id para evitar que haga update
		unset($data['Request']['id']);
        unset($data['Request']['created']);
        unset($data['Request']['modified']);
        unset($data['Request']['note']);
        unset($data['Request']['quantity']);

        //Inicializacion de los datos a gaurdar
        $data['Request']['deleted'] = 0;
        $data['Request']['note'] = $this->request->data['note'];

        $this->Request->create();
		if ($this->Request->save($data['Request'])) {
			$this->Session->setFlash(__('The request has been duplicated.'));
            $this->redirect(array('action' => 'view/'.$id));
		} else {
			$this->Session->setFlash(__('The request could not be duplicated. Please, try again.'));
		}
	}

	/**
	 * updateQuantity method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function updateQuantity() {		

		$this->autoRender = false;

		$datos=array();
		$datos= $this->request->data;		
		//Asignar el id de la solicitud a actualizar
		$this->Request->id = $datos[0];;
		if (!$this->Request->exists()) {
			echo json_encode(0);
		}			
		//Actualizar la cantidad		
		if ($this->Request->saveField('quantity', $datos[1])) {
			echo json_encode(1);
		} else {
			echo json_encode(0);
		}		
	}

	/**
	 * updateNotes method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function updateNotes() {		

		$this->autoRender = false;

		$datos=array();
		$datos= $this->request->data;		
		//Asignar el id de la solicitud a actualizar
		$this->Request->id = $datos[0];;
		if (!$this->Request->exists()) {
			echo json_encode(0);
		}			
		//Actualizar la nota		
		if ($this->Request->saveField('note', $datos[1])) {
			echo json_encode(1);
		} else {
			echo json_encode(0);
		}		
	}
   /**
     * quoteForType method
     *
     * @return void
     */
    public function quoteForType()
    {
        $this->autoLayout = false;
        $this->autoRender = false;

        $datos= $this->request->data;
        
        //Envio de correo 	    
	    $configEmail = new EmailConfig();
		//Cargar configuracion de mail
	    $Email = new CakeEmail($configEmail->cargarConfiguracion());
	    
	    //Reemplazar correo molde con los datos y enviar
	    $correoMolde = new Email();
	    $mensaje = $correoMolde->find('first'); 	    
	    $mensaje = $mensaje['Email']['email_body'];
       	//Obtener info de provedor  
       	$supplier = new Supplier();
       	$proveedor = $supplier->find('first', array(
        'conditions' => array('Supplier.id' => $datos[1])))['Supplier'];	                       
        
        //Reemplazar valores en correo molde
        //Claves del correo molde
        $claves = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}","{credito}",
        	"{telefonoContacto}","{datosProducto}");
        //Valores a reemplaazar de proveedor y tipo
        $valores = array($proveedor["corporate_name"],$proveedor["moral_rfc"],$proveedor["contact_name"],
        	$proveedor["contact_email"], $proveedor["credit"],$proveedor["contact_telephone"],$datos[2]        	
        	);
        //Mensaje modificado
        $mensaje = str_replace($claves, $valores, $mensaje);
        
        //Enviar el correo
        $Email->from(array('no-reply@multiproveedores.com' => 'Sistema Multiproveedores'))
    		->to($proveedor["contact_email"])
   			->subject('Solicitud de cotización de tipo')
    		->send($mensaje);

        //Crear una cotizacion nueva
        $quote['request_id'] = $datos[0];
        $quote['supplier_id']= $datos[1];
		
        $this->Request->id = $quote['request_id'];
        if (!$this->Request->exists()) {
            throw new NotFoundException(__('Invalid request'));
        }    

        if (!$this->Request->Quote->save($quote))
        {
            throw new InternalErrorException('No se pudo crear la cotización.');
            $this->response->statusCode(501);
        }
    }
    /**
     * quoteForProduct method
     *
     * @return void
     */
    public function quoteForProduct()
    {
        $this->autoLayout = false;
        $this->autoRender = false;
 		$datos= $this->request->data;

 		//Envio de correo 	    
	    $configEmail = new EmailConfig();
		//Cargar configuracion de mail
	    $Email = new CakeEmail($configEmail->cargarConfiguracion());
	    
	    //Reemplazar correo molde con los datos y enviar
	    $correoMolde = new Email();
	    $mensaje = $correoMolde->find('first'); 	    
	    $mensaje = $mensaje['Email']['email_body'];
       	//Obtener info de provedor  
       	$supplier = new Supplier();
       	$proveedor = $supplier->find('first', array(
        'conditions' => array('Supplier.id' =>  $datos[1])))['Supplier'];	       
        
        //Obtener info de producto
       	$product = new Product();
       	$producto = $product->find('first', array(
        'conditions' => array('Product.id' => $datos[2])))['Product'];	     
        
        //Reemplazar valores en correo molde
        //Claves del correo molde
        $claves = array("{organizacionProveedor}","{rfc}","{nombreContacto}","{emailContacto}","{credito}",
        	"{telefonoContacto}","{claveProducto}");
        //Valores a reemplaazar de proveedor y producto
        $valores = array($proveedor["corporate_name"],$proveedor["moral_rfc"],$proveedor["contact_name"],
        	$proveedor["contact_email"], $proveedor["credit"],$proveedor["contact_telephone"],
        	$producto["manufacturer_id"]
        	);
        //Mensaje modificado
        $mensaje = str_replace($claves, $valores, $mensaje);
        
        //Enviar el correo
        $Email->from(array('no-reply@multiproveedores.com' => 'Sistema Multiproveedores'))
    		->to($proveedor["contact_email"])
   			->subject('Solicitud de cotización de producto')
    		->send($mensaje);

        $this->Request->id = $datos[0];
        if (!$this->Request->exists()) {
            throw new NotFoundException(__('Invalid request'));
        }
        //Crear una cotizacion nueva
        $quote['request_id'] =  $datos[0];
        $quote['supplier_id']=  $datos[1];
		$quote['product_id']=  $datos[2];
        //Pendiente estado inicial checar
        $quote['status_quote_id'] = 1;

        if (!$this->Request->Quote->save($quote)) {
            throw new InternalErrorException('No se pudo crear la cotización.');
            $this->response->statusCode(501);
        }
    }
}
