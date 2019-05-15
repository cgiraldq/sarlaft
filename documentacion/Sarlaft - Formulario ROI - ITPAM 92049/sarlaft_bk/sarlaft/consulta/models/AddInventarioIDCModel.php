<?php

include_once(__DIR__ . '/../include/config.php');

/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */
class AddInventarioIDCModel {

    protected $bd;
    public $method = null;

    function __construct() {
        // spl_autoload_register('self::autoloadSwichPagos');
    }

    /**
     * Conecta con la BD MSSQL
     */
    protected function conectarSQLServer() {
        global $codigoErrores;
        require_once(DIRBASE . '/../classes/Bd.class.php');
        $this->bd = Bd::singleton();
        $this->bd->type = 'SQLServer';

        $rowRecordSet = array();
        try {
            $this->bd->conectar();
            if (!$this->bd->connect) {
                throw new Exception('1');
            } else {
                return true;
            }
            $this->bd->cerrarConexion();
            return false;
        } catch (Exception $ex) {
            return array('error' => $codigoErrores[$ex->getMessage()]);
        }
    }
	    /**
     * Esta acción retorna framework y su ID 
     * @global type $params
     * @return type
     * @throws Exception
     */

    public function Create_BDApp($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
            $sql = "INSERT INTO [dbo].[tbl2_bd_app]([id_bd],[id_aplicacion],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
					VALUES (".$params->bdID.",".$params->appID.",'".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }	
	//Función para crear registro en la tabla relacional Almacenamiento_BD
	 public function Create_BDAlmacenamiento($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_almacenamiento_bd] ([id_almacenamiento],[id_bd],[creadopor],[fechacreacion] ,[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES (".$params->almacenamientoID.",".$params->bdID.",'".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	
	//Función para crear registro en la tabla relacional Servidor_App
	 public function Create_ServidorApp($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_servidor_app] ([id_servidor],[id_aplicacion],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES(".$params->serverID.",".$params->appID.",'".$params->username."',getdate(),'',NULL,'S')";
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	
	//Función para crear registro en la tabla relacional Servidor_App
	public function Create_ServidorInstancia($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_servidor_instancia] ([id_servidor],[id_instancia],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
					VALUES (".$params->serverID.",".$params->instanciaID.",'".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	
	//Función para crear registro en la tabla relacional Servidor_Vlan
	public function Create_ServidorVlan($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_servidor_vlan]([id_servidor],[id_vlan],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES (".$params->serverID.",".$params->vlanID.",'".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	//Consulta para ingresar registro en la tabla Servidor_Cluster
	public function Create_ServidorCluster($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_servidor_cluster]([id_servidor],[id_cluster_virtualizacion],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES (".$params->serverID.",".$params->clusterID.",'".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	
	//Consulta para ingresar registro en la tabla Almacenamiento_Servidor
	public function Create_AlmacenamientoServidor($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_almacenamiento_servidor]([id_almacenamiento],[id_servidor],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES (".$params->almacenamientoID.",".$params->serverID.",'".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	
	//Consulta para ingresar registro en la tabla Almacenamiento_Servidor
	public function Create_FamiliaServicio($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_familia_servicio]([id_servicio],[id_servicio_padre] ,[creadopor] ,[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES (".$params->servicio1ID.",".$params->servicio2ID.",'".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }

	//Consulta para ingresar registro en la tabla Motor_App
	public function Create_MotorApp($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_motor_app] ([nombre] ,[numero_version] ,[fecha_lanzamiento],[licencia],[creadopor] ,[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->nombre."','".$params->numero_version."','".$params->fecha_lanzamiento."','".$params->licencia."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	
	//Consulta para ingresar registro en la tabla Motor_BD
	public function Create_MotorBD($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_motor_bd]([nombre],[numero_version],[fecha_lanzamiento],[fabricante],[clase],[licencia],[creadopor],[fechacreacion],[modificadopor] ,[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->nombre."','".$params->numero_version."','".$params->fecha_lanzamiento."','".$params->fabricante."','".$params->clase."','".$params->licencia."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	
	//Consulta para ingresar registro en la tabla Servicio
	public function Create_Servicio($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_servicio]([nombre],[responsable_tecnico],[responsable_funcional],[creadopor],[fechacreacion],[modificadopor] ,[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->nombre."','".$params->responsable_tecnico."','".$params->responsable_funcional."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	//Consulta para ingresar registro en la tabla Tipo_App
	public function Create_TipoApp($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_tipo_app]([tipo_aplicacion],[capa],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->tipo_aplicacion."','".$params->capa."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	//Consulta para ingresar registro en la tabla Almacenamiento
	public function Create_Almacenamiento($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_almacenamiento]([ruta],[tipo_datos],[size],[caja_almacenamiento],[fabricante],[nivel_almacenamiento],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->ruta."','".$params->tipo_datos."','".$params->size."','".$params->caja_almacenamiento."','".$params->fabricante."','".$params->nivel_almacenamiento."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	//Consulta para ingresar registro en la tabla Framework
	public function Create_Framework($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_framework]([nombre],[numero_version],[fecha_lanzamiento],[licencia],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->nombre."','".$params->numero_version."','".$params->fecha_lanzamiento."','".$params->licencia."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	//Consulta para ingresar registro en la tabla Instancia
	public function Create_Instancia($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_instancia]([nombre],[descripcion],[direccion_ip],[puerto],[id_motor_bd],[is_cluster],[memoria_min_MB],[memoria_max_MB],[ambiente],[fecha_instalacion],[tipo_instancia],[responsable_tecnico],[responsable_funcional],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->nombre."','".$params->descripcion."','".$params->direccion_ip."','".$params->puerto."','".$params->id_motor_bd."','".$params->is_cluster."','".$params->memoria_min_MB."','".$params->memoria_max_MB."','".$params->ambiente."','".$params->fecha_instalacion."','".$params->tipo_instancia."','".$params->responsable_tecnico."','".$params->responsable_funcional."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	//Consulta para ingresar registro en la tabla Aplicacion
	public function Create_Aplicacion($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_aplicacion]([id_servicio],[nombre],[id_tipo_app],[id_motor_app],[id_framework],[numero_version],[licencia],[fecha_lanzamiento],[fabricante],[link_acceso],[arquitectura_objetivo],[CertificadoSSL],[Documentado],[ip_publica],[criticidad],[fecha_instalacion],[OC_Instalacion],[tipo_plataforma],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->id_servicio."','".$params->nombre."','".$params->id_tipo_app."','".$params->id_motor_app."','".$params->id_framework."','".$params->numero_version."','".$params->licencia."','".$params->fecha_lanzamiento."','".$params->fabricante."','".$params->link_acceso."','".$params->arquitectura_objetivo."','".$params->CertificadoSSL."','".$params->Documentado."','".$params->ip_publica."','".$params->criticidad."','".$params->fecha_instalacion."','".$params->OC_Instalacion."','".$params->tipo_plataforma."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
	//Consulta para ingresar registro en la tabla Cluster_Virtualizacion
	public function Create_ClusterVirtualizacion($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            $sql = "INSERT INTO [dbo].[tbl2_cluster_virtualizacion]([nombre],[hypervisor],[ip_administracion],[creadopor],[fechacreacion],[modificadopor],[fechamodificacion],[Modificado_IDC])
			VALUES ('".$params->nombre."','".$params->hypervisor."','".$params->ip_administracion."','".$params->username."',getdate(),'',NULL,'S')";
			
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbAffectedRows()>0){
                    $response['num_of_rows'] = $this->bd->dbAffectedRows();
                }
                else{
                    throw new Exception('11');
                }
                
            }
            
            $this->bd->cerrarConexion();
            return $response;
        } catch (Exception $ex) { 
            $errorResponse = null;
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                $errorResponse = array('debug' => $response);
            }
            if($this->bd->msgError!=''){
                $errorResponse = array('error' => array('Message' => $this->bd->msgError,
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            }
            elseif (array_key_exists($ex->getMessage(), $codigoErrores)) {
                $errorResponse = array('error' => array('Message' => $codigoErrores[$ex->getMessage()],
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                ));
            } else {
                $errorResponse = json_encode(array('error' => array('Message' => $ex->getMessage(),
                        'Function' => __FUNCTION__,
                        'Line' => $ex->getLine(),
                        'File' => 'fakePath../' . str_replace('.php', '', basename($ex->getFile())),
                        'Date' => date('Y-m-d h:i:s'),
                )));
            }
            if(SAVE_LOGS){
                if (is_array($errorResponse)) {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, json_encode($errorResponse));
                } else {
                    self::registerLog('wsSwitchPagos_' . __FUNCTION__, $errorResponse);
                }
            }
            return $errorResponse;
        } catch (SoapFault $ex) {
            if (DEBUG) {
                $response = array_merge($response, $this->debug($ex, $params, null));
                return array('debug' => $response);
            }
            if (array_key_exists($ex->getMessage(), $codigoErrores)) {
                return array('error' => $codigoErrores[$ex->getMessage()]);
            }
            return array('error' => $ex->getMessage());
        }
    }
    public function allowedIP($allowed_ips) {

        $ip_address = "/" . $_SERVER['HTTP_X_FORWARDED_FOR'] . "/i";
        if (preg_match($ip_address, $allowed_ips)) {
            return true;
        } else {
            return false;
        }
    }
	
    /**
     * funcion para consultar web services
     * @param string $url
     * @param string $wsMethod
     * @param array $params
     * @param array $options
     * @param boolean $cert
     */
    function consumeWebService($url, $wsMethod, $params = NULL, $options = array(), $setLocation = null, $cert = false) {
        try {
            include_once('../../classes/Webservice.class.php');
            $wsResponse = ARRAY();
            $webservice->cliente = '';
            $webservice = Webservice::singleton(); //se crea un objeto de la clase webservice

            if ($cert) {
                $webservice->key_file = cifin_keys_pk;
                $webservice->passphrase = cifin_keys_pk_passphrase;
                $webservice->cert_file = cifin_keys_cert;
            }
            if (DEBUG) {
                if (count($options)) {
                    $options = array_merge($options, array("trace" => 1,
                        "exceptions" => true,
                    ));
                } else {
                    $options = array("trace" => 1,
                        "exceptions" => true,
                    );
                }
            }
            $webservice->conectarCliente($url, $options, $setLocation); // Se le da la URL del WSDL            

            if (is_object($webservice->cliente)) {
                $objService = array($webservice->cliente, $wsMethod);
                if ($params != NULL) {
                    $wsResponse['RESPONSE'] = call_user_func_array($objService, $params);
                } else {
                    $wsResponse['RESPONSE'] = call_user_func($objService);
                }
            } else {
                $objService = array($webservice);
            }
            if (DEBUG) {
                $wsResponse = array_merge($wsResponse, $this->debug($objService[0], $params));
            }
            return $wsResponse;
        } catch (SoapFault $e) {
            if (DEBUG) {
                $wsResponse = array_merge($wsResponse, $this->debug($objService[0], $params, $e));
            }
            return $wsResponse;
        } catch (Exception $ex) {
            if (DEBUG) {
                $wsResponse = array_merge($wsResponse, $this->debug($objService[0], $params, $ex));
            }
            return $wsResponse;
        }
    }

    public function timeElapse($secs) {

        $bit = array(
            ' year' => $secs / 31556926 % 12,
            ' week' => $secs / 604800 % 52,
            ' day' => $secs / 86400 % 7,
            ' hour' => $secs / 3600 % 24,
            ' minute' => $secs / 60 % 60,
            ' second' => $secs % 60,
            ' milisecond' => round(microtime($secs) * 1000),
        );

        foreach ($bit as $k => $v) {
            if ($v > 1)
                $ret[] = $v . $k . 's';
            if ($v == 1)
                $ret[] = $v . $k;
            if ($v < 1)
                $ret[] = $v . $k . 's';
        }
        array_splice($ret, count($ret) - 1, 0, 'and');
        $ret[] = 'ago.';

        return join(' ', $ret);
    }

    /**
     * 
     * @global type $switchPath
     */
    private function autoloadSwichPagos() {

        if (!isset($_SESSION['loaded_classes']))
            session_start();
        global $switchPath;
        date_default_timezone_set('America/Bogota');
        $_SESSION['loaded_classes'] = array();
        foreach ($switchPath as $key => $value) {
            if ($key == 'general' || $key == $this->method) {
                foreach ($value as $strPath) {
                    $strFile = $strPath . '.php';

                    if (!in_array($strFile, $_SESSION['loaded_classes'])) {
                        $_SESSION['loaded_classes'][] = $strFile;
                        if (file_exists($strFile)) {
                            require_once $strFile;
                        }
                    }
                }
            }
        }
    }

    /**
     * 
     * @param type $soapClient
     * @param type $params
     * @param type $exception
     * @return string
     */
    function debug($soapClient, $params, $exception = null) {
        global $codigoErrores;
        if (is_object($soapClient)) {
            $arrayData['DEBUG']['key_file'] = $soapClient->key_file;
            $arrayData['DEBUG']['cert_file'] = $soapClient->cert_file;
            $arrayData['DEBUG']['passphrase'] = $soapClient->passphrase;
            $arrayData['DEBUG']['login'] = $soapClient->_login;
            $arrayData['DEBUG']['password'] = $soapClient->_password;
            $arrayData['DEBUG']['parameters'] = $params;
            if (count($soapClient->__getFunctions())) {
                $arrayData['DEBUG']['functions'] = $soapClient->__getFunctions();
                $arrayData['DEBUG']['doRequest'] = (string) $soapClient->__getLastRequest();
                $arrayData['DEBUG']['doResponse'] = (string) $soapClient->__getLastResponse();
            } else {
                $arrayData['DEBUG']['functions'] = (string) $soapClient->soap_functions;
                $arrayData['DEBUG']['doRequest'] = (string) $soapClient->soap_sent;
                $arrayData['DEBUG']['doResponse'] = $soapClient->soap_response;
            }
        }
        if (is_object($exception)) {
            $arrayData['EXCEPTION_MSG'][] = $codigoErrores[$exception->getMessage()];
            $arrayData['EXCEPTION_TAS'][] = $exception->getTraceAsString();
        }
        if (is_object($soapClient->exception)) {
            $arrayData['EXCEPTION_MSG'][] = $codigoErrores[$soapClient->exception->getMessage()];
            $arrayData['EXCEPTION_TAS'][] = $soapClient->exception->getTraceAsString();
        }

        return $arrayData;
    }

    function registerLog($file = '', $log = '') {
        global $deploy;
        $path = $deploy[3] . date('Y-m-d') . '_' . $file . '.txt';
        if (!file_exists($path)) {
            touch($path);
            $handle = fopen($path, 'w');
            $str = $log;
        } else {
            $str = $log;
            $handle = fopen($path, 'a');
        }
        if (fwrite($handle, $str) === false) {
            throw new Exception("!w_log");
        }
        fclose($handle);
    }
	
}
