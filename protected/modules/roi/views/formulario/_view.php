<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */

if($model->for_grupo_interes_id==1){$grupo_int="Accionista";}elseif($model->for_grupo_interes_id==2){$grupo_int="Proveedor";}
elseif($model->for_grupo_interes_id==3){$grupo_int="Cliente";}elseif($model->for_grupo_interes_id==4){$grupo_int="Empleado";}

if($model->for_producto_id==1){$producto="Servicio Móvil";}elseif($model->for_producto_id==2){$producto="Servicio Cable";}
elseif($model->for_producto_id==3){$producto="Transacciones internas de la compañía";}elseif($model->for_producto_id==4){$producto="Compras";}

 if(($model->for_empresa_id)==38){
	$empresa="EMTELCO";
	 // $correo="Cristian.C.Giraldo@asesor.une.com.co";
	  $correo="sarlaft@emtelco.com.co";
 }else{
	 $empresa="TIGOUNE";
	 //$correo="Cristian.C.Giraldo@asesor.une.com.co";
	  $correo="sarlaft@une.com.co";
 }
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
$mail->SetFrom("Noreplytigo@TigoUne.com", 'formulario ROI');
$mail->Subject    = "Reporte Formulario ROI";

if($this->sincifrar($model->for_reportante_correo)!=""){
	$body  = 'Hola, Te confirmamos que el Reporte Operación Inusual (ROI), ha sido recibida correctamente por el equipo de Compliance con radicado No.'. $model->for_radicado;
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $this->sincifrar($model->for_reportante_correo);
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
$mail->SetFrom("Noreplytigo@TigoUne.com", 'Sarlaft (formulario ROI)');
$mail->Subject    = "Reporte Formulario ROI";

 $body  = 'Nuevo Reporte Operación Inusual (ROI) con radicado  No.'. $model->for_radicado.'<br><br>
<center><table border="1" style="border-radius: 10px; border: 1px solid gray; width: 50%;">
<tr><td><b>Empresa:</b></td><td>'.$empresa.'</td></tr>
<tr><td><b>Nombre:</b></td><td>'.$this->sincifrar($model->for_nombre_persona).'</td></tr>
<tr><td><b>Identificación:</b></td><td>'.$this->sincifrar($model->for_identificacion_persona).'</td></tr>
<tr><td><b>Grupo de Interés:</b></td><td>'.$grupo_int.'</td></tr>
<tr><td><b>Observación:</b></td><td>'.$this->sincifrar($model->for_observacion).'</td></tr>
<tr><td><b>Producto o Servicio Afectado:</b></td><td>'.$producto.'</td></tr>
</table><center>';
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $correo;
$mail->AddAddress($address, "Sarlaft");
//$mail->AddCC('person1@domain.com', 'Person One');

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  //echo "Message sent!";
}





 
?>

<div class="view">

	El reporte de <?php echo $this->sincifrar($model->for_nombre_persona); ?> con identificación <?php echo $this->sincifrar($model->for_identificacion_persona); ?> ha sido enviado correctamente con el número de radicado <?php echo $model->for_radicado; // $this->sincifrar($model->for_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('for_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->for_radicado), array('view', 'id'=>$model->for_radicado)); ?>
	<br />
	-->

</div>