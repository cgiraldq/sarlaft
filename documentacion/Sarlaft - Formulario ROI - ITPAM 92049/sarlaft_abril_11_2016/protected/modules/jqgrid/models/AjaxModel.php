<?php
/**
 * Clase db
 * Esta clase realiza todos los procesos con la base de datos
 * @access	public
 */
class AjaxModel
{

	protected  $bd 			= '';
	public  $error 			= '';
	
	public function __construct($username='', $password='', $host='localhost', $database='')
	{
		if($username !='' && $password !='' && $host !='' && $database !=''){
	   		$dsn			= $typeBd.":host=".$host.";dbname=".$database;
	   		$this->bd 		= new CDbConnection($dsn,$username,$password);
   		}else{
   			$this->bd 		= Yii::app()->db;   // assuming you have configured a "db" connection
   		}
	}

	/**
	 *
	 * Método para realizar una consulta estructurada, si es solo un campo y un solo registro,
	 * se devuelve el valor, si son varios campos o el resultado son varios registros, se devuelve el recordset
	 * @param string $strTabla
	 * @param string $strCampoId
	 * @param string $strCampoNombre
	 * @param string $strValor
	 */
	function consulta($strTabla, $strCampoId='', $strCampoNombre = '', $strValor = '', $strWhere = '', $json = 'false', $sql='')
	{
		if($strWhere != '')
			$where 			= " WHERE ".$strWhere;
		else if($strCampoId != '' && $strValor != '')
			$where 			= " WHERE ".$strCampoId." = '".$strValor."'";
		
		if($sql != '')
		{
			$sql .= $where;
		}
		else
		{
			$sql = "SELECT ".$strCampoNombre." as descripcion,".$strCampoId." as campo_id FROM " . $strTabla." ".$where;
		}
		$sql		= str_ireplace("\'", "'", $sql);
		$recordSet 	= $this->ejecutarSQL($sql);		
		
		if($recordSet)
		{ 
			if(mysql_num_rows($recordSet) > 1 && mysql_num_fields($recordSet) >= 2 && $json == 'false')
			{
				return $recordSet;
			}
			elseif(mysql_num_rows($recordSet) >= 1 && mysql_num_fields($recordSet) >= 2 && $json == 'true')
			{
				while($rowRecordSet = $this->dbFetchAssoc($recordSet))
				{
					$jsondata['campo_id'][] 	= $rowRecordSet[$strCampoId];
					$jsondata['campo_desc'][] 	= $rowRecordSet[$strCampoNombre];					
				}
				echo json_encode($jsondata);
			}
			elseif(mysql_num_rows($recordSet) == 1 && mysql_num_fields($recordSet) > 2)
			{ 
				$rowRecordSet = $this->dbFetchAssoc($recordSet);
				$campos = explode(",",$strCampoNombre);
				foreach ($campos as $key => $campo)
				{
					$retorna .= '"'.$campo.'":\''.$rowRecordSet[$campo].'\',';
				}
				$retorna = "[{".substr($retorna,0,-1)."}]";
				echo $retorna;
			}
			elseif(mysql_num_rows($recordSet) == 1 && mysql_num_fields($recordSet) <= 2)
			{
				$rowRecordSet = $this->dbFetchAssoc($recordSet);
				return $rowRecordSet['descripcion'];
			}
		}
	}
	
	/**
	* Metodo para eliminar un registro en una tabla
	* @param string $strTabla
	* @param string $strWhere
	*/
	function delete($strTabla,$strWhere){
		if($strTabla != '' && $strWhere !=''){
			$sql 		= "DELETE FROM ".$strTabla." WHERE ".$strWhere;			
			$command	= $this->bd->createCommand($sql);
			return $command->execute();
		}else{
			return false;
		}
	}
	/**
	*
	* Método para realizar una consulta estructurada, devuelve un objeto JSON
	* @param string $selectSql
	* @param string $strWhere
	*/
	function consultaToJson($select,$table,$strWhere = '')
	{
		if($strWhere != '')
			$where 			= " WHERE ".$strWhere;
	
		if($select != '' && $table != '')
		{
			$sql = "SELECT ".$select." FROM " . $table." ".$where;
		}
		$sql		= str_ireplace("\'", "'", $sql);
		$command	= $this->bd->createCommand($sql);
		$recordSet 	= $command->query();
		if($recordSet)
		{
			foreach($recordSet as $key){
				$campos[] = $key;
			}
			while(($rowRecordSet = $recordSet->read())!==false)
			{
				foreach ($campos as $campo)
				{
					$jsondata[$campo][] 	= $rowRecordSet[$campo];
				}
			}			
			echo json_encode($jsondata);			
		}
	}
	/**
	 *
	 * Método para Insertar en una Tabla
	 * @param string $strTabla
	 * @param string $strFields
	 * @param string $strValues
	 */
	function insert($strTable, $arrFields, $arrValues)
	{  
		if ($arrFields && $arrValues)
		{
		

			// Se guarda los datos del visitante 
			// $arrVisitante = array();
			// $proxy = $_SERVER['REMOTE_ADDR'];
			// $ip = $this->get_client_ip();
			// $browser = $_SERVER['HTTP_USER_AGENT'];
			// $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			// $dns = @gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
			// $host = @gethostbyaddr($HTTP_SERVER_VARS["REMOTE_ADDR"]);	
			// $arrVisitante = array("Proxy"=>$proxy, "IP"=>$ip, "Navegador"=>$browser);
			// $jsonVisitante = json_encode($arrVisitante);
			// Yii::log($jsonVisitante,"info","application.controllers.FormularioController");
			
			
			$strValues = implode(",",$arrValues);
			$strFields = implode(",",$arrFields);
						
			 $sql		= "INSERT INTO ".$strTable." (".$strFields.") VALUES(".$strValues.")";	
			//echo "<br /><br /> ////////////////// ".$sql." ///////////////////////////////<br /><br />";die;
			try{	
				$command	= $this->bd->createCommand($sql);
				$result 	= $command->execute();
			
				// Consulto el último ID creado para tabla
				$sql		= 'SELECT last_insert_id() AS newid';
				$command	= $this->bd->createCommand($sql);
				$recordSet 	= $command->query();
				$rowRecordSet = $recordSet->read();

				$fechaActual = date('dmY');
				$idRadicado = (string) trim($rowRecordSet['newid']);
				
				if(strlen($idRadicado)==1)
					$idRadicado = '000'.$idRadicado;
				elseif(strlen($idRadicado)==2)
					$idRadicado = '00'.$idRadicado;
				elseif(strlen($idRadicado)==3)
					$idRadicado = '0'.$idRadicado;
					
				$radicado = 'LE-'.$fechaActual.'-'.$idRadicado;
				$sql = 'UPDATE tbl_formulario_fle SET fle_radicado = "'.$radicado.'" WHERE fle_id = '.$rowRecordSet['newid'].';';
				$command	= $this->bd->createCommand($sql);
				//echo $result ;die;
				//$result 	= $command->execute();//GENERA UN MENSAJE ALERTA "0" EN LA VENTANA EMERGENTE EN LOS REPORTES AL MOMENTO DE GUARDAR.
				
					
				
			}catch (Exception $e){ 
				if($e->getCode()==23000){
                                   $result = 'Error: ocurrió un error al guardar los registros. Verifique los datos ingresados y vuelva a intentarlo. '; 
                                }else{
                                    if(defined('YII_DEBUG')){
                                        if(YII_DEBUG){
                                            $result = $e->getMessage();
                                        }
                                    }
                                }
			}
			
			return $result;
		}

	}
	/**
	 *
	 * Método para actualizar campos en una tabla
	 * @param string $strTable
	 * @param string $strFields
	 * @param string $strValues
	 * @param string $strWhere
	 */

	function update($strTable, $arrSql, $strWhere){		
                $sqlUpdate = implode(',', $arrSql);
		if($sqlUpdate != "" && $strWhere != "" && $strTable != "")
		{
			$sql		= "UPDATE ".$strTable." SET ".$sqlUpdate." WHERE ".$strWhere;			
			$command	= $this->bd->createCommand($sql);			
			try{	
				$command	= $this->bd->createCommand($sql);
				$result 	= $command->execute();
			}catch (Exception $e){ 
				if(defined('YII_DEBUG')){
                                    if(YII_DEBUG){
                                        $result = $e->getMessage();
                                    }
                                }
			}
			return $result;	
		}else {
			return false;
		}
	}	
        /**
         * 
         * @param type $value
         * @param type $field         
	 * @param array $arrFieldsFunc // array con los campos a los cuales no se les colocará comillas simples
         * @return string
         */
        public function formatSql($value, $field, $arrFieldsFunc){
            $value = mysql_escape_string(trim(strip_tags($value)));
            if ($value != '' && !in_array($field, $arrFieldsFunc)){
                    $value = "'".urldecode($value)."'";
            }elseif (in_array($field, $arrFieldsFunc)){
                    /**
                     * Si el valor del campo es por ejemplo now() concat() etc..: 
                     */
                    $value = urldecode($value);
            }elseif($value == ''){
                    $value = "null";
            }
            return $value;
        }
        /**
         * 
         * @param type $value
         * @param type $field         
	 * @param array $arrFieldsFunc // array con los campos a los cuales no se les colocará comillas simples
         * @return string
         */
        public function formatSqlUpdate($value, $field, $arrFieldsFunc){
            $value = mysql_escape_string(trim(strip_tags($value)));
            if ($value != '' && !in_array($field, $arrFieldsFunc)){
                    $value = $field."='".urldecode($value)."'";
            }elseif (in_array($field, $arrFieldsFunc)){
                    /**
                     * Si el valor del campo es por ejemplo now() concat() etc..: 
                     */
                    $value = $field."=".urldecode($value);
            }elseif($value == ''){
                    $value = $field."=null";
            }
            return $value;
        }
}