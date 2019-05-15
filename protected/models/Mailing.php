<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mailing
 *
 * @author jarzuas
 */
class Mailing {

    public function sendMail($email, $content, $asunto='', $codigo_mailing='', $tipo_mail='OTRO', $cron=false) {        
        if($codigo_mailing == ''){
            $codigo_mailing = CODIGO_MAILING;
        }
        if($asunto == ''){
            $asunto = MAILING_ASUNTO;
        }
        try {
            $mensaje = "<![CDATA[ ". $content ." ]]>";            
            $xml = "<?xml version='1.0' encoding='utf-8'?>
                    <msg>
                        <body>
                            <overwriteSector>
                                <Asunto>$asunto</Asunto>   
                                <Destinatario>$email</Destinatario>
                                <Codigo>$codigo_mailing</Codigo>
                                <Mensaje>$mensaje</Mensaje>
                            </overwriteSector>
                        </body>
                    </msg>";                                   
            $params['param'] = array('xml' => $xml);
            $wsResponse[] = Yii::app()->OssManager->exec('mailing', $params);               
            $respuesta = simplexml_load_string($wsResponse[0]);
            $datos = $respuesta->body->respuesta;
            $codigoRespuesta = $datos->codigoRespuesta;
            $descripcionRespuesta = $datos->descripcionRespuesta;
            if ($codigoRespuesta == '00') {
                $descripcionRespuesta = 'Email enviado correctamente';
                if(!$cron){
                 $descripcionRespuesta.= ' email: '.$email;   
                 Yii::app()->user->setFlash('success', $descripcionRespuesta);
                }
            }else{
                if(!$cron){               
                    $descripcionRespuesta.= ' email: '.$email;
                    Yii::app()->user->setFlash('error', $descripcionRespuesta);
                }                
            }
        } catch (Exception $e) {
            $descripcionRespuesta = 'ERROR Enviando el email. '.$email.' '.$e->getMessage();
            if(!$cron){
                Yii::app()->user->setFlash('error', $descripcionRespuesta);
            }
        }
		return $descripcionRespuesta;
        //$this->registerMailSended($tipo_mail, $asunto, $email, $content, $descripcionRespuesta);
    }
    
    public function registerMailSended($tipo_mail, $asunto, $para, $contenido, $respuesta, $cron=false)
	{ 
		$model = new MailSended();		
		$model->tipo_mail = $tipo_mail;
                $model->asunto = $asunto;
                $model->para = $para;
                $model->contenido = $contenido;
                $model->respuesta = $respuesta;                
                $model->fechacreacion   = date('Y-m-d H:i:s');
                if(!$cron && isset(Yii::app()->user)){
                    $model->creadopor       = Yii::app()->user->name;                    
                }		
		$model->Save();	
	}

}