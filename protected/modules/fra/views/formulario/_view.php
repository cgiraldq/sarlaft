<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
//echo $this->sincifrar($model->fra_email);
//$correo="cristian.giraldo90@gmail.com";
//echo $this->sincifrar($model->fra_sede_entrega);DIE;
$cadena= $this->sincifrar($model->fra_sede_entrega);

$parte1=explode('(',$cadena);
$parte2=explode(')',$parte1[1]);
$parentesis= $parte2[0];
//echo $parentesis;die;
$correo=$this->sincifrar($model->fra_email);
//$correo="oscar.quintero@tigoune.com";
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
$mail->SetFrom("Noreplytigo@TigoUne.com", 'Registro de regalos y Atenciones');
$mail->Subject  = "Registro de regalos y Atenciones";




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
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-fra.jpg" ></td></tr>
<tr><td class="sombra">
<table border="1" width="80%" align="center"><tr><td colspan="2"><b>Radicado: '. $model->fra_radicado.'</b></td><td>Fecha de Registro: '.$model->fechacreacion.'</td></tr>
<tr><td><b>Nombre colaborador:</b></td><td>'. $this->sincifrar($model->fra_nombre).'</td><td><b>Identificación:</b>'. $this->sincifrar($model->fra_identificacion).'</td></tr>
<tr><td><b>Proveedor que da el regalo:</b></td><td colspan="2"> '. $this->sincifrar($model->fra_nombre_prov).'</td></tr>
<tr><td><b>Regalo Entregado:</b></td><td colspan="2"></b> '. $this->sincifrar($model->fra_regalo).'</td></tr>
<tr><td><b>Sede donde se entrega regalo:</b></td><td colspan="2">'.$this->sincifrar($model->fra_sede_entrega).'</td></tr>
<tr><td><b>Observaciones:</b></td><td colspan="2"> '.$this->sincifrar($model->fra_detalle_regalo).'</td></tr>
</table>
</td></tr></table></div></body></html>';
//echo $body;DIE;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $correo;
$mail->AddAddress($address, "Sarlaft");
$mail->AddCC($user);
$mail->AddCC($parentesis);
           		
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
	El registro realizado por <b><?php echo $this->sincifrar($model->fra_nombre); ?></b> ha sido enviada correctamente con el número de radicado <b><?php echo $model->fra_radicado; // $this->sincifrar($model->fra_radicado); ?></b>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('fra_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->fra_radicado), array('view', 'id'=>$model->fra_radicado)); ?>
	
	<br />
	-->
	
</div>