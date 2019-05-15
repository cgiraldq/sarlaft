<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
//echo $this->sincifrar($model->ccp_email);
//$correo="cristian.giraldo90@gmail.com";
//$correo="pasuaza@gmail.com";
$correo=$this->sincifrar($model->ccp_email_tigoune);
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
$mail->SetFrom("Noreplytigo@TigoUne.com", 'Código de Conducta de Proveedores');
$mail->Subject  = "Adhesión del Código de Conducta de Proveedores TigoUne.";




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
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-ccp.jpg" ></td></tr>
<tr><td class="sombra">
<table border="1" width="80%" align="center"><tr><td colspan="2"><b>Radicado: '. $model->ccp_radicado.'</b></td><td>Fecha de Registro: '.$model->fechacreacion.'</td></tr>
<tr><td><b>Razón Social:</b></td><td>'.$this->sincifrar($model->ccp_razon_social).'</td><td><b>Identificación:</b> '.$this->sincifrar($model->ccp_nit).'</td></tr>
<tr><td><b>Fecha dediligenciamiento:</b></td><td colspan="2">'. $model->fechacreacion.'</td></tr>
<tr><td><b>Descripción de la solicitud:</b></td><td colspan="2">En mi calidad de representante legal, certifico y garantizo la lectura, comprensión y acatamiento de las prácticas descritas en este Código de Conducta de Proveedores, así como he sido informado por TigoUne sobre la obligación de cumplir las normas relacionadas con la prevención del Soborno Transnacional y que conozco el programa de Ética Empresarial y las consecuencias de infringirlo. <b>'.$model->ccp_certifica.'</b></td></tr>
<tr><td><b>Observaciones:</b></td><td colspan="2">'.$this->sincifrar($model->ccp_observaciones).'</td></tr>
</table>
</td></tr></table></div></body></html>';
//echo $body;die;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $correo;
$mail->AddAddress($address, "Sarlaft");
$mail->AddCC("gestionproveedores@TigoUne.com");
           		
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
	La Certificación realizada por <b><?php echo $this->sincifrar($model->ccp_razon_social); ?></b> ha sido enviada correctamente con el número de radicado <b><?php echo $model->ccp_radicado; // $this->sincifrar($model->ccp_radicado); ?></b>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('ccp_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->ccp_radicado), array('view', 'id'=>$model->ccp_radicado)); ?>
	
	<br />
	-->
	
</div>