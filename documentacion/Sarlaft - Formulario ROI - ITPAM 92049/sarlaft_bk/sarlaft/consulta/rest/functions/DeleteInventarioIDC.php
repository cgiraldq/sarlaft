<?php
/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */

$app->post("/Delete_Framework","Delete_Framework");
$app->post("/Delete_ClusterVirtualizacion","Delete_ClusterVirtualizacion");
$app->post("/Delete_MotorApp","Delete_MotorApp");
$app->post("/Delete_MotorBD","Delete_MotorBD");
$app->post("/Delete_TipoApp","Delete_TipoApp");
$app->post("/Delete_Servicio","Delete_Servicio");
$app->post("/Delete_Almacenamiento","Delete_Almacenamiento");
$app->post("/Delete_Instancia","Delete_Instancia");
$app->post("/Delete_Aplicacion","Delete_Aplicacion");
$app->post("/Delete_FamiliaServicio","Delete_FamiliaServicio");
$app->post("/Delete_AlmacenamientoBD","Delete_AlmacenamientoBD");
$app->post("/Delete_AlmacenamientoServidor","Delete_AlmacenamientoServidor");
$app->post("/Delete_ServidorApp","Delete_ServidorApp");
$app->post("/Delete_ServidorCluster","Delete_ServidorCluster");
$app->post("/Delete_ServidorInstancia","Delete_ServidorInstancia");
$app->post("/Delete_ServidorVlan","Delete_ServidorVlan");
$app->post("/Delete_BDApp","Delete_BDApp");

/**
 *
 * Función que llama a la consulta para borrar un registro de la tabla Framework
 */
 
function Delete_Framework() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_Framework($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Cluster_Virtualizacion
function Delete_ClusterVirtualizacion() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_ClusterVirtualizacion($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Motor_App
function Delete_MotorApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_MotorApp($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Motor_BD
function Delete_MotorBD() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_MotorBD($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Motor_BD
function Delete_TipoApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_TipoApp($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Servicio
function Delete_Servicio() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_Servicio($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Almacenamiento
function Delete_Almacenamiento() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_Almacenamiento($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Instancia
function Delete_Instancia() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_Instancia($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Aplicacion
function Delete_Aplicacion() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_Aplicacion($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Familia_Servicio
function Delete_FamiliaServicio() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_FamiliaServicio($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Almacenamiento_BD
function Delete_AlmacenamientoBD() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_AlmacenamientoBD($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Almacenamiento_Servidor
function Delete_AlmacenamientoServidor() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_AlmacenamientoServidor($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Servidor_App
function Delete_ServidorApp() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_ServidorApp($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Servidor_Cluster
function Delete_ServidorCluster() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_ServidorCluster($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Servidor_Instancia
function Delete_ServidorInstancia() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_ServidorInstancia($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla Servidor_Vlan
function Delete_ServidorVlan() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_ServidorVlan($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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
//Función que llama a la consulta para borrar un registro de la tabla BD_App
function Delete_BDApp() {
	 try{ 
		$startTime  = time();
		include_once('../models/DeleteInventarioIDCModel.php'); 
        $objDeleteInventarioIDCModel = new DeleteInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objDeleteInventarioIDCModel->Delete_BDApp($params); 
		//$respuesta['exceTime'] = $objAddInventarioIDCModel->timeElapse(time()-$startTime);
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