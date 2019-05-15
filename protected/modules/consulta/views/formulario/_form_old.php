<?php
	/* @var $this FormularioController */
	/* @var $model Formulario */
	/* @var $form CActiveForm */

	if(isset($_SESSION['login_user_consulta'])){	
	$user_log=$_SESSION['login_user_consulta'];
?>

	<?php	
		// Se definen los parametros válidos para archivos adjuntos
		$formatos_validos = str_replace(',','|',$row_parametros[0]['par_formatos_validos']);
	
		$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$options = array("login" => _USERWSAGE_, "password" => _PASSWORDWSAGE_);	

		//Se reaaliza conexión con ws y se trae información de acuerdo al pedido pasado en el parametro
		$client = new SoapClient($wsdl);
		$parametros = array(
			'palabra_clave' => $_SESSION['login_user_consulta'],
			'atributo_filtro' => 'samaccountname',
			'atributos_retorna' => 'mail,employeeid,l,cn,telephoneNumber,company',
			'dominio' => 'epmtelco.com.co',
			'coincidencias' => 'false',
			'estado_usuario' => 'false',
			'grupos_usuario' => 'false',
			'aplicacion' => 'Sarlaft',
			'password_app' => 'sarlaft2015'			
		);
			//var_dump($parametros);die;
		//":{"login":1,"password":2,"aplicacion":"webapp","password_app":"b6920d9083c8e76685bcc8db34b8c9bb
	
		try {
			 $response = $client->BuscarAtributosDA($parametros);
			$response = json_decode($response->Mensaje,true);
			// echo "<pre>";
			//var_dump($response);
		} catch (SoapFault $exception) {
			$msjauth = "Falla al cargar el usuario";
		}
			
		 $nombre = $response["wsResponse"][""]["epmtelco.com.co"][0][$user_log]["entries"][0]["cn"][0];
		$ciudad = $response["wsResponse"][""]["epmtelco.com.co"][0][$user_log]["entries"][0]["l"][0];
		//$tipoIdentificacion = "1";
		$identificacion = $response["wsResponse"][""]["epmtelco.com.co"][0][$user_log]["entries"][0]["employeeid"][0];
		$email = $response["wsResponse"][""]["epmtelco.com.co"][0][$user_log]["entries"][0]["mail"][0];
		$empresa = $response["wsResponse"][""]["epmtelco.com.co"][0][$user_log]["entries"][0]["company"][0];
		$telefono = $response["wsResponse"][""]["epmtelco.com.co"][0][$user_log]["entries"][0]["telephonenumber"][0];
		
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

	echo '<h4>Servicios de consulta Sarlaft</h4>';
	
	if(isset($msjauth) && $msjauth!="")
		echo '<div class="errorSummary">'.$msjauth.'</div>';

	if(isset($_GET['env']) && $_GET['env']=="1")
		echo '<div class="okMessage">La consulta se registró correctamente </div>';		
	?>

	<table width="98%" border="0" cellspacing="1" cellpadding="1"><tbody><tr><td width="33%" align="left"><div><?php setlocale(LC_ALL,"es_ES"); echo utf8_encode(ucfirst(strftime("%A %d de %B del %Y"))); ?></div></td><td width="33%" align="center" style="text-align:center !important;"><a href="index.php?r=consulta/formulario/consulta&st=1">Consultar coincidencias</a></td><td width="33%" align="right" style="text-align:right !important;"><a href="index.php?r=consulta/formulario/create&logout_user=1">Cerrar sesión</a></td></tr></tbody></table>

	<br />
	<div align="justify">La consulta de coincidencias retorna los resultados de los últimos registros enviados por medio de este formulario</div>
	
	<br />
	<div align="justify">Ingrese uno de los siguientes campos para enviar su consulta.</div>
	
	<br />
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


	<?php echo $form->hiddenField($model,'consulta_estado_id',array('value'=>1)); ?>

	<?php echo $form->hiddenField($model,'consulta_usuario_id',array('value'=>1)); ?>
	
	<div class="row buttons">
		<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Consultar' : 'Save', array('autocomplete'=>'false' ) ); ?>
	</div>
		
	<?php $this->endWidget(); ?>

	</div><!-- form -->
<?php
	}
	else
	{
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
								<label for="focusedInput" class="control-label" style="text-align:right !important;">Usuario: </label>
								<div class="controls">
								<input type="text" id="username" name="username" placeholder="Nombre de usuario" class="input-xlarge focused" style="text-align:center;">	                                                
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" style="text-align:right !important;">Contraseña</label>
								<div class="controls">
								<input type="password" id="password" name="password" placeholder="Contraseña" class="input-xlarge focused" style="text-align:center;">                                            
								</div>
							</div>
							 <div class="control-group">
								<label class="control-label"> &nbsp; </label>
								<div class="controls"></div>
							</div>
							<div class="control-group">
								<div class="controls">
									<input type="hidden" id="loginForm" name="loginForm" value="1">
									<button name="yt0" type="submit" id="yw0" class="btn btn-danger">Autenticar</button>
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