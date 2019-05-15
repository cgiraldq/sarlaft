<?php
//echo "holaa";DIE;
/* @var $this MvcUsersController */
/* @var $data MvcUsers */

	$correo_buzon='direccioncompliance@tigoune.com';				
		$correo="Noreplytigo@TigoUne.com";		
	 // $correo="Cristian.C.Giraldo@asesor.une.com.co";

$host = '200.13.249.167';
$user = 'registroune@une.net.co';
$pass='9000923859';
if ($model->fci_jefe_inmediato!="N/A"){
	$jefe_estruc="tu jefe de estructura y";
}
Yii::import('ext.phpmailer.JPhpMailer');

$mail = new JPhpMailer;
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = $host;
$mail->SMTPAuth   = false;
$mail->Username   = $user; // SMTP account username
$mail->Password   = $pass;        // SMTP account password
$mail->SetFrom($correo, 'formulario Declaración Conflicto de Intereses');
$mail->Subject    = "Declaración Conflicto de Intereses";

if($this->sincifrar($model->fci_email)!=""){

	//	echo "hola";die;
   $body  = '<html><body>
  <head>
  <style>
  .sombra{
	  border-right-color: #cccccc;
    border-right-style: solid;
    border-right-width: 1px;
    border-bottom-color: #cccccc;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-left-color: #cccccc;
    border-left-style: solid;
    border-left-width: 1px;
	box-shadow: 5px 5px 20px #cccccc;
    overflow: auto;
	padding: 10px;	
	border-radius: 0px 0px 10px 10px;
		}
  </style>
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-fci.png" ></td></tr>
<tr><td class="sombra">Hola, Te confirmamos que la declaración de  <b>'.$this->sincifrar($model->fci_nombre_persona).'</b>
 ha sido recibida correctamente, por '.$jefe_estruc.' el equipo de Compliance con radicado No.<b>'. $model->fci_radicado.'</b>.  
<br><br>Prontamente te estaremos dando respuesta en caso de presentarse un posible conflicto de intereses.</td></tr></table></div></body></html>';
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $this->sincifrar($model->fci_email);
$mail->AddAddress($address, "Sarlaft");
//$mail->AddCC('person1@domain.com', 'Person One');

	$mail->Send();
				
}
$mail = new JPhpMailer;
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = $host;
$mail->SMTPAuth   = false;
$mail->Username   = $user; // SMTP account username
$mail->Password   = $pass;        // SMTP account password
$mail->SetFrom($correo, 'formulario Declaración Conflicto de Intereses');
$mail->Subject    = "Declaración Conflicto de Intereses";
if($model->fci_declara_conflicto=="0"){ $dec="NO";}else{ $dec="SI";}
   $body  = '<html><body>
  <head>
  <style>
  .sombra{
	  border-right-color: #cccccc;
    border-right-style: solid;
    border-right-width: 1px;
    border-bottom-color: #cccccc;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-left-color: #cccccc;
    border-left-style: solid;
    border-left-width: 1px;
	box-shadow: 5px 5px 20px #cccccc;
    overflow: auto;
	padding: 10px;	
	border-radius: 0px 0px 10px 10px;
		}
  </style>
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-fci.png" ></td></tr>
<tr><td class="sombra">
<table border="1" width="80%" align="center"><tr><td><b>Radicado: </b>'. $model->fci_radicado.'</td><td><b>Fecha de Registro:</b>'. date('Y-m-d').'</td></tr>
<tr><td><b>Declara Conflicto de Intereses:</b></td><td>'.$dec.'</td></tr>
<tr><td><b>Jefe de Estructura:</b></td><td>'.$model->fci_jefe_inmediato.'</td></tr>
<tr><td><b>Persona que Declara: </b>'.$this->sincifrar($model->fci_nombre_persona).'</td><td><b>Identificación: </b>'.$this->sincifrar($model->fci_identificacion_persona).'</td></tr>
<tr><td><b>Con quien (persona natural – Jurídica) se tiene el conflicto:</b></td><td>'.$this->sincifrar($model->fci_nombre_persona_conflicto).'</td></tr>
<tr><td><b>Detalle de la declaración:</b></td><td>'.$this->sincifrar($model->fci_declaracion_conflicto).'</td></tr>
</table>
</td></tr></table></div></body></html>';
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $correo_buzon;
$mail->AddAddress($address, "Sarlaft");
if($model->fci_jefe_inmediato!="" && $model->fci_jefe_inmediato!="N/A"){
//$model->fci_jefe_inmediato="cristian.giraldo90@gmail.com";	
$mail->AddCC($model->fci_jefe_inmediato, "Sarlaft");
	
}

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //echo "Message sent!";
}


?>
<style>

	
	
	@media (min-width: 1024px) AND (max-width: 1240px) {
.ci{
 margin-left: 10em;
    margin-right: 14em;
	
	}
}

@media (min-width: 1240px) {
.ci{
 margin-left: 16em;
    margin-right: 14em;
	
	}
}
	
	
</style>


<div class="form" style="    width: auto;

    max-width: 845px;
    padding: 10px;
    padding-bottom: 40px;
    overflow: auto;
    border: 1px solid #cccccc;
    -moz-box-shadow: 2px 2px 2px #cccccc;
    -webkit-box-shadow: 2px 2px 2px #cccccc;
    box-shadow: 2px 2px 2px #cccccc;">

	<br /><br />
	El reporte de <?php echo $this->sincifrar($model->fci_nombre_persona); ?> ha sido enviado correctamente con el número de radicado <?php echo $model->fci_radicado; // $this->sincifrar($model->fci_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('fci_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->fci_radicado), array('view', 'id'=>$model->fci_radicado)); ?>
	
	<br />
	-->
	
</div>