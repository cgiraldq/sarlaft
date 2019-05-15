<?php

include_once(__DIR__ . '/../include/config.php');

/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */
class InventarioIDCModel {

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

    public function getFramework($params = null) {
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
            
			
            $sql = "SELECT  b.id_framework, b.nombre Framework, b.numero_version,fecha_lanzamiento,licencia  FROM [InventarioIDC].[dbo].[tbl2_framework] B";
				
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
		    /**
     * Esta acción retorna Servicio y su ID 
     * @global type $params
     * @return type
     * @throws Exception
     */

    public function getService($params = null) {
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
            
            $sql = "SELECT b.id_servicio,  b.nombre Servicio, b.responsable_tecnico, b.responsable_funcional FROM [InventarioIDC].[dbo].[tbl2_servicio] B";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
			    /**
     * Esta acción retorna Motor DB y su ID 
     * @global type $params
     * @return type
     * @throws Exception
     */
	//Obtener datos del motor de base de datos
    public function getMotorDB($params = null) {
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
            
            $sql = "SELECT id_motor_bd, nombre MotorDB,numero_version, fecha_lanzamiento,fabricante,clase,licencia FROM [InventarioIDC].[dbo].[tbl2_motor_bd]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
	/*
	//Obtener id y nombre de la Instancia
	*/
	public function getInstance($params = null) {
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
            
            $sql = "SELECT b.id_instancia, b.nombre Instancia, b.descripcion, b.direccion_ip, b.puerto, b.id_motor_bd,b.is_cluster id_cluster,b.memoria_min_MB,b.memoria_max_MB,b.ambiente, b.fecha_instalacion, b.tipo_instancia,
			b.responsable_tecnico,b.responsable_funcional FROM [InventarioIDC].[dbo].[tbl2_instancia] B";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
	public function getCluster_Virtualizacion($params = null) {
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
            
            $sql = "SELECT  b.id_cluster_virtualizacion, b.nombre Cluster,b.hypervisor,b.ip_administracion FROM [InventarioIDC].[dbo].[tbl2_cluster_virtualizacion] B";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
	//Función para consultar los id y nombres de las Bases de datos
	public function getDB($params = null) {
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
            
            $sql = "SELECT id_bd,[nombre] Base_de_datos FROM [InventarioIDC].[dbo].[tbl2_basesdatos]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta nombre y ID de la aplicación
	public function getApp($params = null) {
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
            
            $sql = "SELECT  [id_aplicacion],[id_servicio],[nombre] Aplicacion,[own_resource_uuid],[id_tipo_app],[id_motor_app],[id_framework],[numero_version],
			[licencia],[fecha_lanzamiento],[fabricante],[link_acceso],[arquitectura_objetivo],[CertificadoSSL],[Documentado],[ip_publica],[criticidad],
			[fecha_instalacion], [OC_Instalacion],[tipo_plataforma] FROM [InventarioIDC].[dbo].[tbl2_aplicacion]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
	//Consulta para traer todos los registros de almacenamiento
	
	public function getAlmacenamiento($params = null) {
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
            
            $sql = "SELECT [id_almacenamiento],[ruta] Ruta,[tipo_datos],[size],[caja_almacenamiento],[fabricante],[nivel_almacenamiento] FROM [InventarioIDC].[dbo].[tbl2_almacenamiento]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer todos los registros de los servidores
	public function getServer($params = null) {
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
            
            $sql = "SELECT [id_servidor] ,[nombre] Nombre FROM [InventarioIDC].[dbo].[tbl2_servidor]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
	//Consulta para traer ID, Nombre y Número de las VLAN
	
	public function getVlan($params = null) {
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
            
            $sql = "SELECT [id_vlan],[numero_vlan] Numero,[nombre_vlan] Nombre FROM [InventarioIDC].[dbo].[tbl2_vlan]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer datos de la tabla Motor_App
	public function getMotorApp($params = null) {
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
            
            $sql = "SELECT [id_motor_app],[nombre],[numero_version],[fecha_lanzamiento],[licencia] FROM [InventarioIDC].[dbo].[tbl2_motor_app]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer registros de la tabla Tipo_App
	public function getTipoApp($params = null) {
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
            
            $sql = "SELECT [id_tipo_app],[tipo_aplicacion],[capa] FROM [InventarioIDC].[dbo].[tbl2_tipo_app]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer registros de la tabla Familia_Servicio
	public function getFamiliaServicio($params = null) {
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
            
            $sql = "SELECT [id_familia_servicio],[id_servicio],[id_servicio_padre] FROM [InventarioIDC].[dbo].[tbl2_familia_servicio]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
	//Consulta para traer registros de la tabla Almacenamiento_BD
	public function getAlmacenamientoBD($params = null) {
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
            
            $sql = "SELECT [id_bd_alm] ,[id_almacenamiento],[id_bd]FROM [InventarioIDC].[dbo].[tbl2_almacenamiento_bd]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer registros de la tabla Almacenamiento_Servidor
	public function getAlmacenamientoServidor($params = null) {
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
            
            $sql = "SELECT [id_server_alm],[id_almacenamiento],[id_servidor]FROM [InventarioIDC].[dbo].[tbl2_almacenamiento_servidor]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer registros de la tabla BD_App
	public function getBDApp($params = null) {
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
            
            $sql = "SELECT [id_bd_app],[id_bd],[id_aplicacion] FROM [InventarioIDC].[dbo].[tbl2_bd_app]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer registros de la tabla Servidor_App
	public function getServidorApp($params = null) {
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
            
            $sql = "SELECT [id_servidor_app],[id_servidor],[id_aplicacion] FROM [InventarioIDC].[dbo].[tbl2_servidor_app]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer registros de la tabla Servidor_Cluster
	public function getServidorCluster($params = null) {
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
            
            $sql = "SELECT [id_servidor_cluster],[id_servidor],[id_cluster_virtualizacion] FROM [InventarioIDC].[dbo].[tbl2_servidor_cluster]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer registros de la tabla Servidor_Instancia
	public function getServidorInstancia($params = null) {
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
            
            $sql = "SELECT [id_servidor_instancia],[id_servidor],[id_instancia] FROM [InventarioIDC].[dbo].[tbl2_servidor_instancia]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer registros de la tabla Servidor_Vlan
	public function getServidorVlan($params = null) {
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
            
            $sql = "SELECT [id_servidor_vlan],[id_servidor],[id_vlan] FROM [InventarioIDC].[dbo].[tbl2_servidor_vlan]";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Función para consultar los id y nombres de las Bases de datos que tengan un subString en su nombre
	public function getStrDB($params = null) {
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
            
            $sql = "SELECT id_bd,[nombre] Base_de_datos FROM [InventarioIDC].[dbo].[tbl2_basesdatos] WHERE nombre LIKE '" .$params->nombre. "%'";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Función para consultar los id y nombres de los servidores que tengan un subString en su nombre
	public function getStrServer($params = null) {
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
            
            $sql = "SELECT [id_servidor] ,[nombre] Nombre FROM [InventarioIDC].[dbo].[tbl2_servidor] WHERE nombre LIKE '" .$params->nombre. "%'";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Función para consultar los id y nombres de lss Aplicaciones que tengan un subString en su nombre
	public function getStrApp($params = null) {
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
            
            $sql = "SELECT  [id_aplicacion],[id_servicio],[nombre] Aplicacion,[own_resource_uuid],[id_tipo_app],[id_motor_app],[id_framework],[numero_version],
			[licencia],[fecha_lanzamiento],[fabricante],[link_acceso],[arquitectura_objetivo],[CertificadoSSL],[Documentado],[ip_publica],[criticidad],
			[fecha_instalacion], [OC_Instalacion],[tipo_plataforma] FROM [InventarioIDC].[dbo].[tbl2_aplicacion] WHERE nombre LIKE '" .$params->nombre. "%'";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer instancias que tengan en su nombre x cadena de caracteres
	public function getStrInstance($params = null) {
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
            
            $sql = "SELECT b.id_instancia, b.nombre Instancia, b.descripcion, b.direccion_ip, b.puerto, b.id_motor_bd,b.is_cluster id_cluster,b.memoria_min_MB,b.memoria_max_MB,b.ambiente, b.fecha_instalacion, b.tipo_instancia,
			b.responsable_tecnico,b.responsable_funcional FROM [InventarioIDC].[dbo].[tbl2_instancia] B WHERE b.nombre LIKE '".$params->nombre."%'";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer instancias que tengan en su nombre x cadena de caracteres
	public function getStrService($params = null) {
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
            
            $sql = "SELECT b.id_servicio,  b.nombre Servicio, b.responsable_tecnico, b.responsable_funcional FROM [InventarioIDC].[dbo].[tbl2_servicio] B WHERE b.nombre LIKE '".$params->nombre."%'";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer Almacenamiento que tengan en su nombre x cadena de caracteres
	public function getStrAlmacenamiento($params = null) {
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
            
            $sql = "SELECT [id_almacenamiento],[ruta] Ruta,[tipo_datos],[size],[caja_almacenamiento],[fabricante],[nivel_almacenamiento] FROM [InventarioIDC].[dbo].[tbl2_almacenamiento] WHERE ruta LIKE '".$params->nombre."%'";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//Consulta para traer Cluster_Virtualizacion que tengan en su nombre x cadena de caracteres
	public function getStrCluster_Virtualizacion($params = null) {
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
            
            $sql = "SELECT  b.id_cluster_virtualizacion, b.nombre Cluster,b.hypervisor,b.ip_administracion FROM [InventarioIDC].[dbo].[tbl2_cluster_virtualizacion] B WHERE b.nombre LIKE '".$params->nombre."%'";
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
    /**
     * xxxxxxxxxxxxxxxxxxxxxxxxxx 
     * @global type $codigoErrores
     * @global type $ambiente
     * @param string $params
     * @return type
     * @throws Exception
     */

    public function AppFramework($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->AppFramework) || !array_key_exists('AppFramework', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
			if($flagPoolAppFramework){
				$sql = "SELECT a.nombre Aplicacion, b.nombre Framework, b.licencia 
                    FROM [InventarioIDC].[dbo].[tbl2_aplicacion] A,
                    [InventarioIDC].[dbo].[tbl2_framework] B
                    WHERE A.id_framework = B.id_framework AND B.id_framework IN (".$params->PoolAppFramework.")";
			}
			else{
				$sql = "SELECT a.nombre Aplicacion, b.nombre Framework, b.licencia 
                    FROM [InventarioIDC].[dbo].[tbl2_aplicacion] A,
                    [InventarioIDC].[dbo].[tbl2_framework] B
                    WHERE A.id_framework = B.id_framework AND B.id_framework = ".$params->AppFramework;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
    public function AppService($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->AppService) || !array_key_exists('AppService', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
			if($flagPoolAppFramework){
				$sql = "SELECT a.nombre, b.nombre Tipo_Servicio, c.nombre Tipo_Motor, d.nombre Framework, a.licencia, b.responsable_tecnico Responsable_Servicio, b.fechacreacion Fecha_Servicio
				FROM [InventarioIDC].[dbo].[tbl2_aplicacion] A,
				[InventarioIDC].[dbo].[tbl2_servicio] B,
				[InventarioIDC].[dbo].[tbl2_motor_app] C,
				[InventarioIDC].[dbo].[tbl2_framework] D
				WHERE a.id_servicio = b.id_servicio
				AND a.id_motor_app = c.id_motor_app
				AND a.id_framework = d.id_framework
				AND a.id_servicio IN (".$params->PoolAppFramework.")";
			}
			else{
				$sql = "SELECT a.nombre, b.nombre Tipo_Servicio, c.nombre Tipo_Motor, d.nombre Framework, a.licencia, b.responsable_tecnico Responsable_Servicio, b.fechacreacion Fecha_Servicio
				FROM [InventarioIDC].[dbo].[tbl2_aplicacion] A,
				[InventarioIDC].[dbo].[tbl2_servicio] B,
				[InventarioIDC].[dbo].[tbl2_motor_app] C,
				[InventarioIDC].[dbo].[tbl2_framework] D
				WHERE a.id_servicio = b.id_servicio
				AND a.id_motor_app = c.id_motor_app
				AND a.id_framework = d.id_framework
				AND a.id_servicio = ".$params->AppService;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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

	public function ServerService($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->ServerService) || !array_key_exists('ServerService', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            //Se debe cambiar consulta, la actual es solo para fines de pruebas de la aplicación.
			if($flagPoolAppFramework){
				 $sql = "SELECT a.nombre Servidor, a.serial Serial, a.ip_servicio Direccion_IP_Servicio, 
					   a.fabricante Fabricante, a.SO_Clase Sistema_Operativo, a.SO_edicion Edicion, a.OC_Instalacion, 
					   a.tipo_servidor Tipo_Servidor, a.responsable_tecnico, d.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_servidor] A,
					 [InventarioIDC].[dbo].[tbl2_servidor_app] B,
					 [InventarioIDC].[dbo].[tbl2_aplicacion] C,
					 [InventarioIDC].[dbo].[tbl2_servicio] D
				WHERE a.id_servidor = b.id_servidor
				  AND c.id_aplicacion = b.id_aplicacion   
				  AND c.id_servicio = d.id_servicio
				  AND d.id_servicio IN (".$params->PoolAppFramework.")";
			}
			else{
				 $sql = "SELECT a.nombre Servidor, a.serial Serial, a.ip_servicio Direccion_IP_Servicio,
					   a.fabricante Fabricante, a.SO_Clase Sistema_Operativo, a.SO_edicion Edicion, a.OC_Instalacion, 
					   a.tipo_servidor Tipo_Servidor, a.responsable_tecnico, d.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_servidor] A,
					 [InventarioIDC].[dbo].[tbl2_servidor_app] B,
					 [InventarioIDC].[dbo].[tbl2_aplicacion] C,
					 [InventarioIDC].[dbo].[tbl2_servicio] D
				WHERE a.id_servidor = b.id_servidor
				  AND c.id_aplicacion = b.id_aplicacion   
				  AND c.id_servicio = d.id_servicio
				  AND d.id_servicio = ".$params->ServerService;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	//COnsulta Almacenamiento-Servidor-DB
	public function ServerDB($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->ServerDB) || !array_key_exists('ServerDB', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
			if($flagPoolAppFramework){
				 $sql = "SELECT c.nombre BD_Servidor, a.size Tamano, a.fabricante, a.caja_almacenamiento, 
					   a.nivel_almacenamiento, a.tipo_datos, a.id_almacenamiento, e.nombre Aplicacion, f.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_almacenamiento] A,
					 [InventarioIDC].[dbo].[tbl2_almacenamiento_bd] B,
					 [InventarioIDC].[dbo].[tbl2_basesdatos] C,
					 [InventarioIDC].[dbo].[tbl2_bd_app] D,
					 [InventarioIDC].[dbo].[tbl2_aplicacion] E,
					 [InventarioIDC].[dbo].[tbl2_servicio] F 
				WHERE a.id_almacenamiento = b.id_almacenamiento
				  AND c.id_bd = b.id_bd
				  AND c.id_bd = d.id_bd
				  AND e.id_aplicacion = d.id_aplicacion
				  AND e.id_servicio = f.id_servicio
				  AND e.id_servicio IN (".$params->PoolAppFramework.") 
				  UNION ALL
				SELECT c.nombre BD_Servidor, a.size Tamano, a.fabricante, a.caja_almacenamiento, 
					   a.nivel_almacenamiento, a.tipo_datos, a.id_almacenamiento, e.nombre Aplicacion, f.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_almacenamiento] A,
					 [InventarioIDC].[dbo].[tbl2_almacenamiento_servidor] B,
					 [InventarioIDC].[dbo].[tbl2_servidor] C,
					 [InventarioIDC].[dbo].[tbl2_servidor_app] D,
					 [InventarioIDC].[dbo].[tbl2_aplicacion] E,
					 [InventarioIDC].[dbo].[tbl2_servicio] F
				WHERE a.id_almacenamiento = b.id_almacenamiento
				  AND c.id_servidor = b.id_servidor
				  AND c.id_servidor = d.id_servidor
				  AND e.id_aplicacion = d.id_aplicacion
				  AND e.id_servicio = f.id_servicio
				  AND e.id_servicio IN(".$params->PoolAppFramework.")";
			}
			else{
				 $sql = "SELECT c.nombre BD_Servidor, a.size Tamano, a.fabricante, a.caja_almacenamiento, 
					   a.nivel_almacenamiento, a.tipo_datos, a.id_almacenamiento, e.nombre Aplicacion, f.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_almacenamiento] A,
					 [InventarioIDC].[dbo].[tbl2_almacenamiento_bd] B,
					 [InventarioIDC].[dbo].[tbl2_basesdatos] C,
					 [InventarioIDC].[dbo].[tbl2_bd_app] D,
					 [InventarioIDC].[dbo].[tbl2_aplicacion] E,
					 [InventarioIDC].[dbo].[tbl2_servicio] F 
				WHERE a.id_almacenamiento = b.id_almacenamiento
				  AND c.id_bd = b.id_bd
				  AND c.id_bd = d.id_bd
				  AND e.id_aplicacion = d.id_aplicacion
				  AND e.id_servicio = f.id_servicio
				  AND e.id_servicio =".$params->ServerDB."
				  UNION ALL
				SELECT c.nombre BD_Servidor, a.size Tamano, a.fabricante, a.caja_almacenamiento, 
					   a.nivel_almacenamiento, a.tipo_datos, a.id_almacenamiento, e.nombre Aplicacion, f.nombre Servicio
				FROM [InventarioIDC].[dbo].[tbl2_almacenamiento] A,
					 [InventarioIDC].[dbo].[tbl2_almacenamiento_servidor] B,
					 [InventarioIDC].[dbo].[tbl2_servidor] C,
					 [InventarioIDC].[dbo].[tbl2_servidor_app] D,
					 [InventarioIDC].[dbo].[tbl2_aplicacion] E,
					 [InventarioIDC].[dbo].[tbl2_servicio] F
				WHERE a.id_almacenamiento = b.id_almacenamiento
				  AND c.id_servidor = b.id_servidor
				  AND c.id_servidor = d.id_servidor
				  AND e.id_aplicacion = d.id_aplicacion
				  AND e.id_servicio = f.id_servicio
				  AND e.id_servicio =".$params->ServerDB;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	
/*Consulta que muestra Nombre de bases de datos, nombre de la instancia, ambiente de la instancia, 
  motor de la instancia, fabricante instancia, clase, licencia de la instancia asociada a las bases de datos que estan asu vez asociadas al servicio SPLUNK mostrar nombre del servicio.
*/

	public function AppServiceDB($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->AppServiceDB) || !array_key_exists('AppServiceDB', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
			if($flagPoolAppFramework){
				$sql = "SELECT B.nombre Base_de_Datos, C.nombre Instancia, C.ambiente Ambiente_Instancia, D.nombre Motor_Instancia, 
					   D.fabricante Fabricante, D.clase Clase_Instancia, D.licencia Licencia_Instancia, 
					   F.nombre Nombre_Servicio, G.nombre Aplicacion
				FROM [InventarioIDC].[dbo].[tbl2_bd_instancia] A,
					 [InventarioIDC].[dbo].[tbl2_basesdatos] B,
					 [InventarioIDC].[dbo].[tbl2_instancia] C,
					 [InventarioIDC].[dbo].[tbl2_motor_bd] D,
					 [InventarioIDC].[dbo].[tbl2_bd_app] E,
					 [InventarioIDC].[dbo].[tbl2_servicio] F,
					 [InventarioIDC].[dbo].[tbl2_aplicacion] G
				WHERE A.id_bd = B.id_bd
				  AND A.id_instancia = C.id_instancia
				  AND C.id_motor_bd = D.id_motor_bd
				  AND B.id_bd = E.id_bd
				  AND E.id_aplicacion = G.id_aplicacion
				  AND F.id_servicio = G.id_servicio
				  AND F.id_servicio IN (".$params->PoolAppFramework.")";
			}
			else{
				 $sql = "SELECT B.nombre Base_de_Datos, C.nombre Instancia, C.ambiente Ambiente_Instancia, D.nombre Motor_Instancia, 
					   D.fabricante Fabricante, D.clase Clase_Instancia, D.licencia Licencia_Instancia, 
					   F.nombre Nombre_Servicio, G.nombre Aplicacion
				FROM [InventarioIDC].[dbo].[tbl2_bd_instancia] A,
					 [InventarioIDC].[dbo].[tbl2_basesdatos] B,
					 [InventarioIDC].[dbo].[tbl2_instancia] C,
					 [InventarioIDC].[dbo].[tbl2_motor_bd] D,
					 [InventarioIDC].[dbo].[tbl2_bd_app] E,
					 [InventarioIDC].[dbo].[tbl2_servicio] F,
					 [InventarioIDC].[dbo].[tbl2_aplicacion] G
				WHERE A.id_bd = B.id_bd
				  AND A.id_instancia = C.id_instancia
				  AND C.id_motor_bd = D.id_motor_bd
				  AND B.id_bd = E.id_bd
				  AND E.id_aplicacion = G.id_aplicacion
				  AND F.id_servicio = G.id_servicio
				  AND F.id_servicio = ".$params->AppServiceDB;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
/*Consulta para mostrar los servidores que estan en el cluster de virtualización 
  Cluster Producción-Corp y el Cluster REDHAT (mostrar nombre del servidor, serial y vlan)*/	
	public function ClusterServer($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->ClusterServer) || !array_key_exists('ClusterServer', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
			if($flagPoolAppFramework){
				$sql = "SELECT C.nombre Servidor, c.serial Serial_Servidor, e.nombre_vlan
				FROM [InventarioIDC].[dbo].[tbl2_cluster_virtualizacion] A,
					 [InventarioIDC].[dbo].[tbl2_servidor_cluster] B,
					 [InventarioIDC].[dbo].[tbl2_servidor] C,
					 [InventarioIDC].[dbo].[tbl2_servidor_vlan] D,
					 [InventarioIDC].[dbo].[tbl2_vlan] E
				WHERE a.id_cluster_virtualizacion = b.id_cluster_virtualizacion
				  AND b.id_servidor = c.id_servidor
				  AND C.id_servidor = D.id_servidor
				  AND d.id_vlan = e.id_vlan
				  AND a.id_cluster_virtualizacion IN (".$params->PoolAppFramework.")";
			}
			else{
				$sql = "SELECT C.nombre Servidor, c.serial Serial_Servidor, e.nombre_vlan
				FROM [InventarioIDC].[dbo].[tbl2_cluster_virtualizacion] A,
					 [InventarioIDC].[dbo].[tbl2_servidor_cluster] B,
					 [InventarioIDC].[dbo].[tbl2_servidor] C,
					 [InventarioIDC].[dbo].[tbl2_servidor_vlan] D,
					 [InventarioIDC].[dbo].[tbl2_vlan] E
				WHERE a.id_cluster_virtualizacion = b.id_cluster_virtualizacion
				  AND b.id_servidor = c.id_servidor
				  AND C.id_servidor = D.id_servidor
				  AND d.id_vlan = e.id_vlan
				  AND a.id_cluster_virtualizacion = ".$params->ClusterServer;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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

	public function InstanceDB($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->InstanceDB) || !array_key_exists('InstanceDB', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
			if($flagPoolAppFramework){
				$sql = "SELECT c.nombre Bases_Datos, b.nombre Instancia, b.ambiente, d.nombre Motor_Base_Datos, d.licencia
				FROM [InventarioIDC].[dbo].[tbl2_bd_instancia] A,
					 [InventarioIDC].[dbo].[tbl2_instancia] B,
					 [InventarioIDC].[dbo].[tbl2_basesdatos] C,
					 [InventarioIDC].[dbo].[tbl2_motor_bd] D
				WHERE a.id_instancia = b.id_instancia
				  AND a.id_bd = c.id_bd 
				  AND b.id_motor_bd = d.id_motor_bd
				  AND a.id_instancia IN (".$params->PoolAppFramework.")";
			}
			else{
				$sql = "SELECT c.nombre Bases_Datos, b.nombre Instancia, b.ambiente, d.nombre Motor_Base_Datos, d.licencia
				FROM [InventarioIDC].[dbo].[tbl2_bd_instancia] A,
					 [InventarioIDC].[dbo].[tbl2_instancia] B,
					 [InventarioIDC].[dbo].[tbl2_basesdatos] C,
					 [InventarioIDC].[dbo].[tbl2_motor_bd] D
				WHERE a.id_instancia = b.id_instancia
				  AND a.id_bd = c.id_bd 
				  AND b.id_motor_bd = d.id_motor_bd
				  AND a.id_instancia = ".$params->InstanceDB;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	

	/*Consulta para mostrar las instancias con motor ORacle 11g en ambiente de producción. 
  (mostrar nombre instancias, motor, licencia, ambiente)*/
	public function InstanceMotorDB($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->InstanceMotorDB) || !array_key_exists('InstanceMotorDB', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
			if($flagPoolAppFramework){
				$sql = "SELECT A.nombre Instancia, b.nombre, b.licencia, a.ambiente
				FROM [InventarioIDC].[dbo].[tbl2_instancia] A,
				[InventarioIDC].[dbo].[tbl2_motor_bd] B
				WHERE a.id_motor_bd = b.id_motor_bd
				AND a.id_motor_bd IN (".$params->PoolAppFramework.")";
			}
			else{
				$sql = "SELECT A.nombre Instancia, b.nombre, b.licencia, a.ambiente
				FROM [InventarioIDC].[dbo].[tbl2_instancia] A,
				[InventarioIDC].[dbo].[tbl2_motor_bd] B
				WHERE a.id_motor_bd = b.id_motor_bd
				AND a.id_motor_bd = ".$params->InstanceMotorDB;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	/*Consulta para mostrar los servidores de bases de datos(Instancias) 
  (mostrar nombre del servidor, serial y vlan)*/
	    public function ServerInstance($params = null) {
        global $codigoErrores;
        global $ambiente;
        $response = array();
		$flagPoolAppFramework = false;
		$sql = '';
        try {
            $params = json_decode($params);
            
            if(!is_object($params)){
                throw new Exception('04');
            }
            
            if(empty($params->ServerInstance) || !array_key_exists('ServerInstance', (array)$params)){
				
                throw new Exception('03');
            }
			
			if(!empty($params->PoolAppFramework) || array_key_exists('PoolAppFramework', (array)$params)){
				
               $flagPoolAppFramework = true;
            }
            
            if (!$this->conectarSQLServer()) {
                throw new Exception('01');
            }
            
			if($flagPoolAppFramework){
				$sql = "SELECT b.nombre Servidor, b.serial, e.nombre_vlan
				FROM [InventarioIDC].[dbo].[tbl2_servidor_instancia] A,
					 [InventarioIDC].[dbo].[tbl2_servidor] B,
					 [InventarioIDC].[dbo].[tbl2_instancia] C,
					 [InventarioIDC].[dbo].[tbl2_servidor_vlan] D,
					 [InventarioIDC].[dbo].[tbl2_vlan] E
				WHERE a.id_instancia = c.id_instancia
				  AND a.id_servidor = b.id_servidor 
				  AND b.id_servidor = d.id_servidor
				  AND e.id_vlan = d.id_vlan
				  AND a.id_instancia IN (".$params->PoolAppFramework.")";
			}
			else{
				$sql = "SELECT b.nombre Servidor, b.serial, e.nombre_vlan
				FROM [InventarioIDC].[dbo].[tbl2_servidor_instancia] A,
					 [InventarioIDC].[dbo].[tbl2_servidor] B,
					 [InventarioIDC].[dbo].[tbl2_instancia] C,
					 [InventarioIDC].[dbo].[tbl2_servidor_vlan] D,
					 [InventarioIDC].[dbo].[tbl2_vlan] E
				WHERE a.id_instancia = c.id_instancia
				  AND a.id_servidor = b.id_servidor 
				  AND b.id_servidor = d.id_servidor
				  AND e.id_vlan = d.id_vlan
				  AND a.id_instancia = ".$params->ServerInstance;
			}
            
					
			if(!empty($params->debug) && array_key_exists('debug', (array)$params) && $params->debug =='1'){
				$response['error']['debug'] = "<pre><b>SQL</b>=>: ".$sql."</pre><br> <b>Parametros</b>=>: ".json_encode($params);
				return $response;
			 }
				
           $recordSet = $this->bd->ejecutarSQL($sql); 
            if (!$recordSet) {
                throw new Exception('01');
            }
            else {
                if($this->bd->dbNumRows($recordSet)>0){
                    $response['num_of_rows'] = $this->bd->dbNumRows($recordSet);
                    $response['dbFetchAssoc'] = $this->bd->dbFetchAssoc($recordSet);
                }
                else{
                    throw new Exception('02');
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
	    public function allowedIP($allowed_ips) {

        $ip_address = "/" . $_SERVER['HTTP_X_FORWARDED_FOR'] . "/i";
        if (preg_match($ip_address, $allowed_ips)) {
            return true;
        } else {
            return false;
        }
    }
}
