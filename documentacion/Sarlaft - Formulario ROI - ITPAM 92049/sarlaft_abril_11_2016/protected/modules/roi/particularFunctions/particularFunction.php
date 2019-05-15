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
                    $response = 'No se logró enviar a ninguna cuenta de correo el resultado de esta acción';
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
        
		if($model['for_complemento']=='Si') 
			$radicado_complemento = '<div class="row">Número de radicado del reporte anterior: '.$model['for_radicado_complemento'].'</div>'; 
		else 
			$radicado_complemento = '';	
		
		$contenido = '<style> .row { margin-left: 10px !important; } p { font-family: Arial, Verdana; display: block;	font-weight: bold; display: inline-block; width: auto; text-align: left; line-height: 25px; font-size: 14px; padding: 14px 2px 7px 7px; } label { font-family: Arial, Verdana; display: block; float: left; margin-right:15px; font-weight: normal;	display: inline-block; width: auto;	min-width: 260px; max-width: 50%; white-space: nowrap; text-align: left; line-height: 25px; font-size: 13px; } </style>	
		<div>
					   
			<h3>Formato de Reporte Operación Inusual</h3>
			
			<div class="row">Empresa: '.$model['for_empresa'].'</div>

			<div class="row">¿Es complemento de otro reporte anterior?: '.$model['for_complemento'].'</div>

			'.$radicado_complemento.'

			<p>Identificación de la persona Natural o Jurídica directamente vinculada con la operación reportada.</p>
			
			<div class="row">Tipo Identificación: '.$model['for_tipo_identificacion'].'</div>

			<div class="row">Identificación: '.$model['for_identificacion_persona'].'</div>

			<div class="row">Nombre completo o Razón Social: '.$model['for_nombre_persona'].'</div>

			<div class="row">Sucursal u oficina de la operación inusual: '.$model['for_sucursal_operacion'].'</div>

			<div class="row">País: '.$model['for_pais'].'</div>

			<div class="row">Departamento: '.$model['for_departamento'].'</div>

			<div class="row">Ciudad: '.$model['for_ciudad'].'</div>

			
			<div class="row">Dirección: '.$model['for_direccion'].'</div>

			<div class="row">Teléfono: '.$model['for_telefono'].'</div>

			<div class="row">Código postal: '.$model['for_codigo_postal'].'</div>

			<p>A cuál de los grupos de interés pertenece la Persona Natural o Jurídica que realiza la operación sospechosa</p>
			
			<div class="row">Grupos de Interés: '.$model['for_grupo_interes'].'</div>

			<div class="row">Otros Grupos de Interés: '.$model['for_grupo_interes_otro'].'</div>

			<p>Hechos o circunstancias que hacen considerar una operación inusual</p>
			
			<div class="row">Tipo de operación inusual: '.$model['for_tipo_operacion'].'</div>

			<div class="row">Otro Tipo de operación inusual: '.$model['for_tipo_operacion_otro'].'</div>

			<p>Identificación de otras personas a este reporte</p>
			
			
			
			<p>Descripción del incidente<br>Haga una descripción de los hechos acontecidos que lo llevan a justificar el por qué de la operación sospechosa.</p>
			
			<div class="row">Observación: '.$model['for_observacion'].'</div>

			<p>Periodo en que se realizó la operación</p>
			
			<div class="row">Fecha inicio: '.$model['for_fecha_inicio'].'</div>

			<div class="row">Fecha fin: '.$model['for_fecha_fin'].'</div>

			<p>Tipo Producto o Servicio afectado</p>

			<div class="row">Producto o Servicio: '.$model['for_producto'].'</div>
			
			<div class="row">Otro Producto o Servicio: '.$model['for_producto_otro'].'</div>

			<p>Datos de quien reporta (Opcional)</p>
			
			<div class="row">Nombre del reportante: '.$model['for_reportante_nombre'].'</div>

			<div class="row">Tipo identificación: '.$model['for_reportante_tipo_identificacion'].'</div>

			<div class="row">Identificación: '.$model['for_reportante_identificacion'].'</div>

			<div class="row">Correo electrónico: '.$model['for_reportante_correo'].'</div>
			
		</div>';
		
		return $contenido;

	}

}
