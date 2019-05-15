<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();	
	
	
	public function cifrar($texto)
	{
		# establecemos la clave de encriptación a usar
		$clave = "clave";

		/*creamos un identificador de encriptado en el que indicamos
		el tipo de cifrador (cast-128) y el modo de cifrado (ecb) */
		$ident = mcrypt_module_open('cast-128', '', 'ecb', '');
		
		/* dado que algunas funciones requieren de un vector de inicializacion
		acorde con sus especificaciones esta función determina el tamaño
		de ese vector atendiendo al tipo de identificador */
		$long_iniciador=mcrypt_enc_get_iv_size($ident);
     
		/* crea el vector de inicialización con valores aleatorios
		y dándole la dimensión precalculada en la función anterior */
		$inicializador = mcrypt_create_iv ($long_iniciador, MCRYPT_RAND);
     
		/* hacemos algunas comprobaciones innecesarias para ejecutar el script.
        Simplemente son descriptores de algunas funciones complementarias */
		/* comprobamos el tamaño maximo (en bytes)
		que puede tener la clave para este algoritmo de cifra*/
		// print "La clave no puede sobrepasar los ";
		// print mcrypt_enc_get_key_size ($ident)." bytes<br>";
		/* escribimos el tamaño del bloque del
		algoritmo que estamos usando*/
		// print "El tamaño del bloque de cifrado es ";
		// print mcrypt_enc_get_block_size($ident)." bytes<br>";
		// print "El modo de cifrado es ";
		// print mcrypt_enc_get_modes_name($ident)."<br>";
		// print "El algoritmo  de cifrado es ";
		// print mcrypt_enc_get_algorithms_name($ident)."<br>";
		// print "El tamaño del vector de inicialización es ";
		// print mcrypt_enc_get_iv_size ($ident)."<br>";

		/* Contimuamos la secuencia de encriptado incializando todos los buffer
		necesarios para llevar a cabo las labores de encriptado */
		mcrypt_generic_init($ident, $clave, $inicializador);
		
		/* realiza el encriptado proopiamente dicho */
		$texto_encriptado = mcrypt_generic($ident, $texto);
		
		/* libera los buffer pero no cierra el modulo */
		mcrypt_generic_deinit($ident);
		
		/* esta instruccion es necesaria para cerrar el modulo de encriptado*/
		mcrypt_module_close($ident);

		# devolvemos el resultado de la encriptación
		# en este caso añadimos una codificación de ese resultado en base 64
		return base64_encode ($texto_encriptado);
	}
	
	public function sincifrar($texto_encriptado)
	{
		# establecemos el valor del texto a desencriptar
		$texto_encriptado = base64_decode ($texto_encriptado);
		
		# establecemos la clave de encriptación a usar
		$clave = "clave";
		
		/*creamos un identificador de encriptado que ha de ser el mismo con
		el que hemos realizado la encriptación */
		$ident = mcrypt_module_open('cast-128', '', 'ecb', '');
		
		/* dado que algunas funciones requieren de un vector de inicializacion
		acorde con sus especificaciones esta función determina el tamaño de ese
		vector atendiendo al tipo de identificador anterior*/
		$long_iniciador=mcrypt_enc_get_iv_size($ident);
		
		/* crea el vector de inicialización con valores aleatorios
		y dándole la dimensión precalculada en la función anterior */
		$inicializador = mcrypt_create_iv ($long_iniciador, MCRYPT_RAND);
		
		/* incializa todos los buffer necesarios para llevar
		a cabo las labores de encriptado */
		mcrypt_generic_init($ident, $clave, $inicializador);
		
		/* realiza el desencriptado proopiamente dicho. Realmente es la unica
		diferencia básica entre esta función y la anterior */
		$desencriptado = mdecrypt_generic($ident, $texto_encriptado); 
		
		/* libera los buffer pero no cierra el modulo */
		mcrypt_generic_deinit($ident);
		
		/* esta instruccion es necesaria para cerrar el modulo de encriptado*/
		mcrypt_module_close($ident);
		
		# devolvemos el resultado de la des-encriptación
		# en este caso añadimos una codificación de ese resultado en base 64
		return $desencriptado;
	}
	
	// Function to get the client IP address
	function get_client_ip() {
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	
	function getEncryptedFiles(){
	$arrCifrados = array('for_nombre_persona', 'for_identificacion_persona', 'for_complemento_id', 'for_sucursal_operacion', 'for_direccion', 'for_telefono', 'for_codigo_postal', 'for_oficina', 'for_grupo_interes_otro', 'for_tipo_operacion_otro', 'for_persona', 'for_observacion', 'for_producto_otro', 'for_reportante_nombre', 'for_reportante_identificacion', 'for_reportante_correo', 'for_file', 'for_visitante', 
						'fle_nombre_persona', 'fle_descripcion_consulta', 'fle_reportante_nombre', 'fle_otros_datos_contacto', 'fle_visitante', 
						'fci_identificacion_persona', 'fci_nombre_persona', 'fci_email', 'fci_telefono', 'fci_nombre_persona_conflicto', 'fci_identificacion_persona_conflicto', 'fci_identificacion_persona_con', 'fci_parentesco', 'fci_nombre_empresa_conflicto', 'fci_identificacion_empresa_conflicto', 'fci_identificacion_empresa_con', 'fci_actividad_empresa_conflicto', 'fci_actividad_empresa_conflict', 'fci_declaracion_conflicto', 'fci_visitante',
						'fep_nombre','fep_razon_social','fep_nit','fep_persona_responsable','fep_cargo','fep_direccion','fep_telefono','fep_celular','fep_email','fep_descripcion_soli','fep_observaciones','fep_valor_soli_sin_iva','fep_visitante','fep_info_adicional','fep_soporte_inventario',
						'fce_identificacion_persona', 'fce_nombre_persona', 'fce_email', 'fce_telefono', 'fce_visitante','fce_vicepresidencia','fce_area','fce_cargo',
						'ifp_nombre','ifp_identificacion','ifp_vicepresidencia','ifp_area','ifp_cargo','ifp_email','ifp_telefono','ifp_desc_temas','ifp_reporte','ifp_visitante',
						'ccp_razon_social','ccp_nit','ccp_representante','ccp_id_representante','ccp_nom_prov','ccp_id_prov','ccp_tel_prov','ccp_email_tigoune','ccp_email_prov','ccp_nombre_tigoune','ccp_observaciones','ccp_visitante',
						'fra_nombre','fra_identificacion','fra_vicepresidencia','fra_area','fra_cargo','fra_email','fra_telefono','fra_ciudad','fra_sede_entrega','fra_regalo','fra_detalle_regalo','fra_nombre_prov','fra_contacto_nom','fra_email_prov','fra_visitante',
						'daa_nombre','daa_vicepresidencia','daa_area','daa_cargo','daa_email','daa_visitante',
						'hdata_identificacion_persona', 'hdata_nombre_persona', 'hdata_email', 'hdata_telefono', 'hdata_visitante', 'hdata_vicepresidencia','hdata_area','hdata_cargo'
						);
return $arrCifrados;
}

}