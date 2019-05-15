<?php

/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */
//Esta linea hubo que ponerla porque sino el muy hp dec�a "Slim: Class not found" 
//Referencia: http://help.slimframework.com/discussions/problems/2446-class-slim-not-found 

use Slim\Slim;

require_once('Slim/Slim.php');
require_once('../include/config.php');

\Slim\Slim::registerAutoloader();
$app = new Slim();
$app->response->headers->set('Content-Type', 'application/json');

//Error Handler
$app->error(function (Exception $e) use ($app) {
    echo json_encode($e);
});

//Not Found Handler
$app->notFound(function () use ($app) {
    echo json_encode("notFound");
});

// =========================================
// Incluimos las funciones
// =========================================
require_once('functions/InventarioIDC.php');
require_once('functions/AddInventarioIDC.php');
require_once('functions/UpdateInventarioIDC.php');
require_once('functions/DeleteInventarioIDC.php');
// corremos la aplicacion
$app->run();
?>
