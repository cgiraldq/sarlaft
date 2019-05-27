<?php

	/* @var $this FormularioController */
	/* @var $model Formulario */
	/* @var $form CActiveForm */

	if(isset($_SESSION['login_user'])){	
	$user_log=strtolower($_SESSION['login_user']);
	
?>

	<?php	
	
	
	$formatos_validos = str_replace(',','|',$row_parametros[0]['par_formatos_validos']);
	
		$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$wsdl = "http://unevm-tmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
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
		if($dominio=="epmtelco.com.co"){$cod_emp=2;}elseif($dominio=="etp.corp"){$cod_emp=4;}
	elseif($dominio=="epmcc-pob.com"){$cod_emp=38;}elseif($dominio=="colombiamovil.corp"){$cod_emp=1;}
	elseif($dominio=="osi.local"){$cod_emp=3;}elseif($dominio=="edatel.com.co"){$cod_emp=5;}
	break;
	}
	
	}

	
	
	
		// Se definen los parametros válidos para archivos adjuntos
		$formatos_validos = str_replace(',','|',$row_parametros[0]['par_formatos_validos']);
	
		$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$wsdl = "http://unevm-tmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$wsdl = "http://unevm-pmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$options = array("login" => _USERWSAGE_, "password" => _PASSWORDWSAGE_);	

		//$user_log='fimelzap';$dominio='epmtelco.com.co';//Se reaaliza conexión con ws y se trae información de acuerdo al pedido pasado en el parametro
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
			//var_dump($parametros);die;
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
		 
		/* echo "<pre>";
			var_dump($nombre);
			echo "</pre>";*/
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
		'id'=>'fce-form',
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); 


	if(isset($msjauth) && $msjauth!="")
		echo '<div class="errorSummary">'.$msjauth.'</div>';
		
	?>


		<table width="98%" border="0" cellspacing="1" cellpadding="1"><tbody><tr><td width="50%" align="left"><div><?php setlocale(LC_ALL,"es_ES"); echo utf8_encode(ucfirst(strftime("%A %d de %B del %Y"))); ?></div></td><td width="50%" align="right" style="text-align:right !important;"><a href="index.php?r=fce/formulario/create&logout_user=1">Cerrar sesión</a></td></tr></tbody></table>
		
		<!--<div><?php echo $nombre; ?>, Certifico haber recibido, leído y comprendido el Código de Ética y me obligo a cumplir con sus términos y condiciones.</div>
		<br />
		<div><a href="http://www.tigo-une.com/compliance/wp-content/uploads/2015/04/ManualConflicto-de-Intereses2.pdf" target="_blank">Click aquí para ver el manual</a></div>-->

				<br />
		<!--<div align="justify"><b>Un Conflicto de Intereses</b>, hace referencia a toda situación en la que los intereses personales, directos o indirectos, de los miembros de la Junta Directiva, de la administración o de los colaboradores de Tigo o sus familiares, <b>pueden estar enfrentados con los de la Compañía</b>, o en alguna medida <b>interfieren con sus deberes</b> y motivan un actuar contrario al recto cumplimiento de sus obligaciones laborales. Estas situaciones en las que se contraponen los intereses personales a los intereses organizacionales, <b>pueden llegar a generar un beneficio económico, político o comercial a una de las partes</b>, ocasionando un desequilibrio con la otra, o incluso pueden llegar a generar una <b>falta de integridad</b> en la(s) compañía(s); afectando la <b>transparencia, equidad y responsabilidad</b> organizacional.</div>-->
		
		<div align="justify">Yo <b><?php echo $nombre; ?></b>,  Certifico haber recibido, leído y comprendido el <b>Código de Ética</b> y me obligo a cumplir con sus términos y condiciones.</div>
		
		<br />
		
		<?php 
			$chkd_certifica = ""; $chkd_no_certifica = "";
			$chkd_declara = ""; $chkd_no_declara = "";
			if(isset($_POST['certifica']) && $_POST['certifica'] == 'si') { 
				$chkd_certifica = ' checked="checked"';
			} elseif(isset($_POST['certifica']) && $_POST['certifica'] == 'no') {
				$chkd_no_certifica = ' checked="checked"';
			}
			
			if(isset($_POST['declara']) && $_POST['declara'] == 'si') { 
				$chkd_declara = ' checked="checked"';
			} elseif(isset($_POST['declara']) && $_POST['declara'] == 'no') {
				$chkd_no_declara = ' checked="checked"';
			}
		?>
		
		<br />


	
		
		
		
			<!--
			<br />
			<div class="note">Favor diligenciar los siguientes datos. (Los campos con <span class="required">*</span> son obligatorios)</div>  
			-->
			
			<?php // echo $form->errorSummary(array($model, $model_persona));
				  $html=CHtml::errorSummary($model);
				  if($html!=='') echo '<br /><div class="errorSummary">Por favor corrija los errores en los campos indicados</div>';
			?>

				
			
					<div class="row">
				<?php echo $form->labelEx($model,'fce_identificacion_persona'); ?>
				<?php echo $form->textField($model,'fce_identificacion_persona',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$identificacion)); ?>
				<?php echo $form->error($model,'fce_identificacion_persona'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'fce_nombre_persona'); ?>
				<?php echo $form->textField($model,'fce_nombre_persona',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$nombre)); ?>
				<?php echo $form->error($model,'fce_nombre_persona'); ?>
			</div>

						<div class="row">
				<?php echo $form->labelEx($model,'fce_empresa_id'); ?>
				<?php echo $form->textField($model,'fce_empresa_id',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$empresa)); ?>
				<?php echo $form->error($model,'fce_empresa_id'); ?>
			</div>
			
						<div class="row">
				<?php echo $form->labelEx($model,'fce_vicepresidencia'); ?>
				<?php echo $form->textField($model,'fce_vicepresidencia',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$vicepresidencia)); ?>
				<?php echo $form->error($model,'fce_vicepresidencia'); ?>
			</div>
			
						<div class="row">
				<?php echo $form->labelEx($model,'fce_area'); ?>
				<?php echo $form->textField($model,'fce_area',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$area)); ?>
				<?php echo $form->error($model,'fce_area'); ?>
			</div>
			
	

			<div class="row">
				<?php echo $form->labelEx($model,'fce_cargo'); ?>
				<?php echo $form->textField($model,'fce_cargo',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$cargo)); ?>
				<?php echo $form->error($model,'fce_cargo'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'fce_email'); ?>
				<?php echo $form->textField($model,'fce_email',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$email)); ?>
				<?php echo $form->error($model,'fce_email'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'fce_telefono'); ?>
				<?php echo $form->textField($model,'fce_telefono',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$telefono)); ?>
				<?php echo $form->error($model,'fce_telefono'); ?>
			</div>

			<!--
			<div class="row">
				<?php //echo $form->labelEx($model,'fce_pais_id'); ?>
				<?php //echo $form->dropDownList($model,'fce_pais_id',CHtml::listData(Pais::model()->findAll(array('order'=>'pai_nombre')), 'pai_id', 'pai_nombre'), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectdepartamento'),'update'=>'#'.CHtml::activeId($model,'fce_departamento_id'), 'beforeSend'=>'function() { $("#Formulario_fce_departamento_id").find("option").remove(); $("#Formulario_fce_ciudad_id").find("option").remove(); }' ), 'prompt' => '--Seleccione--' )); ?>
				<?php //echo $form->error($model,'fce_pais_id'); ?>
			</div>

			<div class="row">
				<?php //echo $form->labelEx($model,'fce_departamento_id'); ?>
				<?php //echo $form->dropDownList($model,'fce_departamento_id',array(), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectciudad'),'update'=>'#'.CHtml::activeId($model,'fce_ciudad_id'), 'beforeSend'=>'function(){ $("#Formulario_fce_ciudad_id").find("option").remove(); }' ))); ?>
				<?php //echo $form->error($model,'fce_departamento_id'); ?>
			</div>
			-->

			<div class="row">
				<?php echo $form->labelEx($model,'fce_ciudad_id'); ?>
				<?php //echo $form->dropDownList($model,'fce_ciudad_id',array(), array('empty'=>'')); ?>
				<?php echo $form->textField($model,'fce_ciudad_id',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$ciudad)); ?>
				<?php echo $form->error($model,'fce_ciudad_id'); ?>
			</div>

			<!--<br />
			<div>Declaro tener conocimiento del Manual de Conflicto de Intereses y las situaciones que se consideran como tal y de la necesidad de informar cualquier situación que pueda ser fuente de un posible conflicto de interés, razón por la cual declaro:</div>
			
			<br />
			<div>
				<input type="radio" name="declara" id="nodeclara" value="no" <?php echo $chkd_no_declara; ?> /> No poseer situaciones a informar como posible Conflictos de Intereses
				<br /><br />
				<input type="radio" name="declara" id="sideclara" value="si" <?php echo $chkd_declara; ?> /> Declaro que las siguiente (s) situación(es) que expongo a continuación podría ser consideradas eventualmente como Posible Conflictos de Interés
			</div>

			<br />
			
			<div id="form_no_tiene_conflicto">
				<div>Favor dar clic en el siguiente botón enviar para consignar su respuesta</div>
			</div>	-->
			<!-- ------------------------------------------------------ -->

			<br />	<br>
					<div>
			Certifico que he leído y comprendido el Código de Ética.  &nbsp; &nbsp; &nbsp; &nbsp;
			</br><input type="radio"  name="certifica" id="sicertifica" value="si" <?php echo $chkd_certifica; ?> /> SI 
			 &nbsp; &nbsp; &nbsp; 
			<input type="radio"  name="certifica" id="nocertifica" value="no" <?php echo $chkd_no_certifica; ?> /> NO 
		</div>
			<div id="msj_nocertifica">
			<br />
			<div>Para poder continuar con el formulario debe certificar haber recibido, leído y comprendido el Código de Ética.</div>
		</div>
			<!-- ------------------------------------------------------ -->

			
			
		
			
			<?php echo $form->hiddenField($model,'fce_radicado',array('value'=>0)); ?>
			
			<?php //echo $form->hiddenField($model,'fce_ciudad_id',array('value'=>1)); ?>
			
			<?php echo $form->hiddenField($model,'fce_empresa_id',array('value'=>$cod_emp)); ?>
			
			<?php //echo $form->hiddenField($model,'fce_tipo_identificacion_id',array('value'=>0)); ?>
			
			<?php //echo $form->hiddenField($model,'fce_prueba',array('value'=>0)); ?>

			<?php echo $form->hiddenField($model,'fce_estado_id',array('value'=>1)); ?>

			<?php echo $form->hiddenField($model,'fce_usuario_id',array('value'=>1)); ?>
			
			<div id="submit_form">
				<br>
				<div id="mc">
					<div>Por favor dibuje la figura en el recuadro para activar el envío del formulario</div></br></br>
					<canvas id="mc-canvas">
					Su navegador no soporta el plugin de captcha que usamos para garantizar la seguridad del sitio y de sus datos. Por favor visítenos desde otro navegador.
					</canvas>
					<input type="hidden" id="mc-action" value=""/>
				</div>

				<center><div class="row buttons">
					<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('disabled'=>'disabled', 'autocomplete'=>'false' ) ); ?>
				</div></center>
			
			</div>

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
			'id'=>'fce-form',
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
							<legend style="text-align: center;"><h3>Autenticación</h3><span style="font-size: 12px; ">Ingresa tu usuario y contraseña de red.</span></legend>
							<?php
								if(isset($msjauth) && $msjauth!=""){
									echo '<div class="errorSummary" style="text-align:center !important">'.$msjauth.'</div>';
									}
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
