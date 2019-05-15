<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
//echo $this->sincifrar($model->ifp_email);
//$correo="cristian.giraldo90@gmail.com";
//$correo="pasuaza@gmail.com";
 
$correo=$this->sincifrar($model->ifp_email);
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
$mail->SetFrom("Noreplytigo@TigoUne.com", 'Interacción con Funcionarios Públicos');
$mail->Subject  = "Interacción con Funcionarios Públicos";


$cadena =$model->ifp_proposito;
$propositos=preg_replace('(\[|\])', '', $cadena);
 $propositos=str_replace(',', ' - ', $propositos);

//var_dump($propositos);DIE;

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
  </head><div><table width="50%" align="center"><tr><td><img src="images/header-bg-ifp.jpg" ></td></tr>
<tr><td class="sombra">
<table border="1" width="80%" align="center"><tr><td><b>Radicado: </b></td><td>'. $model->ifp_radicado.'</td></tr>
<tr><td><b>Fecha de la reunión:</b></td><td>'.$model->ifp_fecha_reunion.'</td></tr>
<tr><td><b>Nombre de la entidad:</b></td><td>'.$model->ifp_entidad.'</td></tr>
<tr><td><b>Propósito de la reunión:</b></td><td>'.$propositos.'</td></tr>
<tr><td><b>Realizar una descripción de los temas tratados en la reunión:</b></td><td>'.$this->sincifrar($model->ifp_desc_temas).'</td></tr>
<tr><td><b>Si en el desarrollo de una reunión con cualquier funcionario público insinúa o se les ofrece algún acto indebido para manejar el contrato, detectan hechos o acciones relacionadas con soborno, corrupción, fraude, materialización de conflictos de interés, que involucran a la compañía o dar la apariencia de estar participando en política, se debe hacer el reporte de lo sucedido.</b></td><td>'.$this->sincifrar($model->ifp_reporte).'</td></tr>

</table>
</td></tr></table></div></body></html>';
//echo $body;die;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $correo;
$mail->AddAddress($address, "Sarlaft");
$mail->AddCC($user);
$mail->AddCC($model->ifp_jefe_inmediato);
           		
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
	El reporte de <?php echo $this->sincifrar($model->ifp_nombre); ?> ha sido enviado correctamente con el número de radicado <?php echo $model->ifp_radicado; // $this->sincifrar($model->ifp_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('ifp_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->ifp_radicado), array('view', 'id'=>$model->ifp_radicado)); ?>
	<br />
	-->
</div>