<?php
error_reporting(E_ERROR); //(^)excluye; (|)incluye
/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */
// =========================================
// CONFIGURACIONES COMUNES A LOS 3 AMBIENTES
// =========================================

$hostname = gethostname();
$deploy = array();
//net-dsql04
//Configuración para DESARROLLO
if (strpos($hostname, 'dint') !== false) {
    $deploy = array('0' => 'd-',
                    '1' => 'xxxxxxxxx',
                    '2' => 'DLLO',
                    '3' => '/datos/www/icuservices/Logs/'.$hostname.'/',
                    );
    $instance = 'net-dsql04';
    $passwd = 'yyLbxN1Et3iQTOFw';
}

//Configuración para PRUEBAS
elseif (strpos($hostname, 'tint') !== false) {
    $deploy = array('0' => 't-',
                    '1' => 'xxxxxxxxxxxx',
                    '2' => 'TEST',
					'3' => '/datos/www/icuservices/Logs/'.$hostname.'/',
                    );
    $instance = 'xxxxxxxxxxx';
    $passwd = 'xxxxxxxxxx';
}

//Configuración para PRODUCCIÓN
else{
    $deploy = array('0' => '',
                    '1' => 'xxxxxxxxxxxxx',
                    '2' => 'PRODX',
					'3' => '/datos/www/icuservices/Logs/'.$hostname.'/',
                    );
    $instance = 'xxxxxxxxxxxx';
    $passwd = 'xxxxxxxxxx';
}

// =========================================
// DEFINICIONES DE SERVICIOS WEB
// =========================================
define('DIRBASE',__DIR__);
define('SAVE_LOGS',FALSE);
define('DEBUG', FALSE);

// =========================================
// CERTIFICADOS
// =========================================
define("cifin_keys_pk", "../keys/".$deploy[2]."/xxxxx.key");
define("cifin_keys_pk_passphrase", "");
define("cifin_keys_cert", "../keys/".$deploy[2]."/xxxxx.crt");

// =========================================
// DEFINICIONES CONEXION MYSQL
// =========================================
$user = 'usrInventarioIDC';
$database = 'InventarioIDC';

define("USER", $user);
define("PASSD", $passwd);
define("INSTANCE", $instance);
define("BD", $database);

// =========================================
// DEFINICIONES DE ERRORES
// =========================================

$codigoErrores = array(
    '01' => 'Problemas al conectarse a la Instancia o Base de datos...',
    '02' => 'No se encontraron datos....',
    '03' => 'Parametros incompletos....',
    '04' => 'JSON invalido....',
    '05' => 'Error al contactar al Servicio OficinaVirtual...',
    '06' => 'Error: el código no es correcto...',
    '07' => 'No tiene permisos para utilizar este servicio con la IP ['.$_SERVER['HTTP_X_FORWARDED_FOR'].']...',
    '10' => 'PartnerToken Inválido.... ',
    '11' => 'No se afectaron filas',
);
