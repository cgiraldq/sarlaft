<?php
/*echo "<pre>";
var_dump($row_parametros);
echo "</pre>";*/

/* @var $this MvcUsersController */
/* @var $data MvcUsers */

	$correo='eventosypatrocinios@tigoune.com';				
				
	// $correo="Cristian.C.Giraldo@asesor.une.com.co";

$host = '200.13.249.167';
$user = 'registroune@une.net.co';
$pass='9000923859';

Yii::import('ext.phpmailer.JPhpMailer');


 $mail2 = new JPhpMailer;
$mail2->IsSMTP(); // telling the class to use SMTP
$mail2->Host       = $host;
$mail2->SMTPAuth   = false;
$mail2->Username   = $user; // SMTP account username
$mail2->Password   = $pass;        // SMTP account password
$mail2->SetFrom("eventosypatrocinios@tigoune.com", 'Formulario de Eventos Y patrocinios');
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
Se ha hecho un comentario por parte del usuario <b>'.$_REQUEST["user"].'</b>, miembro del comite de Eventos y patrocinios Tigo-Une a la solicitud con radicado:<b>'.$model->fep_radicado.'</b><br><br>
<table><tr><td><b>Aprobado: </b>'.$row_parametros[0].'</td></tr>

<tr><td><b>Comentarios: </b>'.$row_parametros[1].'</td></tr></table>
</td></tr>

</div></body></html>';
//echo $body2;die;
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail2->MsgHTML($body2);
$address2 = $correo;
$mail2->AddAddress($address2, "Eventos y Patrocinios Tigo");


$mail2->Send();




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
	<b><?php echo $_REQUEST["user"]; ?></b>,Su Evaluación a la solicitud con radicado <b><?php echo $model->fep_radicado; ?></b>, ha sido enviada correctamente.<br><br>
	
	<table><tr><td><b>Aprobado: </b><?php echo $row_parametros[0]; ?></td><td><b>Comentarios: </b><?php echo $row_parametros[1]; ?></td></tr></table>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('fep_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->fep_radicado), array('view', 'id'=>$model->fep_radicado)); ?>
	
	<br />
	-->
	
</div>
