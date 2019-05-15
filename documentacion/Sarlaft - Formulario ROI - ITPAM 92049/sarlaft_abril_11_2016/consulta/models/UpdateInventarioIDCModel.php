<?php

include_once(__DIR__ . '/../include/config.php');

/**
 * @author; Joan Harriman Navarro M
 * @email: jnavarrm@asesor.une.com.co
 * @copyright: TIGO UNE
 */
class UpdateInventarioIDCModel {
	//solo para validar los registros que fueron cambiados
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
	 
	//Consulta para actualizar registro en la tabla Framework
	public function Update_Framework($params = null) {
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
            $sql = "UPDATE [dbo].[tbl2_framework] SET [nombre] = '".$params->nombre."',[numero_version] = '".$params->numero_version."',[fecha_lanzamiento] = '".$params->fecha_lanzamiento."',[licencia] = '".$params->licencia."',[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_framework =".$params->id_framework;
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
	//Consulta para actualizar registro en la tabla Cluster_Virtualizacion
	public function Update_ClusterVirtualizacion($params = null) {
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
            $sql = "UPDATE [dbo].[tbl2_cluster_virtualizacion] SET [nombre] = '".$params->nombre."',[hypervisor] = '".$params->hypervisor."',[ip_administracion] = '".$params->ip_administracion."',[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_cluster_virtualizacion =".$params->id_cluster_virtualizacion;
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
	//Consulta para actualizar registro en la tabla Motor_App
	public function Update_MotorApp($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_motor_app] SET [nombre] = '".$params->nombre."',[numero_version] = '".$params->numero_version."',[fecha_lanzamiento] = '".$params->fecha_lanzamiento."',[licencia] = '".$params->licencia."',[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_motor_app =".$params->id_motor_app;
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
	//Consulta para actualizar registro en la tabla Motor_BD
	public function Update_MotorBD($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_motor_bd] SET [nombre] = '".$params->nombre."',[numero_version] = '".$params->numero_version."',[fecha_lanzamiento] = '".$params->fecha_lanzamiento."',[fabricante] = '".$params->fabricante."',[clase] = '".$params->clase."',[licencia] = '".$params->licencia."',[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_motor_bd =".$params->id_motor_bd;
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
	//Consulta para actualizar registro en la tabla Motor_BD
	public function Update_TipoApp($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_tipo_app] SET [tipo_aplicacion] = '".$params->tipo_aplicacion."',[capa] = '".$params->capa."',[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_tipo_app =".$params->id_tipo_app;
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
	//Consulta para actualizar registro en la tabla Servicio
	public function Update_Servicio($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_servicio] SET [nombre] = '".$params->nombre."',[responsable_tecnico] = '".$params->responsable_tecnico."',
			[responsable_funcional] = '".$params->responsable_funcional."',[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_servicio =".$params->id_servicio;
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
	//Consulta para actualizar registro en la tabla Servicio
	public function Update_Almacenamiento($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_almacenamiento] SET [ruta] = '".$params->ruta."',[tipo_datos] = '".$params->tipo_datos."',[size] = '".$params->size."',[caja_almacenamiento] ='".$params->caja_almacenamiento."',
			[fabricante] = '".$params->fabricante."',[nivel_almacenamiento] = '".$params->nivel_almacenamiento."',[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_almacenamiento =".$params->id_almacenamiento;
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
	//Consulta para actualizar registro en la tabla Instancia
	public function Update_Instancia($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_instancia] SET [nombre] = '".$params->nombre."',[descripcion] = '".$params->descripcion."',[direccion_ip] = '".$params->direccion_ip."',[puerto] ='".$params->puerto."',[id_motor_bd] ='".$params->id_motor_bd."',[is_cluster] ='".$params->id_cluster."',
			[memoria_min_MB] = '".$params->memoria_min_MB."',[memoria_max_MB] = '".$params->memoria_max_MB."',[ambiente] = '".$params->ambiente."',[fecha_instalacion] = '".$params->fecha_instalacion."',[tipo_instancia] ='".$params->tipo_instancia."',[responsable_tecnico] ='".$params->responsable_tecnico."',[responsable_funcional] ='".$params->responsable_funcional."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_instancia =".$params->id_instancia;
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
	//Consulta para actualizar registro en la tabla Aplicacion
	public function Update_Aplicacion($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_aplicacion] SET [id_servicio] = '".$params->id_servicio."',[nombre] = '".$params->nombre."',[id_tipo_app] = '".$params->id_tipo_app."',[id_motor_app] = '".$params->id_motor_app."',[id_framework] ='".$params->id_framework."',[numero_version] ='".$params->numero_version."',[licencia] ='".$params->licencia."',[fecha_lanzamiento] = '".$params->fecha_lanzamiento."',
			[fabricante] = '".$params->fabricante."',[link_acceso] = '".$params->link_acceso."',[arquitectura_objetivo] = '".$params->arquitectura_objetivo."',[CertificadoSSL] ='".$params->CertificadoSSL."',[Documentado] ='".$params->Documentado."',[ip_publica] ='".$params->ip_publica."',[criticidad] ='".$params->criticidad."',[fecha_instalacion] ='".$params->fecha_instalacion."',[OC_Instalacion] ='".$params->OC_Instalacion."',[tipo_plataforma] ='".$params->tipo_plataforma."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_aplicacion =".$params->id_aplicacion;
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
	//Consulta para actualizar registro en la tabla FamiliaServicio
	public function Update_FamiliaServicio($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_familia_servicio] SET [id_servicio] = '".$params->id_servicio."',[id_servicio_padre] = '".$params->id_servicio_padre."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_familia_servicio =".$params->id_familia_servicio;
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
	//Consulta para actualizar registro en la tabla Almacenamiento_BD
	public function Update_AlmacenamientoBD($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_almacenamiento_bd] SET [id_almacenamiento] = '".$params->id_almacenamiento."',[id_bd] = '".$params->id_bd."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_bd_alm =".$params->id_bd_alm;
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
	//Consulta para actualizar registro en la tabla Almacenamiento_Servidor
	public function Update_AlmacenamientoServidor($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_almacenamiento_servidor] SET [id_almacenamiento] = '".$params->id_almacenamiento."',[id_servidor] = '".$params->id_servidor."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_server_alm =".$params->id_server_alm;
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
	//Consulta para actualizar registro en la tabla Servidor_App
	public function Update_ServidorApp($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_servidor_app] SET [id_aplicacion] = '".$params->id_aplicacion."',[id_servidor] = '".$params->id_servidor."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_servidor_app =".$params->id_servidor_app;
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
	//Consulta para actualizar registro en la tabla Servidor_Cluster
	public function Update_ServidorCluster($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_servidor_cluster] SET [id_cluster_virtualizacion] = '".$params->id_cluster_virtualizacion."',[id_servidor] = '".$params->id_servidor."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_servidor_cluster =".$params->id_servidor_cluster;
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
	//Consulta para actualizar registro en la tabla Servidor_Instancia
	public function Update_ServidorInstancia($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_servidor_instancia] SET [id_instancia] = '".$params->id_instancia."',[id_servidor] = '".$params->id_servidor."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_servidor_instancia =".$params->id_servidor_instancia;
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
	//Consulta para actualizar registro en la tabla Servidor_Vlan
	public function Update_ServidorVlan($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_servidor_vlan] SET [id_vlan] = '".$params->id_vlan."',[id_servidor] = '".$params->id_servidor."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_servidor_vlan =".$params->id_servidor_vlan;
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
	//Consulta para actualizar registro en la tabla BD_App
	public function Update_BDApp($params = null) {
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
            $sql = "UPDATE [InventarioIDC].[dbo].[tbl2_bd_app] SET [id_bd] = '".$params->id_bd."',[id_aplicacion] = '".$params->id_aplicacion."',
			[modificadopor] ='".$params->username."',[fechamodificacion] = getdate(),[Modificado_IDC] = 'S' WHERE id_bd_app =".$params->id_bd_app;
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
