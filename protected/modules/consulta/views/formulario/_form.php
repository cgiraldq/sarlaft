<?php

	/* @var $this FormularioController */
	/* @var $model Formulario */
	/* @var $form CActiveForm */
	
					$objmodel=new validar_usuario();
	$validar=$objmodel->FindByAttributes(array('login_usuario'=>$_SESSION['login_user_consulta']));
	/*echo "<pre>";
	var_dump($validar);
	echo "</pre>";*/
	
	
	 $resultado=sizeof($validar);
	// $_SESSION['resultado']=$resultado;

	
	

	if(isset($_SESSION['login_user_consulta']) && isset($resultado)){	
	$user_log=$_SESSION['login_user_consulta'];
	

?>
<style>
#button
{
	height: auto;
	top:20px;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 2px;
	padding-bottom: 2px;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
/*	position: relative;
	float: left;
	margin-left: 1%;*/
	box-shadow: none;
	background-color: #f5f5f5;
	background-image: -webkit-linear-gradient(top,#f5f5f5,#f1f1f1);
	background-image: -moz-linear-gradient(top,#f5f5f5,#f1f1f1);
	background-image: -ms-linear-gradient(top,#f5f5f5,#f1f1f1);
	background-image: -o-linear-gradient(top,#f5f5f5,#f1f1f1);
	background-image: linear-gradient(top,#f5f5f5,#f1f1f1);
	color: #444;
	border: 1px solid #dcdcdc;
	border: 1px solid rgba(0,0,0,0.1);
}

#button:hover {
  background: #b8b8b8;
  color: #fff;
  text-decoration: none;
  cursor: pointer;
}




</style>
	<?php	

	$formatos_validos = str_replace(',','|',$row_parametros[0]['par_formatos_validos']);
	
		$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
	//	$wsdl = "http://unevm-tmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$wsdl = "http://unevm-pmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//Se reaaliza conexión con ws y se trae información de acuerdo al pedido pasado en el parametro
		$client = new SoapClient($wsdl);
		$parametros = array(
			'login' => $user_log,
			'password' => $_SESSION['password'],
			'dominio' => '',
			'aplicacion' => 'Sarlaft',
			'password_app' => 'sarlaft2015'			
		);
			//var_dump($parametros);die;
		//":{"login":1,"password":2,"aplicacion":"webapp","password_app":"b6920d9083c8e76685bcc8db34b8c9bb
	
		try {
			 $response = $client->AutenticarMultiplesDA($parametros);
			$response = json_decode($response->Mensaje,true);
			// echo "<pre>";
			//var_dump($response);
		} catch (SoapFault $exception) {
			$msjauth = "Falla al cargar el usuario";
		}
		
		$filial=array("epmtelco.com.co","etp.corp","epmcc-pob.com","colombiamovil.corp","osi.local","edatel.com.co");
		//var_dump($filial);
		//echo sizeof($filial);
		//echo $response["wsResponse"][$user_log]["epmtelco.com.co"][0]["code"];
		for($i=0;$i<=sizeof($filial);$i++){
	//echo $filial[$i];
	if($response["wsResponse"][$user_log][$filial[$i]][0]["code"]==1){
	 $dominio=$filial[$i];
	break;
	}
	
	}

	
	
	
		// Se definen los parametros válidos para archivos adjuntos
		$formatos_validos = str_replace(',','|',$row_parametros[0]['par_formatos_validos']);
	
		$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$wsdl = "http://unevm-tmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$wsdl = "http://unevm-pmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$options = array("login" => _USERWSAGE_, "password" => _PASSWORDWSAGE_);	

		//Se reaaliza conexión con ws y se trae información de acuerdo al pedido pasado en el parametro
		$client = new SoapClient($wsdl);
		$parametros = array(
			'palabra_clave' => $user_log,
			'atributo_filtro' => 'samaccountname',
			'atributos_retorna' => 'extensionattribute15,title,department,mail,employeeid,postalCode,description,l,cn,telephoneNumber,company',
			'dominio' => $dominio,
			'coincidencias' => 'false',
			'estado_usuario' => 'false',
			'grupos_usuario' => 'false',
			'aplicacion' => 'Sarlaft',
			'password_app' => 'sarlaft2015'			
		);
		
			//var_dump($parametros);
		//":{"login":1,"password":2,"aplicacion":"webapp","password_app":"b6920d9083c8e76685bcc8db34b8c9bb
	
		try {
			 $response = $client->BuscarAtributosDA($parametros);
			$response = json_decode($response->Mensaje,true);
			/*echo "<pre>";
			var_dump($response);
			echo "</pre>";*/
		} catch (SoapFault $exception) {
			$msjauth = "Falla al cargar el usuario";
		}
		
		
				$vicepresidencia = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["extensionattribute15"][0];
		$area = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["department"][0];
		$cargo = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["title"][0];
		$empresa = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["company"][0];
			
			if($dominio=="colombiamovil.corp" ){
			$employeeid="description";
				}elseif($dominio=="etp.corp"){
						$employeeid="description";
						
							$datos=$response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["dn"];
						$datosarr=explode(",OU=",$datos);
						$vicepresidencia=$datosarr[2];
						$area=$datosarr[1];
						if($empresa==""){
						$empresa="ETP";
						}
						//var_dump($datosarr);
				
					
			}elseif($dominio=="edatel.com.co" || $dominio=="epmcc-pob.com"){
			$employeeid="postalcode";
			}else{
			$employeeid="employeeid";
			}
			
			
	
			
		 $nombre = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["cn"][0];
		$ciudad = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["l"][0];

		//$tipoIdentificacion = "1";
		$identificacion = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0][$employeeid][0];
		$email = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["mail"][0];
		
		$telefono = $response["wsResponse"][""][$dominio][0][$user_log]["entries"][0]["telephonenumber"][0];
		
	// $obj = new stdObject();
	// $obj = $response;
		// print_r($obj);
	?>

	
	
	
	<div class="form">
	

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'consulta-form',
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); 

	echo '<h4>Servicios de consulta Sarlaft</h4>';?>
	
	<?php if(isset($msjauth) && $msjauth!="")
	echo '<div class="errorSummary">'.$msjauth.'</div>';

	if(isset($_GET['env']) && $_GET['env']!="0")
		echo '<div class="okMessage">La consulta de '.$_GET['env'].' registro(s) se envió correctamente! 
</div>';		

	if(isset($_GET['msj']) && $_GET['msj']!="0")
		echo '<div class="errorMessage">'.$_GET['msj'].'</div>';		

	?>
	
	<table width="98%" border="0" cellspacing="1" cellpadding="1"><tbody><tr><td width="33%" align="left"><div><?php setlocale(LC_ALL,"es_ES"); echo utf8_encode(ucfirst(strftime("%A %d de %B del %Y"))); ?></div></td><td width="33%" align="center" style="text-align:center !important;"></td><td width="33%" align="right" style="text-align:right !important;"><a href="index.php?r=consulta/formulario/create&logout_user=1">Cerrar sesión</a></td></tr></tbody></table>

	<br />
	<div align="justify">La consulta de coincidencias retorna los resultados de los últimos registros enviados por medio de este formulario,<br>
		Los resultados obtenidos estarán disponibles 15 minutos despues de haber ingresado su consulta.	</div>
		
	<br>
	<input type="radio"  name="consulta" id="c_ind" value="c_ind">Consulta Individual
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio"  name="consulta" id="c_masv" value="c_masv">Consulta Masiva
			 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<span id="button" onclick="window.location.href='index.php?r=consulta/formulario/consulta&st=1'"> Consultar coincidencias</span>
	<br>
	<div id="individual">
	<br>
	<div align="justify">Ingrese uno de los siguientes campos para enviar su consulta y seleccione el grupo de intéres.</div>
	<br>
	<div class="row">
		<?php echo $form->labelEx($model,'consulta_identificacion_persona'); ?>
		<?php echo $form->textField($model,'consulta_identificacion_persona',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'consulta_identificacion_persona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'consulta_nombre_persona'); ?>
		<?php echo $form->textField($model,'consulta_nombre_persona',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'consulta_nombre_persona'); ?>
	</div>
	<div class="row"><?php echo $form->labelEx($model,'grupo_interes'); ?>
		<select name="grupo_interes" >
<option value="Empleados">Empleados</option>
<option value="Proveedores">Proveedores</option>
<option value="Aliados">Aliados</option>
<option value="Clientes">Clientes</option>
<option value="Acreedores">Acreedores</option>
<option value="Accionistas">Accionistas</option>
<option value="Inversionistas">Inversionistas</option>
<option value="otros">Otros</option>
		</select>
	  </div>
	  	<div class="row buttons">
		<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('autocomplete'=>'false' ) ); ?>
	</div>

</div>

	<div  id="archivo"><br>
	<div class="row">

	<div align="justify">Seleccione un archivo con extension .txt con el siguien formato:<br><b>identificación,nombre,grupo_de_interes</b></div>
	<br>
	<img src="http://d-sarlaft.une.com.co/images/prueba.gif">
	<br>
	<br>
		<?php echo $form->labelEx($model,'farchivo'); ?>
		<?php echo $form->fileField($model,'farchivo',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'farchivo'); ?>
	</div>
	
		<div class="row buttons">
		<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('autocomplete'=>'false' ) ); ?>
	</div>

	</div>
	<style>
	#archivo{
	display: none;
	}
	
#individual{
	display: none;
	}

	</style>
	<script>
	$(document).ready(function() {
        
        //lista de gerencia que al seleccionar carga la lista de frente (Equipo)-- pestaña "por Responsables"
        $("#c_masv").click(function() {
		$("#individual").slideUp();
		$("#archivo").slideDown();
		});
		
		$("#c_ind").click(function() {
		$("#archivo").slideUp();
		$("#individual").slideDown();
		});

		
		});
	</script>


	<?php echo $form->hiddenField($model,'consulta_estado_id',array('value'=>1)); ?>

	<?php echo $form->hiddenField($model,'consulta_usuario_id',array('value'=>1)); ?>
	
		
	<?php $this->endWidget(); ?>
	
	</div><!-- form -->

<?php
	


	}else
	{

/*if($resultado==0 && $msjauth==""){
$msjauth=="No tiene permisos suficientes para igresar!";
}*/
?>
	
		<div class="form">
		

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'consulta-form',
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); 
		
?>

		<div class="row-fluid">
			<!-- block -->
			<div class="block">
				<form method="post" action="" id="loginForm" name="loginForm" class="form-vertical" autocomplete="off">
					<div class="span12">
						<fieldset>
							<legend style="text-align: center;"><h3>Autenticación</h3></legend>
							<?php
								if(isset($msjauth) && $msjauth!="")
									echo '<div class="errorSummary" style="text-align:center !important">'.$msjauth.'</div>';
							?>
							<div class="control-group">
								<label for="focusedInput" class="control-label" style="text-align:right !important;"></label>
								<div class="controls">
								<input type="text" id="username" name="username" placeholder="Nombre de usuario" class="input-xlarge focused" style="text-align:center;">	                                                
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" style="text-align:right !important;"></label>
								<div class="controls">
								<input type="password" id="password" name="password" placeholder="Contraseña" class="input-xlarge focused" style="text-align:center;">                                            
								</div>
							</div>
							 <div class="control-group">
							 <div class="controls"></div>
							</div>
							<div class="control-group">
								<div class="controls">
									<input type="hidden" id="loginForm" name="loginForm" value="1">
									<center><button name="yt0" type="submit" id="yw0" class="btn btn-danger">Autenticar</button></center>
								</div>
							</div>
						</fieldset>
					</div>
				</form>
			</div>
			<!-- /block -->
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->					
<?php			
	}
?>
