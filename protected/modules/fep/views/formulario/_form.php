<?php
//echo "fff".$_SESSION['login_user_fep'];
if(isset($_SESSION['login_user_fep'])){	
?>
<style>
li{color: #000;}

#texto_peq{
	font-size: 11px;
}
</style>
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'fep-form',
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
		<!--<div align="justify"><b>Un Conflicto de Intereses</b>, hace referencia a toda situaci&oacute;n en la que los intereses personales, directos o indirectos, de los miembros de la Junta Directiva, de la administraci&oacute;n o de los colaboradores de TigoUne o sus familiares, <b>pueden estar enfrentados con los de la Compañ&iacute;a</b>, o en alguna medida <b>interfieren con sus deberes</b> y motivan un actuar contrario al recto cumplimiento de sus obligaciones laborales. Estas situaciones en las que se contraponen los intereses personales a los intereses organizacionales, <b>pueden llegar a generar un beneficio econ&oacute;mico, pol&iacute;tico o comercial a una de las partes</b>, ocasionando un desequilibrio con la otra, o incluso pueden llegar a generar una <b>falta de integridad</b> en la(s) compañ&iacute;a(s); afectando la <b>transparencia, equidad y responsabilidad</b> organizacional.</div>-->
		
		<br />
		<table width="98%" border="0" cellspacing="1" cellpadding="1"><tbody><tr><td width="50%" align="left"><div><?php setlocale(LC_ALL,"es_ES"); echo utf8_encode(ucfirst(strftime("%A %d de %B del %Y"))); ?></div></td><td width="50%" align="right" style="text-align:right !important;"><a href="index.php?r=fep/formulario/create&logout_user=1">Cerrar sesi&oacute;n</a></td></tr></tbody></table>
		
		Por favor diligencia la siguiente información con los datos de la entidad, con el cual se pretende orientar  la participación en eventos y patrocinios por parte de TigoUne y sus filiales; con el objetivo de tomar decisiones legales, éticas y transparentes. 
<br><br>
<span id="texto_peq"><b>TigoUne solo participa en eventos y patrocinios académicos, culturales, deportivos, artísticas o sociales organizados por la compañia y/o un tercero; siempre y cuando la finalidad del evento o patrocinio sea impactar positivamente a nuestros grupos de interés y fortalecer el posicionamiento de las marcas.

<br>No patrocina: <br>
<ul>
<li>Eventos donde exista una interacción directa con animales, como por ejemplo: Corridas de toros, exposiciones de animales y corralejas, entre otros. </li>
<li> Eventos políticos: campañas políticas y/o apoyo a candidatos. </li>
<li> Eventos que estén enmarcados en algún tipo de creencia religiosa. </li>
<li> Eventos en donde el nombre de TigoUne, se asocie directamente con la promoción y/o el consumo de licores, bebidas alcohólicas, tabaco, sustancias psicoactivas.</li> 
<li> No se patrocinan eventos o actividades de colegios y/o universidades que no contemplen una estrategia comercial y académica.</li>
<li> No se patrocina ningún tipo de equipo o actividad deportiva y/o cultural no profesional. Ej. equipo de fútbol de un colegio, un barrio, grupo de danzas y teatro, entre otros.</li>
<li> No se patrocina, ni se participa en ningún tipo de evento que promueva la violencia o violación de los derechos humanos. </li>
<li> No se patrocina eventos o actividades que se desarrollen en lugares donde TigoUne no tenga cobertura propia o a través de sus filiales.</li>
</ul>
TigoUne está comprometida con los más altos estándares de transparencia y ética empresarial, por esta razón coloca a su disposición el formulario de Eventos y Patrocinios.
</b></span>
<br><br><a target="_blank" href="http://tigo-une.com/compliancetigoune/wp-content/pdf/politica-de-eventos-y-patrocinios.pdf">Click aquí para conocer nuestra política</a> 


<br><br><b>Nota:</b> los campos con asterisco (*) son obligatorios, sino son diligenciadosel sistema no le permite continuar. Tiene un tiempo de 3 horas para completar la informaci&oacute;n.
		<!--<div>tifico haber recibido, le&iacute;do y comprendido el Manual de  Conflicto de Intereses y me obligo a cumplir con sus t&eacute;rminos y condiciones.";$read="true";} ?></div>
		<br />
		<div><a href="http://tigo-une.com/compliancetigoune/wp-content/pdf/manual-conflicto-de-intereses-2016.pdf" target="_blank">Click aqu&iacute; para ver el manual</a></div>-->

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

		
		<div id="form_conflicto">
		<br>
		<b>Informaci&oacute;n del Solicitante</b><br><br>
		
			<!--
			<br />
			<div class="note">Favor diligenciar los siguientes datos. (Los campos con <span class="required">*</span> son obligatorios)</div>  
			-->
			
			<?php // echo $form->errorSummary(array($model, $model_persona));
				  $html=CHtml::errorSummary($model);
				  if($html!=='') echo '<br /><div class="errorSummary">Por favor corrija los errores en los campos indicados</div>';
			?>

			<br />
			<div class="row">
				<?php echo $form->labelEx($model,'fep_nombre'); ?>
				<?php echo $form->textField($model,'fep_nombre',array('maxlength'=>255,'readOnly'=>$read,'value'=>$nombre)); ?>
				<?php echo $form->error($model,'fep_nombre'); ?>
			</div>
			<div class="row">

</div>
				<div class="row">
				<?php echo $form->labelEx($model,"fep_razon_social"); ?>
				<?php echo $form->textField($model,'fep_razon_social',array('maxlength'=>255,'readOnly'=>$read,'value'=>$nombre)); ?>
				<?php echo $form->error($model,'fep_razon_social'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'fep_nit'); ?>
				<?php echo $form->textField($model,'fep_nit',array('maxlength'=>255,'readOnly'=>$read,'value'=>$identificacion)); ?>
				<?php echo $form->error($model,'fep_nit'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'fep_persona_responsable'); ?>
				<?php echo $form->textField($model,'fep_persona_responsable',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_persona_responsable'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'fep_cargo'); ?>
				<?php echo $form->textField($model,'fep_cargo',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_cargo'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'fep_direccion'); ?>
				<?php echo $form->textField($model,'fep_direccion',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_direccion'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'fep_telefono'); ?>
				<?php echo $form->textField($model,'fep_telefono',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_telefono'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'fep_celular'); ?>
				<?php echo $form->textField($model,'fep_celular',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_celular'); ?>
			</div>
			
			
			
			
			<div class="row">
				<?php echo $form->labelEx($model,'fep_email'); ?>
				<?php echo $form->textField($model,'fep_email',array('maxlength'=>255,'readOnly'=>$read,'value'=>$email)); ?>
				<?php echo $form->error($model,'fep_email'); ?>
			</div>

		<br>
		<b>Informaci&oacute;n General</b>
		<br>
	<div class="row">
				<?php echo $form->labelEx($model,'fep_descripcion_soli'); ?>
				<?php echo $form->textArea($model,'fep_descripcion_soli',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_descripcion_soli'); ?>
			</div>
			<b>Ubicaci&oacute;n Geografica </b>
		<div class="row">
		<?php echo $form->labelEx($model,'fep_pais_id'); ?>
		<?php echo $form->dropDownList($model,'fep_pais_id',CHtml::listData(Pais::model()->findAll(array('order'=>'pai_nombre')), 'pai_id', 'pai_nombre'), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectdepartamento'),'update'=>'#'.CHtml::activeId($model,'fep_departamento_id'), 'beforeSend'=>'function() { $("#Formulario_fep_departamento_id").find("option").remove(); $("#Formulario_for_ciudad_id").find("option").remove(); }' ), 'prompt' => '--Seleccione--' )); ?>
		<?php echo $form->error($model,'fep_pais_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fep_departamento_id'); ?>
		<?php echo $form->dropDownList($model,'fep_departamento_id',array(), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectciudad'),'update'=>'#'.CHtml::activeId($model,'fep_ciudad_id'), 'beforeSend'=>'function(){ $("#Formulario_fep_ciudad_id").find("option").remove(); }' ))); ?>
		<?php echo $form->error($model,'fep_departamento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fep_ciudad_id'); ?>
		<?php echo $form->dropDownList($model,'fep_ciudad_id',array(), array('empty'=>'')); ?>
		<?php echo $form->error($model,'fep_ciudad_id'); ?>
	</div>

			<div class="row">
				<?php echo $form->labelEx($model,'fep_fecha_ini_even'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array('model' => $model,'attribute' => 'fep_fecha_ini_even','options'=>array('showAnim'=>'fold', ), 'htmlOptions'=>array('style'=>'height:20px; width:20%;'),'htmlOptions' => array('onChange' => 'javscript:validaFechaInicio()')));?>
				
				<?php echo $form->error($model,'fep_fecha_ini_even'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'fep_fecha_fin_even'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array('model' => $model,'attribute' => 'fep_fecha_fin_even','options'=>array('showAnim'=>'fold', ), 'htmlOptions'=>array('style'=>'height:20px; width:20%;'),'htmlOptions' => array('onChange' => 'javscript:validaFechaFin()')));?>
				<?php echo $form->error($model,'fep_fecha_fin_even'); ?>
			</div>
			
				<div class="row">
				<?php echo $form->labelEx($model,'fep_observaciones'); ?>
				<?php echo $form->textArea($model,'fep_observaciones',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_observaciones'); ?>
			</div>
			
				<div class="row">
				<?php echo $form->labelEx($model,'fep_tipo_moneda'); ?>
				<?php echo $form->dropDownList($model,'fep_tipo_moneda', array('' => '--Seleccione--','Dolares'=>'Dolares','Euros'=>'EUROS','Pesos'=>'Pesos'));?>
				<?php echo $form->error($model,'fep_tipo_moneda'); ?>
			</div>
			
				<div class="row">
				<?php echo $form->labelEx($model,'fep_valor_soli_sin_iva'); ?>
				<?php echo $form->textField($model,'fep_valor_soli_sin_iva',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_valor_soli_sin_iva'); ?>
			</div>
			
		
			
				<div class="row">
				<?php echo $form->labelEx($model,'fep_tipo_publico'); ?>
				<?php echo $form->textField($model,'fep_tipo_publico',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_tipo_publico'); ?>
			</div>
			
				<div class="row">
				<?php echo $form->labelEx($model,'fep_numero_patrocinadores'); ?>
				<?php echo $form->textField($model,'fep_numero_patrocinadores',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_numero_patrocinadores'); ?>
			</div>
			
					<div class="row">
				<?php echo $form->labelEx($model,'fep_patrocinadores'); ?>
				<?php echo $form->textArea($model,'fep_patrocinadores',array('maxlength'=>255,'readOnly'=>$read,'value'=>$empresa)); ?>
				<?php echo $form->error($model,'fep_patrocinadores'); ?>
			</div>
			<br>
			<b>Declaraci&oacute;n</b>
						
			<br>
			<br>
			
				<div class="row">
				<?php echo $form->labelEx($model,'fep_grupo_interes', array('style' => 'min-width: 100%;     white-space: inherit;')); ?>
				<?php echo $form->dropDownList($model,'fep_grupo_interes', array('' => '--Seleccione--','Si'=>'SI','No'=>'NO'));?>
				<?php echo $form->error($model,'fep_grupo_interes'); ?>
			</div>
			
				<div class="row">
				<?php echo $form->labelEx($model,'fep_patrocinios_anteriores', array('style' => 'min-width: 100%;     white-space: inherit;')); ?>
				<?php echo $form->dropDownList($model,'fep_patrocinios_anteriores', array('' => '--Seleccione--','Si'=>'SI','No'=>'NO'));?>
				<?php echo $form->error($model,'fep_patrocinios_anteriores'); ?>
			</div>
			
						<br>
			<b>Informaci&oacute;n Adicional</b>
						
			<br>
			<br>
		<div class="row">
		<?php echo $form->labelEx($model,'fep_info_adicional'); ?>
		
		<?php // echo $form->fileField($model,'for_file'); ?>
		<?php // echo $form->field($model, 'for_file[]')->fileInput(['multiple'=>'multiple']); ?>
		<?php // echo $form->fileField($model,'for_file[]',array('multiple'=>true)); ?>
		<?php
		$this->widget('CMultiFileUpload', array(
                'name' => 'fep_info_adicional',
                'accept' => $formatos_validos, // useful for verifying files
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
				'htmlOptions'=>array('multiple'=>true)
            ));
		?>
		
		<?php echo $form->error($model,'fep_info_adicional'); ?>
	</div>
			
		

			<br />
			<!--<div>Declaro tener conocimiento del Manual de Conflicto de Intereses y las situaciones que se consideran como tal y de la necesidad de informar cualquier situaci&oacute;n que pueda ser fuente de un posible conflicto de inter&eacute;s, raz&oacute;n por la cual declaro:</div>-->
			
			<br />
	

			<br />
			<!-- ------------------------------------------------------ -->
			<div id="form_no_tiene_conflicto">
				<div>Favor dar clic en el siguiente bot&oacute;n enviar para consignar su respuesta</div>
			</div>	
			<!-- ------------------------------------------------------ -->

			<br />
			<!-- ------------------------------------------------------ -->
		
			<!-- ------------------------------------------------------ -->
			
			
		
			
			<div id="submit_form">
				
				<div id="mc">
					<div>Por favor dibuje la figura en el recuadro para activar el env&iacute;o del formulario</div>
					<canvas id="mc-canvas">
					Su navegador no soporta el plugin de captcha que usamos para garantizar la seguridad del sitio y de sus datos. Por favor vis&iacute;tenos desde otro navegador.
					</canvas>
					<input type="hidden" id="mc-action" value=""/>
				</div>

				<div class="row buttons">
					<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('disabled'=>'disabled', 'autocomplete'=>'false' ) ); ?>
				</div>
			
			</div>

		</div>
		
	<?php $this->endWidget(); ?>

	</div><!-- form -->

<?php
	}
	else
	{//echo "sf".$msjauth;DIE;
?>
	
		<div class="form">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'fep-form',
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




	
	
	<br>
	
							<?php $enlace="index.php?r=fep/formulario/create&st=1&username=proveedor&password=proveedor&loginForm=1";
							if(isset($_GET["id"]) && $_GET["id"]!=""){
								$enlace='<legend style="text-align: center;"><h3>Autenticación</h3><span style="font-size: 12px; ">Bienvenido al formulario de evaluación de comite de Eventos y patrocinios, ingresa usaurio y contraseña de red para evualuar la petición <b>'.$_GET["id"].'</b>. ';
							}else{
								$enlace='<legend style="text-align: center;"><h3>Solicitud</h3><span style="font-size: 15px; "><a href="index.php?r=fep/formulario/create&st=1&username=proveedor&password=proveedor&loginForm=1" style="text-decoration: none;">Si eres Solicitante de Eventos y Patrocinios haz click <b>aqui</a></b>';
							}
							?>
					
						<fieldset>
							 <?php echo $enlace;?>
							</span></legend>
							<?php
								if(isset($_SESSION['msjauth']) && $_SESSION['msjauth']!="")
									echo '<div class="errorSummary" style="text-align:center !important">'.$_SESSION['msjauth'].'</div>';
							unset($_SESSION['msjauth']); 
							?>
						<?php if(isset($_GET["id"]) && $_GET["id"]!=""){?>
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
						<?php }?>
							
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
<script>
$(document).ready(function (){
		$("#Formulario_fep_telefono, #Formulario_fep_celular").keyup(function (e) {
		//alert("holaaa");

		  this.value = this.value.replace(/[^0-9]/g,'');
		  
		});


		$("#Formulario_fep_email").blur(function (e) {
			var email = $("#Formulario_fep_email").val();
		  //console.log(email);

			var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
				if(email!=""){
					if (caract.test(email) == false){
						alert("El correo ingresado es invalido, por favor ingreselo de nuevo!");
						$(this).focus();
						$(this).val("");	
					}
				}
		});

});
</script>