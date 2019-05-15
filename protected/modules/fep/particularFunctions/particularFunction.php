<?php

class particularFunction {

    /**
     * Permite crear o actualizar archivos a traves de fopen
     * @param string $path
     * @param string $content
     * @throws Exception
     */
    function writeDown($path, $content) {

        if (!file_exists($path)) {
            touch($path);
            $handle = fopen($path, 'w');
            $str = $content;
        } else {
            $str = $content;
            $handle = fopen($path, 'w');
        }
        if (fwrite($handle, $str) === false) {
            throw new Exception("No se pudo escribir en el archivo....");
        }
        fclose($handle);
    }
	
	/**
     * Enviar Correo Nueva Clave de Red
     */
    public function sendEmail($to = array(),$subject,$message) {
        
            try {
           
            Yii::import('application.components.generalFunctions.Array2XML'); 
            
            $params               = array();
            $paramsDecode         = array();
            $count                = 0;
            $response             = "";
            if(count($to))
            { 
                foreach($to as $row){
                    $paramsDecode['body']['overwriteSector']['Destinatario'] = $row;
                    $paramsDecode['body']['overwriteSector']['Codigo'] = CODEMAIL;
                    $paramsDecode['body']['overwriteSector']['Asunto'] = $subject;
                    $paramsDecode['body']['overwriteSector']['Mensaje'] = '<p> '.$message.' </p>';
                    $paramsDecode['body']['overwriteSector']['Contenido_Atributos'] = 'null';
                    
                    $OssXMLEntries = Array2XML::createXML('msg', $paramsDecode);
                    $params['param'][]  = $OssXMLEntries->saveXML();                 
                    /**
                     * Metodo que ejecuta todos el servicio de Mailing
                     */ 
					
					$setLocation=MAILSETLOCATION;
                    
					$wsResponse[]   = Yii::app()->OssManager->exec('mailing',$params,$setLocation);
                    unset($params);                     
                }
            } 
            Yii::app()->eventManager->registerException('sendEmail', json_encode(join(' ',$wsResponse)));
           
            if(count($wsResponse))
            {
                foreach($wsResponse as $val){
                   $xml = simplexml_load_string($val);                   
                   if($xml->body->respuesta->codigoRespuesta = '00'){
                      $count += 1;   
                   }
                }                
                if($count ==0){
                    $response = 'No se logr� enviar a ninguna cuenta de correo el resultado de esta acci�n';
                }
                else{
                    $response = 'Se enviaron ['.$count.'] Correos';
                }
            }
            
            return $response;
            } catch (Exception $ex) {
                #de esta manera se realiza el log de eventos en la tabla mvc_event_log
                Yii::app()->eventManager->registerException('sendEmail_Error',$ex->getTraceAsString());
            
            }
            catch (SoapFault $e) {
                #de esta manera se realiza el log de eventos en la tabla mvc_event_log
                Yii::app()->eventManager->registerException('sendEmail_Error',$e->getTraceAsString());

            }
    }
	
	
	/**
     * Enviar Correo Nueva Clave de Red
     */
    public function contentEmail($model = array()) {
        
		if($model['fep_complemento']=='Si') 
			$radicado_complemento = '<div class="row">N�mero de radicado del reporte anterior: '.$model['fep_radicado_complemento'].'</div>'; 
		else 
			$radicado_complemento = '';	
		
		$contenido = '<style> .row { margin-left: 10px !important; } p { font-family: Arial, Verdana; display: block;	font-weight: bold; display: inline-block; width: auto; text-align: left; line-height: 25px; font-size: 14px; padding: 14px 2px 7px 7px; } label { font-family: Arial, Verdana; display: block; float: left; margin-right:15px; font-weight: normal;	display: inline-block; width: auto;	min-width: 260px; max-width: 50%; white-space: nowrap; text-align: left; line-height: 25px; font-size: 13px; } </style>	
		<div>
					   
			<h3>Formato de Reporte Operaci�n Inusual</h3>
			
			<div class="row">Empresa: '.$model['fep_empresa'].'</div>

			<div class="row">�Es complemento de otro reporte anterior?: '.$model['fep_complemento'].'</div>

			'.$radicado_complemento.'

			<p>Identificaci�n de la persona Natural o Jur�dica directamente vinculada con la operaci�n reportada.</p>
			
			<div class="row">Tipo Identificaci�n: '.$model['fep_tipo_identificacion'].'</div>

			<div class="row">Identificaci�n: '.$model['fep_identificacion_persona'].'</div>

			<div class="row">Nombre completo o Raz�n Social: '.$model['fep_nombre_persona'].'</div>

			<div class="row">Sucursal u oficina de la operaci�n inusual: '.$model['fep_sucursal_operacion'].'</div>

			<div class="row">Pa�s: '.$model['fep_pais'].'</div>

			<div class="row">Departamento: '.$model['fep_departamento'].'</div>

			<div class="row">Ciudad: '.$model['fep_ciudad'].'</div>

			
			<div class="row">Direcci�n: '.$model['fep_direccion'].'</div>

			<div class="row">Tel�fono: '.$model['fep_telefono'].'</div>

			<div class="row">C�digo postal: '.$model['fep_codigo_postal'].'</div>

			<p>A cu�l de los grupos de inter�s pertenece la Persona Natural o Jur�dica que realiza la operaci�n sospechosa</p>
			
			<div class="row">Grupos de Inter�s: '.$model['fep_grupo_interes'].'</div>

			<div class="row">Otros Grupos de Inter�s: '.$model['fep_grupo_interes_otro'].'</div>

			<p>Hechos o circunstancias que hacen considerar una operaci�n inusual</p>
			
			<div class="row">Tipo de operaci�n inusual: '.$model['fep_tipo_operacion'].'</div>

			<div class="row">Otro Tipo de operaci�n inusual: '.$model['fep_tipo_operacion_otro'].'</div>

			<p>Identificaci�n de otras personas a este reporte</p>
			
			
			
			<p>Descripci�n del incidente<br>Haga una descripci�n de los hechos acontecidos que lo llevan a justificar el por qu� de la operaci�n sospechosa.</p>
			
			<div class="row">Observaci�n: '.$model['fep_observacion'].'</div>

			<p>Periodo en que se realiz� la operaci�n</p>
			
			<div class="row">Fecha inicio: '.$model['fep_fecha_inicio'].'</div>

			<div class="row">Fecha fin: '.$model['fep_fecha_fin'].'</div>

			<p>Tipo Producto o Servicio afectado</p>

			<div class="row">Producto o Servicio: '.$model['fep_producto'].'</div>
			
			<div class="row">Otro Producto o Servicio: '.$model['fep_producto_otro'].'</div>

			<p>Datos de quien reporta (Opcional)</p>
			
			<div class="row">Nombre del reportante: '.$model['fep_reportante_nombre'].'</div>

			<div class="row">Tipo identificaci�n: '.$model['fep_reportante_tipo_identificacion'].'</div>

			<div class="row">Identificaci�n: '.$model['fep_reportante_identificacion'].'</div>

			<div class="row">Correo electr�nico: '.$model['fep_reportante_correo'].'</div>
			
		</div>';
		
		return $contenido;

	}

}
