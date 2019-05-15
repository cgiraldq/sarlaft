<?php
ini_set('display_errors',1);

/** 
* Si la aplicacion que utliza el servicio de delphos esta en los servidores externos UNEVM-PWEB20, utilizar
* el dominio UNE.NET.CO en la URL del servicio. si esta en UNEVM-PWEB1-9 o en los servidores internos NETVM-PWEB
* puede utilizar EPMTELCO.COM.CO.
*/

//$authWsdl = "http://unevm-pmap.epmtelco.com.co/ServicioAuth/ServicioWebAuth.php?wsdl"; //PRODUCCION
//$authWsdl = "http://unevm-tmap.epmtelco.com.co/ServicioAuth/ServicioWebAuth.php?wsdl"; //PRUEBAS
$authWsdl = "http://unevm-dmap.epmtelco.com.co/ServicioAuth/ServicioWebAuth.php?wsdl"; 

$soapClient = new SoapClient($authWsdl);

###### Consumir el servicio de Autenticacion para cualquier directorio activo
					
//Se consume el metodo servicio WEB
/**Parametros de entrada: 
 * 
* $params = array('login' => 'usuario de red',
            'password' => 'xxxxxxx',
            'dominio' => '', // si se deja vacio, busca en todos los dominios, sino busca por la palabra clave. ejemplo "epmtelco"
            'aplicacion' => 'Aplicacion', // La aplicacion se registra en delphos
            'password_app' => 'Clave Aplicacion' // la contraseña se registra en delphos
             );
*/
$params = array('login' => 'LOGIN',
            'password' => 'PASSWORD',
            'dominio' => '',
            'aplicacion' => 'XXXXXXXXXX',
            'password_app' => 'XXXXXXXXXX'
             );

$wsResponse = $soapClient->AutenticarMultiplesDA($params);

//el servicio retornara:
/**
stdClass Object
(
    [accion_realizada] => 1
    [CodRespuesta] => 1 //este digito puede variar entre 0 y 1. si es cero, es que en ningun dominio lo encontro. si es 1, minimo un dominio fue encontrado.
    [Mensaje] => {"wsResponse":{"yyyyyyy":{"epmtelco.com.co":[{"code":1,"message":"User Found"}],"epmcc-pob.com":[{"code":0,"message":"User Disabled\/not Found"}],"colombiamovil.corp":[{"code":0,"message":"User Disabled\/not Found"}]}}}
    [CodError] => 
)
*/
echo "<pre>";
print_r($wsResponse);