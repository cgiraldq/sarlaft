<?php
/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */
// Funcion Dummy
$app->post("/Create_BDApp","Create_BDApp");
$app->post("/Create_BDAlmacenamiento","Create_BDAlmacenamiento");
$app->post("/Create_ServidorApp","Create_ServidorApp");
$app->post("/Create_ServidorInstancia","Create_ServidorInstancia");
$app->post("/Create_ServidorVlan","Create_ServidorVlan");
$app->post("/Create_ServidorCluster","Create_ServidorCluster");
$app->post("/Create_AlmacenamientoServidor","Create_AlmacenamientoServidor");
$app->post("/Create_FamiliaServicio","Create_FamiliaServicio");
$app->post("/Create_MotorApp","Create_MotorApp");
$app->post("/Create_MotorBD","Create_MotorBD");
$app->post("/Create_Servicio","Create_Servicio");
$app->post("/Create_TipoApp","Create_TipoApp");
$app->post("/Create_Almacenamiento","Create_Almacenamiento");
$app->post("/Create_Framework","Create_Framework");
$app->post("/Create_Instancia","Create_Instancia");
$app->post("/Create_Aplicacion","Create_Aplicacion");
$app->post("/Create_ClusterVirtualizacion","Create_ClusterVirtualizacion");

/**
 *
 * Función que llama a la consulta para obtener los nombres y IDs de los Framework
 */
 
function Create_BDApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_BDApp($params); 
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
//Función que llama a la consulta BD_Almacenamiento en el modelo
function Create_BDAlmacenamiento() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_BDAlmacenamiento($params); 
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
//Función que llama a la consulta Servidor_App en el modelo
function Create_ServidorApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_ServidorApp($params); 
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
//Función que llama a la consulta Servidor_Instancia en el modelo
function Create_ServidorInstancia() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_ServidorInstancia($params); 
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
//Función que llama a la consulta Servidor_Vlan en el modelo

function Create_ServidorVlan() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_ServidorVlan($params); 
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
//Función que llama a la consulta Servidor_Cluster en el modelo

function Create_ServidorCluster() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_ServidorCluster($params); 
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
//Función que llama a la consulta Almacenamiento_Servidor en el modelo
function Create_AlmacenamientoServidor() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_AlmacenamientoServidor($params); 
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
//Función que llama a la creación Familia_Servicio en el modelo
function Create_FamiliaServicio() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_FamiliaServicio($params); 
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
//Función que llama a la creación Motor_App en el modelo
function Create_MotorApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_MotorApp($params); 
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
//Función que llama a la creación Motor_BD en el modelo
function Create_MotorBD() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_MotorBD($params); 
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
//Función que llama a la creación Servicio en el modelo
function Create_Servicio() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_Servicio($params); 
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
//Función que llama a la creación Tipo_App en el modelo
function Create_TipoApp() {
	 
	 try{ 
		
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_TipoApp($params); 
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
//Función que llama a la creación Almacenamiento en el modelo
function Create_Almacenamiento() {
	 try{ 
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_Almacenamiento($params); 
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

//Función que llama a la creación Framework en el modelo
function Create_Framework() {
	 try{ 
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_Framework($params); 
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
//Función que llama a la creación Instancia en el modelo
function Create_Instancia() {
	 try{ 
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_Instancia($params); 
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
//Función que llama a la creación Aplicacion en el modelo
function Create_Aplicacion() {
	 try{ 
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_Aplicacion($params); 
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
//Función que llama a la creación Cluster_Virtualizacion en el modelo
function Create_ClusterVirtualizacion() {
	 try{ 
		$startTime  = time();
		include_once('../models/AddInventarioIDCModel.php'); 
        $objAddInventarioIDCModel = new AddInventarioIDCModel();
		$params = (string)file_get_contents("php://input");
		$respuesta['response']	= $objAddInventarioIDCModel->Create_ClusterVirtualizacion($params); 
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