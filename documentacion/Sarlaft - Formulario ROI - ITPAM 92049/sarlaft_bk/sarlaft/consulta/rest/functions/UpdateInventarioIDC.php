<?php
/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */

$app->post("/Update_Framework","Update_Framework");
$app->post("/Update_ClusterVirtualizacion","Update_ClusterVirtualizacion");
$app->post("/Update_MotorApp","Update_MotorApp");
$app->post("/Update_MotorBD","Update_MotorBD");
$app->post("/Update_TipoApp","Update_TipoApp");
$app->post("/Update_Servicio","Update_Servicio");
$app->post("/Update_Almacenamiento","Update_Almacenamiento");
$app->post("/Update_Instancia","Update_Instancia");
$app->post("/Update_Aplicacion","Update_Aplicacion");
$app->post("/Update_FamiliaServicio","Update_FamiliaServicio");
$app->post("/Update_AlmacenamientoBD","Update_AlmacenamientoBD");
$app->post("/Update_AlmacenamientoServidor","Update_AlmacenamientoServidor");
$app->post("/Update_ServidorApp","Update_ServidorApp");
$app->post("/Update_ServidorCluster","Update_ServidorCluster");
$app->post("/Update_ServidorInstancia","Update_ServidorInstancia");
$app->post("/Update_ServidorVlan","Update_ServidorVlan");
$app->post("/Update_BDApp","Update_BDApp");

/**
 *
 * Función que llama a la consulta para actualizar un registro de la tabla Framework
 */
 
function Update_Framework() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_Framework($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Cluster_Virtualizacion
function Update_ClusterVirtualizacion() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_ClusterVirtualizacion($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Motor_App
function Update_MotorApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_MotorApp($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Motor_BD
function Update_MotorBD() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_MotorBD($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Tipo_App
function Update_TipoApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_TipoApp($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Servicio
function Update_Servicio() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_Servicio($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Almacenamiento
function Update_Almacenamiento() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_Almacenamiento($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Instancia
function Update_Instancia() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_Instancia($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Aplicacion
function Update_Aplicacion() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_Aplicacion($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Aplicacion
function Update_FamiliaServicio() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_FamiliaServicio($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Almacenamiento_BD
function Update_AlmacenamientoBD() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_AlmacenamientoBD($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla BD_App
function Update_BDApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_BDApp($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Almacenamiento_Servidor
function Update_AlmacenamientoServidor() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_AlmacenamientoServidor($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Servidor_App
function Update_ServidorApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_ServidorApp($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Servidor_Cluster
function Update_ServidorCluster() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_ServidorCluster($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Servidor_Instancia
function Update_ServidorInstancia() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_ServidorInstancia($params); 
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
//Función que llama a la consulta para actualizar un registro de la tabla Servidor_Vlan
function Update_ServidorVlan() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/UpdateInventarioIDCModel.php'); 
        $objUpdateInventarioIDCModel = new UpdateInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objUpdateInventarioIDCModel->Update_ServidorVlan($params); 
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