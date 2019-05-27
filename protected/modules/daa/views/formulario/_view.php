<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
//echo $this->sincifrar($model->daa_email);
//$correo="cristian.giraldo90@gmail.com";
$correo=$this->sincifrar($model->daa_email);
//$correo="pasuaza@gmail.com";
$host = '200.13.249.167';
$user = 'direccioncompliance@tigoune.com';
$pass='9000923859';

Yii::import('ext.phpmailer.JPhpMailer');

$mail = new JPhpMailer;
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = $host;
$mail->SMTPAuth   = false;
$mail->Username   = $user; // SMTP account username
$mail->Password   = $pass;        // SMTP account password
$mail->SetFrom("Noreplytigo@TigoUne.com", 'Declaración Anticorrupción y Antisoborno');
$mail->Subject    = "Declaración Anticorrupción y Antisoborno";


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
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-daa.jpg" ></td></tr>
<tr><td class="sombra">
<table border="1" width="80%" align="center"><tr><td><b>Radicado: </b>'. $model->daa_radicado.'</td><td><b>Fecha de Registro:</b>'. date('Y-m-d').'</td></tr>
<tr><td><b>Persona que Declara: </b>&nbsp;&nbsp;&nbsp;'.$this->sincifrar($model->daa_nombre).'</td><td><b>Identificación: </b>'.$model->daa_identificacion.'</td></tr>
<tr><td><b>Ha ofrecido sobornos?:</b>&nbsp;'. $model->daa_has_ofrecido.'</td><td><b>Justificación:&nbsp;</b>'. $model->daa_just_has_ofre.'</td></tr>
<tr><td><b>Le han ofrecido soborno?:</b>&nbsp;'. $model->daa_te_han_ofrecido.'</td><td><b>Justificación:&nbsp;</b>'. $model->daa_just_han_ofre.'</td></tr>
<tr><td><b>Ha tenido relación con algún negocio con Tigo?:</b>'. $model->daa_relacion_tigoune.'</td><td><b>Justificación:&nbsp;</b>'. $model->daa_just_rela_tigoune.'</td></tr>
</table>
</td></tr></table></div></body></html>';
//echo $body;die;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $correo;
$mail->AddAddress($address, "Sarlaft");
$mail->AddCC($user);
//$mail->AddCC("cristian.c.giraldo@asesor.une.com.co");
           		
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //echo "Message sent!";
}

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
	La declaración de <b><?php echo $this->sincifrar($model->daa_nombre); ?></b> ha sido enviado correctamente con el número de radicado <?php echo $model->daa_radicado; // $this->sincifrar($model->daa_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('daa_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->daa_radicado), array('view', 'id'=>$model->daa_radicado)); ?>
	<br />
	-->
</div>
