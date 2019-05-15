<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
//echo $this->sincifrar($model->hdata_email);
//$correo="cristian.giraldo90@gmail.com";
/*$correo=$this->sincifrar($model->hdata_email);
$host = '200.13.249.167';
$user = 'direccioncompliance@tigoune.com	';
$pass='9000923859';

Yii::import('ext.phpmailer.JPhpMailer');

$mail = new JPhpMailer;
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = $host;
$mail->SMTPAuth   = false;
$mail->Username   = $user; // SMTP account username
$mail->Password   = $pass;        // SMTP account password
$mail->SetFrom($user, 'Código Ética');
$mail->Subject    = "certificación Lectura Código de ética";


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
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-hdata.png" ></td></tr>
<tr><td class="sombra">Hola, Te confirmamos que la certificación, lectura y comprensión del Código de ética de <b>'.$this->sincifrar($model->hdata_nombre_persona).'</b> ha sido recibida correctamente por el equipo de Compliance, con radicado  No.<b>'. $model->hdata_radicado.'</b>.  
<br><br>Gracias, es compromiso de todos actuar siempre con conductas éticas y transparentes.</td></tr></table></div></body></html>';
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $correo;
$mail->AddAddress($address, "Sarlaft");
//$mail->AddCC('cristian.giraldo90@gmail.com', 'Person One');
           		
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //echo "Message sent!";
}
*/
?>
<style>

	
	
	@media (min-width: 1024px) AND (max-width: 1240px) {
.ce{
 margin-left: 10em;
    margin-right: 14em;
	
	}
}

@media (min-width: 1240px) {
.ce{
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
	El reporte de <?php echo $this->sincifrar($model->hdata_nombre_persona); ?> ha sido enviado correctamente con el número de radicado <?php echo $model->hdata_radicado; // $this->sincifrar($model->hdata_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('hdata_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->hdata_radicado), array('view', 'id'=>$model->hdata_radicado)); ?>
	<br />
	-->
</div>