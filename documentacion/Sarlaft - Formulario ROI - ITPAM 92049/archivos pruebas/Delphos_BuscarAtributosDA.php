<?php
ini_set('display_errors',1);

//$authWsdl = "http://unevm-pmap/ServicioAuth/ServicioWebAuth.php?wsdl"; Prod
//$authWsdl = "http://unevm-tmap/ServicioAuth/ServicioWebAuth.php?wsdl"; Prue
$authWsdl = "http://unevm-dmap/ServicioAuth/ServicioWebAuth.php?wsdl"; 

$soapClient = new SoapClient($authWsdl);

###### permite buscar cuentas de red a partir de un valor de atributo
/* FILIALES
*/
$filialesArray = array(
						"epmtelco.com.co",
						"etp.corp",
						"epmcc-pob.com",
						"colombiamovil.corp",
						"osi.local",
						"edatel.com.co",
					   );
					   
foreach($filialesArray as $filial)
{
	$param = array(
			'palabra_clave'=>'jnavarrm', // cualquier string que quieran buscar
			'atributo_filtro'=>'samaccountname', //atributo por el cual se realzara la busqueda
			'atributos_retorna'=>'mail,cn,department,departmentnumber,telephone', // atributos que quiero que retorne
			'dominio'=>$filial, //filial 
			'coincidencias'=>'false', // busqueda exacta (false) o parcial (true) de la plabra clave
			'estado_usuario'=>'true', //muestra o no, el estado de la cuenta de red
			'grupos_usuario'=>'false', // muestra o no, los grupos de la cuenta de red
			'aplicacion'=>'XXXXXXXXXXX', 
			'password_app'=>'XXXXXXXXXXX',
			);		
//Se consume el metodo servicio WEB
$wsResponse = $soapClient->BuscarAtributosDA($param);
echo "<hr>";
echo "<h3>".$filial."</h3>";
echo "<pre>";
print_r($wsResponse);
}					   
// si la respuesta tiene entries, entonces encontro el usuario