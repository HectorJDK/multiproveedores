<?php
class RequestServicesController extends AppController {
	public $uses = array('Content', 'Request', 'Category');
	public $components = array('RequestHandler');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('newOnlineRequest');
	}

	/**
	 * newOnlineRequest method
	 *
	 * @return void
	 */
	public function newOnlineRequest()
	{
		$this->response->header('Access-Control-Allow-Origin', 'http://origen.herokuapp.com');
		$this->response->header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		$this->response->header('Access-Control-Allow-Headers ', 'Content-Type' );
		$this->response->header('Content-Type ', 'multipart/form-data');

		$this->autoRender = false;
		$transaction = $this->Content->getDataSource();
		$transaction->begin();
		$this->Content->create();

		try{
			$content['comment'] = $this->request->data['comentario'];
			$content['xml'] = $this->newXml($this->request->data);

			if($this->Content->save($content)){
				$url = $this->request->data['url'];

				$this->Category->recursive = -1;
				$url = $this->Category->findByUrl($url);

				$this->Request->create();
				$request['category_id'] = $url['Category']['id'];
				$request['content_id'] = $this->Content->getInsertID();

				if ($this->Request->save($request)) {
					$transaction->commit();
					echo "funciona";

				} else{
					$transaction->rollback();
					print_r($request);
					echo "</br>";
					print_r($url['Category']);
					echo "No funciona";
				}

			} else {
				$transaction->rollback();
				print_r($request);
				echo "</br>";
				print_r($url['Category']);
				echo "no funciona";
			}
		}catch(Exception $e) {
			echo $e;
		}
	}

	private function newXml($data)
	{
		$xmlDoc = new DOMDocument('1.0');
		$xmlDoc->formatOutput = true;

		//Elemento raiz
		$root = $xmlDoc->createElement('Request');
		$root = $xmlDoc->appendChild($root);

		//Elemento cliente
		$customer = $xmlDoc->createElement('Customer');
		$customer = $root->appendChild($customer);

		//Elemento producto
		$product = $xmlDoc->createElement('Product');
		$product = $root->appendChild($product);


		//Iterar y agregar los campos
		foreach ($data as $campos => $value) {
			$tipo = substr($campos, 0, 2);
			$campo = substr($campos, 3);
			switch($tipo){

				//Campo de cliente
				case "cl":
				$campo = $xmlDoc->createElement($campo);
				$campo = $customer->appendChild($campo);
				$valor = $xmlDoc->createTextNode($value);
				$valor = $campo->appendChild($valor);
				break;

				//Campo de producto
				case "pd":
				$campo = $xmlDoc->createElement($campo);
				$campo = $product->appendChild($campo);
				$valor = $xmlDoc->createTextNode($value);
				$valor = $campo->appendChild($valor);
				break;
			}
		}
		$xml =  $xmlDoc->saveXML();
		return $xml;
	}
}