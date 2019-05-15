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

 $area;
		
		  $area_=str_replace("GERENCIA","GERENTE",$area);
		$client = new SoapClient($wsdl);
		$parametros = array(
			'palabra_clave' => $area_,
			'atributo_filtro' => 'title',
			'atributos_retorna' => 'mail',
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
		
		  $area_=str_replace(" ","_",$area_);
		 $gerente = $response["wsResponse"][""][$dominio][0][$area_]["entries"][0]["mail"][0];
		if($gerente==""){
		 $gerente = $response["wsResponse"][""][$dominio][0][$area_]["entries"][1]["mail"][0];
		}
		
	?>

	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'ifp-form',
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


		<table width="98%" border="0" cellspacing="1" cellpadding="1"><tbody><tr><td width="50%" align="left"><div><?php setlocale(LC_ALL,"es_ES"); echo utf8_encode(ucfirst(strftime("%A %d de %B del %Y"))); ?></div></td><td width="50%" align="right" style="text-align:right !important;"><a href="index.php?r=ifp/formulario/create&logout_user=1">Cerrar sesión</a></td></tr></tbody></table>
		
		<!--<div><?php echo $nombre; ?>, Certifico haber recibido, leído y comprendido el Código de Ética y me obligo a cumplir con sus términos y condiciones.</div>
		<br />
		<div><a href="http://www.tigo-une.com/compliance/wp-content/uploads/2015/04/ManualConflicto-de-Intereses2.pdf" target="_blank">Click aquí para ver el manual</a></div>-->

				<br />
		<!--<div align="justify"><b>Un Conflicto de Intereses</b>, hace referencia a toda situación en la que los intereses personales, directos o indirectos, de los miembros de la Junta Directiva, de la administración o de los colaboradores de TigoUne o sus familiares, <b>pueden estar enfrentados con los de la Compañía</b>, o en alguna medida <b>interfieren con sus deberes</b> y motivan un actuar contrario al recto cumplimiento de sus obligaciones laborales. Estas situaciones en las que se contraponen los intereses personales a los intereses organizacionales, <b>pueden llegar a generar un beneficio económico, político o comercial a una de las partes</b>, ocasionando un desequilibrio con la otra, o incluso pueden llegar a generar una <b>falta de integridad</b> en la(s) compañía(s); afectando la <b>transparencia, equidad y responsabilidad</b> organizacional.</div>-->
		
		<div align="justify">En TigoUne llevar a cabo reuniones con Funcionarios de Gobierno plantea un riesgo significativo de Cumplimiento. Por esta razón, es importante documentar el relacionamiento con Funcionarios de Gobierno y asegurar que cualquier reunión se realice de conformidad con el Código de Ética de TigoUne, la Política Anticorrupción y Antisoborno, y las demás políticas de Ética y Cumplimiento. 

<br><br>Principio de los cuatro (4) ojos<br>
En las negociaciones estamos representados por al menos dos personas para garantizar la transparencia y al efectividad del proceso.
<br><br>
Te invitamos a conocer la Política de interacción con funcionarios públicos y a realizar la declaración.
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
				<?php echo $form->labelEx($model,'ifp_identificacion'); ?>
				<?php echo $form->textField($model,'ifp_identificacion',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$identificacion)); ?>
				<?php echo $form->error($model,'ifp_identificacion'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'ifp_nombre'); ?>
				<?php echo $form->textField($model,'ifp_nombre',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$nombre)); ?>
				<?php echo $form->error($model,'ifp_nombre'); ?>
			</div>

	
			
						<div class="row">
				<?php echo $form->labelEx($model,'ifp_vicepresidencia'); ?>
				<?php echo $form->textField($model,'ifp_vicepresidencia',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$vicepresidencia)); ?>
				<?php echo $form->error($model,'ifp_vicepresidencia'); ?>
			</div>
			
						<div class="row">
				<?php echo $form->labelEx($model,'ifp_area'); ?>
				<?php echo $form->textField($model,'ifp_area',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$area)); ?>
				<?php echo $form->error($model,'ifp_area'); ?>
			</div>
			
	

			<div class="row">
				<?php echo $form->labelEx($model,'ifp_cargo'); ?>
				<?php echo $form->textField($model,'ifp_cargo',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$cargo)); ?>
				<?php echo $form->error($model,'ifp_cargo'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'ifp_email'); ?>
				<?php echo $form->textField($model,'ifp_email',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$email)); ?>
				<?php echo $form->error($model,'ifp_email'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'ifp_telefono'); ?>
				<?php echo $form->textField($model,'ifp_telefono',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$telefono)); ?>
				<?php echo $form->error($model,'ifp_telefono'); ?>
			</div>

			<!--
			<div class="row">
				<?php //echo $form->labelEx($model,'ifp_pais_id'); ?>
				<?php //echo $form->dropDownList($model,'ifp_pais_id',CHtml::listData(Pais::model()->findAll(array('order'=>'pai_nombre')), 'pai_id', 'pai_nombre'), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectdepartamento'),'update'=>'#'.CHtml::activeId($model,'ifp_departamento_id'), 'beforeSend'=>'function() { $("#Formulario_ifp_departamento_id").find("option").remove(); $("#Formulario_ifp_ciudad_id").find("option").remove(); }' ), 'prompt' => '--Seleccione--' )); ?>
				<?php //echo $form->error($model,'ifp_pais_id'); ?>
			</div>

			<div class="row">
				<?php //echo $form->labelEx($model,'ifp_departamento_id'); ?>
				<?php //echo $form->dropDownList($model,'ifp_departamento_id',array(), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectciudad'),'update'=>'#'.CHtml::activeId($model,'ifp_ciudad_id'), 'beforeSend'=>'function(){ $("#Formulario_ifp_ciudad_id").find("option").remove(); }' ))); ?>
				<?php //echo $form->error($model,'ifp_departamento_id'); ?>
			</div>
			-->

			<div class="row">
				<?php echo $form->labelEx($model,'ifp_ciudad'); ?>
				<?php //echo $form->dropDownList($model,'ifp_ciudad_id',array(), array('empty'=>'')); ?>
				<?php echo $form->textField($model,'ifp_ciudad',array('maxlength'=>255,'readOnly'=>'readOnly','value'=>$ciudad)); ?>
				<?php echo $form->error($model,'ifp_ciudad'); ?>
			</div>
	
				<div class="row" style="display: <?php echo $display; ?>;">
				<?php echo "Correo del Vicepresidente, Director o Gerente del área a la que perteneces&nbsp;&nbsp;&nbsp; ";?>
				<?php echo $form->textField($model,'ifp_jefe_inmediato',array('style'=>'width:35%','maxlength'=>100,'value'=>$gerente,'width'=>'')); ?>
				<?php echo $form->error($model,'ifp_jefe_inmediato'); ?>
			</div>

	<div class="row">
				<?php echo $form->labelEx($model,'ifp_fecha_reunion'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array('model' => $model,'attribute' => 'ifp_fecha_reunion','options'=>array('showAnim'=>'fold', ), 'htmlOptions'=>array('style'=>'height:20px; width:20%;')));?>
				
				<?php echo $form->error($model,'ifp_fecha_reunion'); ?>
			</div>
			
			
			<br><br><b>Informaci&oacute;n de la Reuni&oacute;n</b>
			
			<br>
					<div class="row">
				<?php echo $form->labelEx($model,'ifp_entidad'); ?>
				<?php //echo $form->dropDownList($model,'ifp_entidad',array(), array('empty'=>'')); ?>
				<?php echo $form->textField($model,'ifp_entidad',array('maxlength'=>255)); ?>
				<?php echo $form->error($model,'ifp_entidad'); ?>
			</div>
			
			
						<div class="row">
				<?php echo $form->labelEx($model,'ifp_nit_entidad'); ?>
				<?php //echo $form->dropDownList($model,'ifp_ciudad_id',array(), array('empty'=>'')); ?>
				<?php echo $form->textField($model,'ifp_nit_entidad',array('maxlength'=>255)); ?>
				<?php echo $form->error($model,'ifp_nit_entidad'); ?>
			</div>
			
			<br><br><b>Participantes</b>
			
							<div class="row">
				<?php echo $form->labelEx($model,'ifp_num_participantes'); ?>
				<?php //echo $form->dropDownList($model,'ifp_ciudad_id',array(), array('empty'=>'')); ?>
				<?php echo $form->textField($model,'ifp_num_participantes',array('maxlength'=>255)); ?>
				<?php echo $form->error($model,'ifp_num_participantes'); ?>
			</div>
			
				<br><br><b>Participante por parte de la entidad</b>
				
					<br><br><div class="row">
		<label for="ifp_nombre">Nombre</label>
		<input type="text" id="ifp_nombre_ent" name="part_entidad[ifp_nombre_ent]" maxlength="255">
	</div>

		<div class="row">
		<label for="ifp_cargo">Cargo</label>
		<input type="text" id="ifp_cargo_ent" name="part_entidad[ifp_cargo_ent]" maxlength="255">
	</div>
	
	<div class="row">
		<label for="ifp_identificacion">Identificación</label>
		<input type="text" id="ifp_id_ent" name="part_entidad[ifp_id_ent]" maxlength="255">
	</div>

	
	<input type="hidden" value="0" id="contador" />
	<div id="otrasPersonas"></div>
	<div class="row"><a href="javascript:;" onclick="addElement();">Adicionar Participante Entidad</a> &nbsp; &nbsp; &nbsp; &nbsp; <a href="javascript:;" onclick="removeElement();">Remover Participante</a></div>
	<br /><br>
	
	<b>Participante por parte de TigoUne y/o tercero actuando en nombre y/o representación de tigoune.</b>
	
						<br><br><div class="row">
		<label for="ifp_nombre">Nombre</label>
		<input type="text" id="ifp_nombre" name="part_tigoune[ifp_nombre]" maxlength="255">
	</div>

		<div class="row">
		<label for="ifp_cargo">Cargo</label>
		<input type="text" id="ifp_cargo" name="part_tigoune[ifp_cargo]" maxlength="255">
	</div>
	
	<div class="row">
		<label for="ifp_identificacion">Identificación</label>
		<input type="text" id="ifp_identificacion" name="part_tigoune[ifp_identificacion]" maxlength="255">
	</div>

	
	<input type="hidden" value="0" id="contador2" />
	<div id="otrasPersonas2"></div>
	<div class="row"><a href="javascript:;" onclick="addElement2();">Adicionar Participante TigoUne</a> &nbsp; &nbsp; &nbsp; &nbsp; <a href="javascript:;" onclick="removeElement2();">Remover Participante</a></div>
	<br /><br><br>
	
	<div class="row">
			<?php echo $form->labelEx($model,'ifp_proposito'); ?><br><br>
		<input type="checkbox" name="ifp_proposito[]" value="Corresponde a un Proyecto nuevo o existente" />&nbsp;Corresponde a un Proyecto nuevo o existente.<br>
<input type="checkbox" name="ifp_proposito[]"  value="Corresponde a Asuntos Legales o Regulatorios"/>&nbsp;Corresponde a Asuntos Legales o Regulatorios.<br>
<input type="checkbox" name="ifp_proposito[]" value="Explicación y/o Ventas de servicios de TigoUne"/>&nbsp;Explicación y/o Ventas de servicios de TigoUne.<br>
<input type="checkbox" name="ifp_proposito[]" value="Corresponde a compra de servicio" />&nbsp;Corresponde a compra de servicio.<br>
<input id="otro" type="checkbox" name="ifp_proposito[]" value="Otro"/>&nbsp;Otro.<br><br>
 <input id="otro_text" type="text" placeholder="¿Cual Otro?" />
<?php echo $form->error($model,'ifp_proposito'); ?>
	</div>
	
	<br><br>
	<b>Nota</b>: se excluye las reuniones periódicas, rutinarias, convencional u operativas que se llevan a cabo en el día a día de los negocios, para hacer seguimiento a la fallas, sesiones de seguimiento a contratos, a monitoreo de indicadores de servicio, entre otras.
	
		<br><br><b>Realizar una descripción de los temas tratados en la reunión.</b>
	<br><br>
	<div class="row">
				<?php echo $form->labelEx($model,'ifp_desc_temas'); ?>
				<?php echo $form->textArea($model,'ifp_desc_temas',array('maxlength'=>255,'id'=>'ifp_desc_temas','value'=>'')); ?>
				<?php echo $form->error($model,'ifp_desc_temas'); ?>
			</div>
			
			
				<br><br><b>Si en el desarrollo de una reunión con cualquier funcionario público insinúa o se les ofrece algún acto indebido para manejar el contrato, detectan hechos o acciones relacionadas con soborno, corrupción, fraude, materialización de conflictos de interés, que involucran a la compañía o dar la apariencia de estar participando en política,  se debe hacer el reporte de lo sucedido.</b>
	<br><br>
	<div class="row">
				<?php echo $form->labelEx($model,'ifp_reporte'); ?>
				<?php echo $form->textArea($model,'ifp_reporte',array('maxlength'=>255,'id'=>'ifp_reporte','value'=>'')); ?>
				<?php echo $form->error($model,'ifp_reporte'); ?>
			</div>
			
			
			
			<!-- ------------------------------------------------------ -->

	
			

			
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
			'id'=>'ifp-form',
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
