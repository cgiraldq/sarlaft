<?php

	/* @var $this FormularioController */
	/* @var $model Formulario */
	/* @var $form CActiveForm */

	if(isset($_SESSION['login_user'])){	
	$user_log=strtolower($_SESSION['login_user']);
	
?>

	<?php	
	
	
	$formatos_validos = str_replace(',','|',$row_parametros[0]['par_formatos_validos']);
	
		//$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$wsdl = "http://unevm-tmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		$wsdl = "http://unevm-pmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		$wsdl = "http://unevm-pmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
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
	
		//$wsdl = "http://unevm-dmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		//$wsdl = "http://unevm-tmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
		$wsdl = "http://unevm-pmap.une.net.co/ServicioAuth/ServicioWebAuth.php?wsdl";
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
		'id'=>'daa-form',
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


		<table width="98%" border="0" cellspacing="1" cellpadding="1"><tbody><tr><td width="50%" align="left"><div><?php setlocale(LC_ALL,"es_ES"); echo utf8_encode(ucfirst(strftime("%A %d de %B del %Y"))); ?></div></td><td width="50%" align="right" style="text-align:right !important;"><a href="index.php?r=daa/formulario/create&logout_user=1">Cerrar sesión</a></td></tr></tbody></table>
		
		<!--<div><?php echo $nombre; ?>, Certifico haber recibido, leído y comprendido el Código de Ética y me obligo a cumplir con sus términos y condiciones.</div>
		<br />
		<div><a href="http://www.tigo-une.com/compliance/wp-content/uploads/2015/04/ManualConflicto-de-Intereses2.pdf" target="_blank">Click aquí para ver el manual</a></div>-->

				<br />
		<!--<div align="justify"><b>Un Conflicto de Intereses</b>, hace referencia a toda situación en la que los intereses personales, directos o indirectos, de los miembros de la Junta Directiva, de la administración o de los colaboradores de TigoUne o sus familiares, <b>pueden estar enfrentados con los de la Compañía</b>, o en alguna medida <b>interfieren con sus deberes</b> y motivan un actuar contrario al recto cumplimiento de sus obligaciones laborales. Estas situaciones en las que se contraponen los intereses personales a los intereses organizacionales, <b>pueden llegar a generar un beneficio económico, político o comercial a una de las partes</b>, ocasionando un desequilibrio con la otra, o incluso pueden llegar a generar una <b>falta de integridad</b> en la(s) compañía(s); afectando la <b>transparencia, equidad y responsabilidad</b> organizacional.</div>-->
		
		<div align="justify">El soborno consiste en ofrecer, prometer, dar, aceptar o solicitar una contraprestación económica o de otro tipo, con el fin de obtener ventaja de índole comercial, contractual, reglamentaria o personal.<br><br>            

En TigoUne estamos comprometidos con un actuar ético y transparente ante nuestros grupos de interés, por ello promovemos la gestión de la Compañía bajo la filosofía de la Cero Tolerancia, evitando actos que contraríen los principios organizacionales.<br><br>
                                                                                                                                              
Te invitamos a conocer la Política de Anticorrupción y Antisoborno, y a realizar la siguiente declaración.<br><br>

<a href="http://tigo-une.com/compliancetigoune/wp-content/pdf/politica_anticorrupcion-y-antisoborno.pdf" target="_blank">click aquí para ver la política.</a>
</div>
		
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
				<?php echo $form->labelEx($model,'daa_identificacion'); ?>
				<?php echo $form->textField($model,'daa_identificacion',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$identificacion)); ?>
				<?php echo $form->error($model,'daa_identificacion'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'daa_nombre'); ?>
				<?php echo $form->textField($model,'daa_nombre',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$nombre)); ?>
				<?php echo $form->error($model,'daa_nombre'); ?>
			</div>

	
			
						<div class="row">
				<?php echo $form->labelEx($model,'daa_vicepresidencia'); ?>
				<?php echo $form->textField($model,'daa_vicepresidencia',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$vicepresidencia)); ?>
				<?php echo $form->error($model,'daa_vicepresidencia'); ?>
			</div>
			
						<div class="row">
				<?php echo $form->labelEx($model,'daa_area'); ?>
				<?php echo $form->textField($model,'daa_area',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$area)); ?>
				<?php echo $form->error($model,'daa_area'); ?>
			</div>
			
	

			<div class="row">
				<?php echo $form->labelEx($model,'daa_cargo'); ?>
				<?php echo $form->textField($model,'daa_cargo',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$cargo)); ?>
				<?php echo $form->error($model,'daa_cargo'); ?>
			</div>
			
					<div class="row">
				<?php echo $form->labelEx($model,'daa_email'); ?>
				<?php echo $form->textField($model,'daa_email',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$email)); ?>
				<?php echo $form->error($model,'daa_email'); ?>
			</div>
				
			<div>Certifico haber recibido, leído y comprendido la Política de Anticorrupción y Antisoborno y me obligo a cumplir con sus términos y condiciones. </div>
			
	<input type="radio"  name="daa_certifica" id="sicertifica" value="si" <?php echo $chkd_certifica; ?> /> SI 
			 &nbsp; &nbsp; &nbsp; 
			<input type="radio"  name="daa_certifica" id="nocertifica" value="no" <?php echo $chkd_no_certifica; ?> /> NO 
		

			<br>	<br>	
			<div>¿Has ofrecido, prometido, o dado de manera directa o indirecta sobornos? </div>
		
	<input type="radio"  name="justi1" id="sijusti1" value="si" <?php echo $chkd_certifica; ?> /> SI 
			 &nbsp; &nbsp; &nbsp; 
			<input type="radio"  name="justi1" id="nojusti1" value="no" <?php echo $chkd_no_certifica; ?> /> NO 
		

			<br>	<br>	
<div id="justi1">
<div class="row">
				<?php echo $form->labelEx($model,'daa_just_has_ofre'); ?>
				<?php echo $form->textArea($model,'daa_just_has_ofre',array('maxlength'=>255,'readOnly'=>$read,'id'=>'observacion1','value'=>$empresa)); ?>
				<?php echo $form->error($model,'daa_just_has_ofre'); ?>
			</div>
			</div>

				<br>	<br>	
			<div>¿Te han ofrecido, prometido o dado de manera directa o indirecta sobornos? </div>
		
	<input type="radio"  name="justi2" id="sijusti2" value="si" <?php echo $chkd_certifica; ?> /> SI 
			 &nbsp; &nbsp; &nbsp; 
			<input type="radio"  name="justi2" id="nojusti2" value="no" <?php echo $chkd_no_certifica; ?> /> NO 
		

	<br>	<br>			
<div id="justi2">
<div class="row">
				<?php echo $form->labelEx($model,'daa_just_han_ofre'); ?>
				<?php echo $form->textArea($model,'daa_just_han_ofre',array('maxlength'=>255,'readOnly'=>$read,'id'=>'observacion2','value'=>$empresa)); ?>
				<?php echo $form->error($model,'daa_just_han_ofre'); ?>
			</div>
			</div>
<br>	<br>	
				
			<div>¿Tienes alguna relación contractual directa o indirecta en negocios que te relacionan, de alguna manera, con TigoUne?   </div>
		
	<input type="radio"  name="justi3" id="sijusti3" value="si" <?php echo $chkd_certifica; ?> /> SI 
			 &nbsp; &nbsp; &nbsp; 
			<input type="radio"  name="justi3" id="nojusti3" value="no" <?php echo $chkd_no_certifica; ?> /> NO 
		

			<br /><br>	
<div id="justi3">
<div class="row">
				<?php echo $form->labelEx($model,'daa_just_rela_tigoune'); ?>
				<?php echo $form->textArea($model,'daa_just_rela_tigoune',array('maxlength'=>255,'readOnly'=>$read,'id'=>'observacion3','value'=>$empresa)); ?>
				<?php echo $form->error($model,'daa_just_rela_tigoune'); ?>
			</div>
			</div>

			<!--
			<div class="row">
				<?php //echo $form->labelEx($model,'daa_pais_id'); ?>
				<?php //echo $form->dropDownList($model,'daa_pais_id',CHtml::listData(Pais::model()->findAll(array('order'=>'pai_nombre')), 'pai_id', 'pai_nombre'), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectdepartamento'),'update'=>'#'.CHtml::activeId($model,'daa_departamento_id'), 'beforeSend'=>'function() { $("#Formulario_daa_departamento_id").find("option").remove(); $("#Formulario_daa_ciudad_id").find("option").remove(); }' ), 'prompt' => '--Seleccione--' )); ?>
				<?php //echo $form->error($model,'daa_pais_id'); ?>
			</div>

			<div class="row">
				<?php //echo $form->labelEx($model,'daa_departamento_id'); ?>
				<?php //echo $form->dropDownList($model,'daa_departamento_id',array(), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectciudad'),'update'=>'#'.CHtml::activeId($model,'daa_ciudad_id'), 'beforeSend'=>'function(){ $("#Formulario_daa_ciudad_id").find("option").remove(); }' ))); ?>
				<?php //echo $form->error($model,'daa_departamento_id'); ?>
			</div>
			-->

		

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

	
			<!-- ------------------------------------------------------ -->

			
			
		
			
			<?php echo $form->hiddenField($model,'daa_radicado',array('value'=>0)); ?>
			
			<?php //echo $form->hiddenField($model,'daa_ciudad_id',array('value'=>1)); ?>
			
		
			
			<?php //echo $form->hiddenField($model,'daa_tipo_identificacion_id',array('value'=>0)); ?>
			
			<?php //echo $form->hiddenField($model,'daa_prueba',array('value'=>0)); ?>

			<?php echo $form->hiddenField($model,'daa_estado_id',array('value'=>1)); ?>

			<?php echo $form->hiddenField($model,'daa_usuario_id',array('value'=>1)); ?>
			
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
			'id'=>'daa-form',
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
