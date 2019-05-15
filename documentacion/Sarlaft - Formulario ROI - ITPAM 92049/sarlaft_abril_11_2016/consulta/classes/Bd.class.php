<?php

/**
 * Clase db
 * Esta clase realiza todos los procesos con la base de datos
 * @access	public
 */
class Bd {

    public $debug = false;
    public $msgError = '';
    public $connect = '';
    public $type = 'mysql';
    public $username = '';
    public $password = '';
    public $host = '';
    public $tnsnames = '';
    public $database = '';
    public $module_id = 'NULL';
    public $last_id = 0;
    private static $objInstancia = null;

    /**
     *
     * Metódo singleton por medio del cual se instancia de manera única el objeto de ésta clase
     */
    public static function singleton($username = '', $password = '', $host = '', $database = '') {
        if (self::$objInstancia == null)
            self::$objInstancia = new self();
        if ($username == '') {
            self::$objInstancia->username = USER;
            self::$objInstancia->password = PASSD;
            self::$objInstancia->host = INSTANCE;
            self::$objInstancia->database = BD;
        } else {
            self::$objInstancia->username = $username;
            self::$objInstancia->password = $password;
            self::$objInstancia->host = $host;
            self::$objInstancia->database = $database;
        }
        return self::$objInstancia;
    }

    public function __construct($username = '', $password = '', $host = '', $database = '') {
        if ($username == '') {
            $this->username = USER;
            $this->password = PASSD;
            $this->host = INSTANCE;
            $this->database = BD;
        } else {
            $this->username = $username;
            $this->password = $password;
            $this->host = $host;
            $this->database = $database;
        }
    }

    /**
     *
     * Método para crear la conexión a la base de datos dependiendo de que motor sea
     * @author UNE TELECOMUNICACIONS T&O
     *
     */
    function conectar() {
        try {
            if ($this->type = 'SQLServer') {
                $this->connect = mssql_connect($this->host, $this->username, $this->password) 
                        or die(json_encode(array('error'=>mssql_get_last_message())));
                mssql_min_message_severity(17);
                mssql_select_db($this->database, $this->connect) 
                        or die(json_encode(array('error'=>mssql_get_last_message())));
                if(substr(mssql_get_last_message(), 0, 24) != 'Changed database context')
                    {
                        $this->msgError = "[" . mssql_get_last_message(). "]";
                    }
            } elseif ($this->type = 'mysql') {
                $this->connect = mysql_connect($this->host, $this->username, $this->password);
                $this->msgError = "[" . mysql_errno() . "] -- " . mysql_error();
                mysql_query("SET NAMES 'utf8'", $this->connect);
                mysql_select_db($this->database, $this->connect);
            }
        } catch (Exception $e) { 
            $this->msgError = $e->getMessage();
        }
    }

    /**
     *
     * Este método retorna el nombre del campo de acuerdo a la posición del recordset
     *
     * @author Jorge Arzuaga jarzuaga@intergrupo.com
     * 4/04/2013
     *
     * @param object $recordSet
     * @param int $field_offset
     */
    function dbFieldName($recordSet, $field_offset) {
        return mysql_field_name($recordSet, $field_offset);
    }

    /**
     * Cierra la conexión establecida con la base de datos
     * @author UNE TELECOMUNICACIONS T&O
     *
     */
    function cerrarConexion() {
        if ($this->type = 'SQLServer') {
            mssql_free_result($this->connect); 
            mssql_close($this->connect);
        } elseif ($this->type = 'mysql') {
            mysql_close($this->connect);
        }
    }

    /**
     *
     * Este método se usa para ejecutar cualquier CRUD a una base de datos de acuerdo al motor
     * establecido
     * @author UNE TELECOMUNICACIONS T&O
     *
     * @param string $strSql
     * @return resource
     */
    function ejecutarSQL($strSql) {
        $this->msgError = '';
        $recordSet = array('Null');
        if ($this->connect) {
            try { 
                $this->strSql = trim($strSql);
                $tiene_permiso = true;

                if ($this->type = 'SQLServer') {
                    $recordSet = mssql_query($strSql); 
                    mssql_min_message_severity(17);
                    if(substr(mssql_get_last_message(), 0, 24) != 'Changed database context')
                    {
                        $this->msgError = "[" . mssql_get_last_message(). "]";
                    }
                    
                } elseif ($this->type = 'mysql') { 
                    $tipoSQL = strtoupper(substr($strSql, 0, 6));
                    if ($tiene_permiso == true) {
                        $recordSet = mysql_query($strSql, $this->connect);
                        $this->msgError = mysql_error($this->connect);
                        $this->last_id = mysql_insert_id($this->connect);
                        if ($this->msgError != '') {
                            #$this->writeLog($this->msgError);
                        } elseif (in_array($tipoSQL, array('INSERT', 'UPDATE', 'DELETE'))) {
                            #$this->writeLog(' ','SQL');
                        }
                        $this->numError = mysql_errno($this->connect);
                    }
                }
                if ($this->debug) {
                    $param_in['type'] = 'warning';
                    $param_in['message'] = $strSql;
                    $mod_messages = new StateMessagesDefault(new StateMessages($param_in));
                    $mod_messages->getStateMessages();
                }
                $strSql;

            } catch (Exception $e) {
                $this->msgError = $e->getMessage();
            }
        }
        return $recordSet;
    }

    /**
     * Método para guardar un log de errores
     * @param string $strContenido
     * @param string $strTipo
     */
    function writeLog($strContenido, $strTipo = '') {
        if ($strContenido <> '') {
            $this->conectar();
            $ip = getenv('REMOTE_ADDR');
            $strContenido = "SQL: " . $this->strSql . " " . $strContenido;
            $insert = "INSERT INTO " . SQL_LOG . " values (0," . $this->module_id . ",'" . $_SESSION['alias'] . "', '" . $_SERVER['REMOTE_ADDR'] . "', '" . $_REQUEST['ctr'] . "', '" . addslashes($strContenido) . "','" . $_SERVER['REQUEST_URI'] . "', NOW())";
            mysql_query($insert, $this->connect);
        }
    }

    function dbFetchAssoc($recordSet) {
        $fetch = array();
        if ($this->type = 'SQLServer') {
            while ($row = mssql_fetch_assoc($recordSet)) {
                $fetch[] = $row;
            }
        } elseif ($this->type = 'mysql') {
            $fetch = mysql_fetch_assoc($recordSet);
        }
        return $fetch;
    }

    function dbFetchArray($recordSet) {
        if ($this->type = 'SQLServer') {
            $fetch = mssql_fetch_array($recordSet,MSSQL_ASSOC);
        } elseif ($this->type = 'mysql') {
            $fetch = mysql_fetch_array($recordSet, MYSQL_ASSOC);
        }
        return $fetch;
    }

    /**
     *
     * Este método devuelve el número de filas affectadas por una operación CRUD
     * @author UNE TELECOMUNICACIONS T&O
     *
     * @return number
     */
    function dbAffectedRows() {
		$stid = 0;
		 if ($this->type = 'SQLServer') {
            $stid = mssql_rows_affected($this->connect);
        } elseif ($this->type = 'mysql') {
			$stid = mysql_affected_rows();
		}
        return $stid;
    }

    /**
     *
     * Este método mueve el puntero de un recordset a la fila enviada
     * @param recordset $recordSet
     * @param int $row_number
     * @return boolean
     */
    function dbDataSeek($recordSet, $row_number) {
        return mysql_data_seek($recordSet, $row_number);
    }

    /**
     * Retorna el número de filas de la consulta
     * @param recordSet $recordSet
     * @return number
     */
    function dbNumRows($recordSet) {
        if ($this->type = 'SQLServer') {
            $stid = mssql_num_rows($recordSet);
        } elseif ($this->type = 'mysql') {
            $stid = mysql_num_rows($recordSet);
        }
        return $stid;
    }

    /**
     * Mostrar las tables de la base de datos activa
     */
    function showTables() {
        $sql = "SHOW TABLES FROM " . $this->database;
        $result = $this->ejecutarSQL($sql);
        while ($row = mysql_fetch_row($result)) {
            $arrTables[] = $row[0];
        }
        return $arrTables;
    }

    /**
     *
     * Este método devuelve el número de filas affectadas por una operación CRUD
     * @author UNE TELECOMUNICACIONS T&O
     *
     * @return number
     */
    function dbInsertId() {
        return mysql_insert_id($this->connect);
    }

    /**
     * Metodo para eliminar un registro en una tabla
     * @param string $strTabla
     * @param string $strWhere
     */
    function eliminar($strTabla, $strWhere) {
        if (!empty($strWhere)) {
            $sql = "DELETE FROM " . $strTabla . " WHERE " . $strWhere;
        } else {
            $sql = "DELETE FROM " . $strTabla . " ;";
        }
        if ($this->debug) {
            $param_in['type'] = 'warning';
            $param_in['message'] = $sql;
            $mod_messages = new StateMessagesDefault(new StateMessages($param_in));
            $mod_messages->getStateMessages();
        }
        if ($this->ejecutarSQL($sql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * Método para Insertar en una Tabla
     * @param string $strTabla
     * @param string $strCampos
     * @param string $strValores
     * @param array $arrCamposFunc // array con los campos a los cuales no se les colocará comillas simples
     */
    function insertar($strTabla, $strCampos, $strValores, $arrCamposFunc = array()) {
        if ($strCampos <> '' && $strTabla <> '') {
            $arrValores = explode("|", $strValores);
            $arrCampos = explode("|", $strCampos);
            $strValores = '';
            $strCampos = '';
            $count = count($arrValores);
            for ($i = 0; $i < $count; $i++) {
                $strCampos .= $arrCampos[$i] . ",";
                if ($arrValores[$i] != '' && $strCampos[$i] != '' && !in_array($arrCampos[$i], $arrCamposFunc)) {
                    $strValores .= "'" . urldecode($arrValores[$i]) . "',";
                } elseif (in_array($arrCampos[$i], $arrCamposFunc)) {
                    /**
                     * Si el valor del campo es por ejemplo now() concat() etc..:
                     */
                    $strValores .= urldecode($arrValores[$i]) . ",";
                } elseif ($strCampos[$i] != '') {
                    $strValores .= "null,";
                }
            }
            $strValores = substr($strValores, 0, -1);
            $strCampos = substr($strCampos, 0, -1);
            $sql = "INSERT INTO " . $strTabla . " (" . $strCampos . ") VALUES(" . $strValores . ")";
            if ($this->debug) {
                $param_in['type'] = 'warning';
                $param_in['message'] = $sql;
                $mod_messages = new StateMessagesDefault(new StateMessages($param_in));
                $mod_messages->getStateMessages();
            }

            if ($this->ejecutarSQL($sql))
                return true;
            else
                return false;
        }
    }

    /**
     *
     * Método para actualizar campos en una tabla
     * @param string $strTabla
     * @param string $strCampos
     * @param string $strValores
     * @param string $strWhere
     * @param array $arrCamposFunc // array con los campos a los cuales no se les colocará comillas simples
     */
    function actualizar($strTabla, $strCampos, $strValores, $strWhere, $arrCamposFunc = array()) {
        $arrValores = explode("|", $strValores);
        $arrCampos = explode("|", $strCampos);
        $sql = '';
        $count = count($arrValores);
        for ($i = 0; $i < $count; $i++) {
            if ($arrValores[$i] != '' && $strCampos[$i] != '' && !in_array($arrCampos[$i], $arrCamposFunc)) {
                $sql .= $arrCampos[$i] . "='" . urldecode($arrValores[$i]) . "',";
            } elseif (in_array($arrCampos[$i], $arrCamposFunc)) {
                /**
                 * Si el valor del campo es por ejemplo now() concat() etc..:
                 */
                $sql .= $arrCampos[$i] . "=" . urldecode($arrValores[$i]) . ",";
            } elseif ($strCampos[$i] != '') {
                $sql .= $arrCampos[$i] . "=null,";
            }
        }
        $sql = substr($sql, 0, -1);
        if ($sql != "" && $strWhere != "") {
            $sql = "UPDATE " . $strTabla . " SET " . $sql . " WHERE " . $strWhere;
            if ($this->debug) {
                $param_in['type'] = 'warning';
                $param_in['message'] = $sql;
                $mod_messages = new StateMessagesDefault(new StateMessages($param_in));
                $mod_messages->getStateMessages();
            }
            if ($this->ejecutarSQL($sql))
                return true;
            else
                return false;
        }else {
            return false;
        }
    }

}
