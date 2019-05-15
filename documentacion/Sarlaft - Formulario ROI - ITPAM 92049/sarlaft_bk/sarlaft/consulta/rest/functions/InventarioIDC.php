<?php
/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */
// Funcion Dummy
$app->post("/AppService","AppService");
$app->post("/ServerService","ServerService");
$app->post("/AppFramework","AppFramework");
$app->post("/ServerDB","ServerDB");
$app->post("/AppServiceDB","AppServiceDB");
$app->post("/ClusterServer","ClusterServer");
$app->post("/InstanceDB","InstanceDB");
$app->post("/InstanceMotorDB","InstanceMotorDB");
$app->post("/ServerInstance","ServerInstance");
$app->post("/getFramework","getFramework");
$app->post("/getService","getService");
$app->post("/getMotorDB","getMotorDB");
$app->post("/getInstance","getInstance");
$app->post("/getCluster_Virtualizacion","getCluster_Virtualizacion");
$app->post("/getDB","getDB");
$app->post("/getApp","getApp");
$app->post("/getAlmacenamiento","getAlmacenamiento");
$app->post("/getServer","getServer");
$app->post("/getVlan","getVlan");
$app->post("/getMotorApp","getMotorApp");
$app->post("/getTipoApp","getTipoApp");
$app->post("/getFamiliaServicio","getFamiliaServicio");
$app->post("/getAlmacenamientoBD","getAlmacenamientoBD");
$app->post("/getAlmacenamientoServidor","getAlmacenamientoServidor");
$app->post("/getBDApp","getBDApp");
$app->post("/getServidorApp","getServidorApp");
$app->post("/getServidorCluster","getServidorCluster");
$app->post("/getServidorInstancia","getServidorInstancia");
$app->post("/getServidorVlan","getServidorVlan");
$app->post("/getStrDB","getStrDB");
$app->post("/getStrServer","getStrServer");
$app->post("/getStrApp","getStrApp");
$app->post("/getStrInstance","getStrInstance");
$app->post("/getStrService","getStrService");
$app->post("/getStrAlmacenamiento","getStrAlmacenamiento");
$app->post("/getStrCluster_Virtualizacion","getStrCluster_Virtualizacion");
/**
 *
 * Función que llama a la consulta para obtener los nombres y IDs de los Framework
 */
 
function getFramework() {
	 
	 try{ 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getFramework($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
/**
 *
 * Función que llama a la consulta para obtener los nombres y IDs de los Servicios
 */

function getService() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getService($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}


/**
 *
 * Función que llama a la consulta para obtener los nombres y IDs de los Motores de base de datos
 */

function getMotorDB() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getMotorDB($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
/**
 *
 * Función que llama a la consulta para obtener los nombres y IDs de los Motores de bases de datos
 */

function getInstance() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getInstance($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}

/**
 *
 * Función que llama a la consulta para obtener los nombres y IDs de los Motores de bases de datos
 */

function getCluster_Virtualizacion() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getCluster_Virtualizacion($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}

/**
 *
 * Función que llama a la consulta para obtener los nombres y IDs de las bases de datos
 */

function getDB() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getDB($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}

//Para llamado a la consulta para traer todas las aplicaciones

function getApp() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getApp($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}

//Para llamado a la consulta para traer todas los almacenamientos

function getAlmacenamiento() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getAlmacenamiento($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todas los servidores

function getServer() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getServer($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}

//Para llamado a la consulta para traer todas las vlan
function getVlan() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getVlan($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los motores de aplicacion
function getMotorApp() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getMotorApp($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los tipo de aplicacion
function getTipoApp() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getTipoApp($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los tipo de FamiliaServicio
function getFamiliaServicio() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getFamiliaServicio($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Almacenamiento_BD
function getAlmacenamientoBD() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getAlmacenamientoBD($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Almacenamiento_Servidor
function getAlmacenamientoServidor() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getAlmacenamientoServidor($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de BD_App
function getBDApp() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getBDApp($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Servidor_App
function getServidorApp() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getServidorApp($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Servidor_Cluster
function getServidorCluster() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getServidorCluster($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Servidor_Instancia
function getServidorInstancia() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getServidorInstancia($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Servidor_Vlan
function getServidorVlan() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getServidorVlan($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Base de datos que contengan x subString
function getStrDB() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getStrDB($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Servidores que contengan x subString
function getStrServer() {
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getStrServer($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Aplicaciones que contengan x subString
function getStrApp() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getStrApp($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Instancias que contengan x subString
function getStrInstance() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getStrInstance($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Servicios que contengan x subString
function getStrAlmacenamiento() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getStrAlmacenamiento($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Almacenamiento que contengan x subString
function getStrService() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getStrService($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Para llamado a la consulta para traer todos los registros de Cluster de Virtualizacion que contengan x subString
function getStrCluster_Virtualizacion() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->getStrCluster_Virtualizacion($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
/**
 *
 * return string
 */
 
function AppService() {
	 
	 try{ 
	 
		$startTime  = time();
       include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->AppService($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
 function AppFramework() {
    try{ 
		$startTime  = time();
       include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->AppFramework($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }    
}
function ServerService() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		
		$respuesta['response']	= $objInventarioIDCModel->ServerService($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
//Llama la consulta Almacenamiento-Servidor-DB
function ServerDB() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		
		$respuesta['response']	= $objInventarioIDCModel->ServerDB($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}

function AppServiceDB() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		
		$respuesta['response']	= $objInventarioIDCModel->AppServiceDB($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
function ClusterServer() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		
		$respuesta['response']	= $objInventarioIDCModel->ClusterServer($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
function InstanceDB() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		
		$respuesta['response']	= $objInventarioIDCModel->InstanceDB($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}

function InstanceMotorDB() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objInventarioIDCModel->InstanceMotorDB($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}
function ServerInstance() {
	 
	 try{ 
	 
		$startTime  = time();
		include_once('../models/InventarioIDCModel.php'); 
        $objInventarioIDCModel = new InventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		
		$respuesta['response']	= $objInventarioIDCModel->ServerInstance($params); 
		if(is_array($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		if(is_object($respuesta)){
		 echo json_encode($respuesta);
                 die;
		}
		else{
		 echo $respuesta;
		}       
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }  
}