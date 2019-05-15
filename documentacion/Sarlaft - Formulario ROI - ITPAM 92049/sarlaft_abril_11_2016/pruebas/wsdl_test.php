<?php
	
	$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
	//$options = array("login" => _USERWSAGE_, "password" => _PASSWORDWSAGE_);	

	//Se reaaliza conexión con ws y se trae información de acuerdo al pedido pasado en el parametro
	$client = new SoapClient($wsdl);
	$parametros = array(
		'palabra_clave' => 'jcadag',
		'atributo_filtro' => 'samaccountname',
		'atributos_retorna' => 'mail,employeeid,l,cn',
		'dominio' => 'epmtelco.com.co',
		'coincidencias' => 'false',
		'estado_usuario' => 'false',
		'grupos_usuario' => 'false',
		'aplicacion' => 'Sarlaft',
		'password_app' => 'sarlaft2015'			
	);
	
	//":{"login":1,"password":2,"aplicacion":"webapp","password_app":"b6920d9083c8e76685bcc8db34b8c9bb
	
	try {
		$response = $client->BuscarAtributosDA($parametros);
		print_r($response);
		echo $response['mail'];
	} catch (SoapFault $exception) {
		$retorno.= "Fallo al consultar";
	}
	
?>