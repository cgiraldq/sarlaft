<?php
/*echo "<pre>";
var_dump($model);
echo "</pre>";*/

/* @var $this MvcUsersController */
/* @var $data MvcUsers */

	$correo='eventosypatrocinios@tigoune.com';				
				
	  //$correo="Cristian.C.Giraldo@asesor.une.com.co";
//$correo="cristian.giraldo90@gmail.com";

$host = '200.13.249.167';
$user = 'registroune@une.net.co';
$pass='9000923859';

Yii::import('ext.phpmailer.JPhpMailer');

$mail = new JPhpMailer;
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = $host;
$mail->SMTPAuth   = false;
$mail->Username   = $user; // SMTP account username
$mail->Password   = $pass;        // SMTP account password
$mail->SetFrom("Noreplytigo@TigoUne.com", 'Formulario de Eventos Y patrocinios');
$mail->Subject    = "Solicitud Eventos y Patrocinios";

if($this->sincifrar($model->fep_email)!=""){

	
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
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-fep.jpg" ></td></tr>
<tr><td class="sombra">Hola, Te confirmamos que la solicitud realizada a través del <b>Formulario de Eventos y Patrocinios de Tigo</b>, ha sido 
recibida correctamente por el área de Eventos y Patrocinios con radicado  No.<b>'. $model->fep_radicado.'</b>.  
<br><br>Prontamente te estaremos dando respuesta.</td></tr></table></div></body></html>';
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
//echo $this->sincifrar($model->fep_email);
$address = $this->sincifrar($model->fep_email);
$mail->AddAddress($address, "Solicitud Eventos y Patrocinios");
//$mail->AddCC('person1@domain.com', 'Person One');
//echo $body;

	if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";die;

 $mail2 = new JPhpMailer;
$mail2->IsSMTP(); // telling the class to use SMTP
$mail2->Host       = $host;
$mail2->SMTPAuth   = false;
$mail2->Username   = $user; // SMTP account username
$mail2->Password   = $pass;        // SMTP account password
$mail2->SetFrom("Noreplytigo@TigoUne.com", 'Formulario de Eventos Y patrocinios');
$mail2->Subject    = "Solicitud Eventos y Patrocinios";


   $body2  = '<html><body>
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
		
		a{
			color: #003281;
			text-decoration: none;
		}
  </style>
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-fep.jpg" ></td></tr>
<tr><td class="sombra">
<table border="0" width="80%" align="center"><tr><td><b>Radicado: </b>'. $model->fep_radicado.'</td><td><b>Fecha de Registro:</b>&nbsp;&nbsp;'. date('Y-m-d').'</td></tr>
<tr><td><b>Razon Social:</b></td><td>'. $this->sincifrar($model->fep_razon_social).'</td><td><b>NIT:</b>'. $this->sincifrar($model->fep_nit).'</td></tr>
<tr><td><b>Fecha del Evento:</b></td><td colspan="2">'. $model->fep_fecha_ini_even.'</td></tr>
<tr><td><b>Descripción de la Solicitud: </b></td><td colspan="2">'. $this->sincifrar($model->fep_descripcion_soli).'</td></tr>
</table><br>
<center><h3><a style="" href="https://'.$_SERVER['HTTP_HOST'].'/index.php?r=fep/formulario/create&st=1&id='.$model->fep_id.'">Revisar Solicitud</a></h3></center>
</td></tr></table>
</div></body></html>';
//echo $body2;die;
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail2->MsgHTML($body2);
$address2 = $correo;
$mail2->AddAddress($address2, "Eventos y Patrocinios Tigo");


$mail2->Send();

}
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
	La solicitud realizada por <b><?php echo $this->sincifrar($model->fep_razon_social); ?></b> ha sido enviada correctamente con el número de radicado <b><?php echo $model->fep_radicado; // $this->sincifrar($model->fep_radicado); ?></b>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('fep_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->fep_radicado), array('view', 'id'=>$model->fep_radicado)); ?>
	
	<br />
	-->
	
</div>
