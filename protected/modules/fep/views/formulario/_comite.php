<?php

//echo "fff".$_SESSION['login_user_fep'];
if(isset($_SESSION['login_user_fep'])){	
$rs_pais = Pais::model()->findByPk($model->fep_pais_id);

$rs_departamento = Departamento::model()->findByPk($model->fep_departamento_id);
					
$rs_ciudad = Ciudad::model()->findByPk($model->fep_ciudad_id);

	$arrFiles = array();
	//echo $this->sincifrar($model->fep_info_adicional);DIE;
	
							 $fieldValue = str_replace('"','',$this->sincifrar($model->fep_info_adicional));
							 $fieldValue = str_replace('[','',$fieldValue);
							$fieldValue = str_replace(']','',$fieldValue);
							$arrFiles = explode(",",$fieldValue);
							$path_file = 'archivos/';	//ruta del archivo
							$fieldValue="";
							
							foreach ($arrFiles as $value) {
							
								if(isset($value) && $value && trim($value)!='')
								{
									if($fieldValue!=''){
										$fieldValue .= '<br>';
								}
									if(strlen(trim($value))>2000) 
										$nameValue = substr($value, 0, 27);
									else 
										$nameValue = $value;
									$fieldValue .= '<a href="'.$path_file.trim($value).'" target="_blank">'.$nameValue.'</a>';
								}
							}
							
							
							
								 $fieldValue2 = str_replace('"','',$this->sincifrar($model->fep_soporte_inventario));
							 $fieldValue2 = str_replace('[','',$fieldValue2);
							$fieldValue2 = str_replace(']','',$fieldValue2);
							$arrFiles = explode(",",$fieldValue2);
							$path_file = 'archivos/';	//ruta del archivo
							$fieldValue2="";
							
							foreach ($arrFiles as $value) {
							
								if(isset($value) && $value && trim($value)!='')
								{
									if($fieldValue2!=''){
										$fieldValue2 .= '<br>';
								}
									if(strlen(trim($value))>2000) 
										$nameValue = substr($value, 0, 27);
									else 
										$nameValue = $value;
									$fieldValue2 .= '<a href="'.$path_file.trim($value).'" target="_blank">'.$nameValue.'</a>';
								}
							}
							
//var_dump($rs_pais);
?>
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'fep-form','action'=>Yii::app()->createUrl('fep/formulario/comite',array('id'=>$model->fep_id,'user'=>$_SESSION['login_user_fep'])),
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
		<table width="98%" border="0" cellspacing="1" cellpadding="1"><tbody><tr><td width="50%" align="left"><div><?php setlocale(LC_ALL,"es_ES"); echo utf8_encode(ucfirst(strftime("%A %d de %B del %Y"))); ?></div></td><td width="50%" align="right" style="text-align:right !important;"><a href="<?php echo 'index.php?r=fep/formulario/create&logout_user=1&id='.$_GET["id"].'"'?>>Cerrar sesi&oacute;n</a></td></tr></tbody></table>
		
		<?php echo '<br>A continuación usted como  miembro del comite de evaluación de Eventos y Patrocinios podra ver y gestionar  la aprobación  de la solicitud  presentada por <b>'.$this->sincifrar($model->fep_razon_social).'</b>.';?>
		<!--<div>tifico haber recibido, le&iacute;do y comprendido el Manual de  Conflicto de Intereses y me obligo a cumplir con sus t&eacute;rminos y condiciones.";$read="true";} ?></div>
		<br />
		<div><a href="http://tigo-une.com/compliancetigoune/wp-content/pdf/manual-conflicto-de-intereses-2016.pdf" target="_blank">Click aqu&iacute; para ver el manual</a></div>-->
		
		<style>
		#comite td{
			text-align: left !important;
		}
		
		table h4{
			color: #012B73;
			
		}
		a{
			text-decoration: none;
			color: #000;
		}
		
		tr:nth-child(even){background-color: #f2f2f2}
		
		tr#titulo{background-color: #FFF}
		
		textarea{
			width: 95%;
			height: 80px;
		}
		</style>
<?php
	$tabla='<br><br><center><table id="comite" width="98%" border="0" cellspacing="1" cellpadding="1" ><tbody><tr id="titulo"><th  align="center" colspan="2" ><h4>Información del Solicitante</h4></th></tr>
	<tr><td><b>Nombre:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_nombre).'</td><td><b>Razón Social:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_razon_social).'</td></tr>
	<tr><td><b>Nit:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_nit).'</td><td><b>Persona Responsable:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_persona_responsable).'</td></tr>
	<tr><td><b>Cargo:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_cargo).'</td><td><b>Dirección:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_direccion).'</td></tr>
	<tr><td><b>Celular:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_celular).'</td><td><b>Telefono(s):</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_telefono).'</td></tr>
	<tr><td><b>Email:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_email).'</td></tr>
	<tr><td></td></tr>
	<tr id="titulo"><th width="100%" align="center" colspan="2" ><h4>Información General</h4></th></tr>
	<tr><td><b>Descripción Solicitud:</b></td><td>'.$this->sincifrar($model->fep_descripcion_soli).'</td></tr>
	<tr><td><b>Ubicación:</b></td><td>'.$rs_pais["pai_nombre"] .' - '.$rs_departamento["dep_nombre"].' - '.$rs_ciudad["ciu_nombre"].'</td></tr>
	<tr><td><b>Fecha Inicio:</b>&nbsp;&nbsp;'.$model->fep_fecha_ini_even.'</td><td><b>Fecha Fin:</b>&nbsp;&nbsp;'.$model->fep_fecha_fin_even.'</td></tr>
	<tr><td><b>Observaciones:</b></td><td>'.$this->sincifrar($model->fep_observaciones).'</td></tr>
	<tr><td><b>Tipo de Moneda:</b>&nbsp;&nbsp;'.$model->fep_tipo_moneda.'</td><td><b>Valor Solicitud sin IVA:</b>&nbsp;&nbsp;'.$this->sincifrar($model->fep_valor_soli_sin_iva).'</td></tr>
	<tr><td><b>Tipo de Público:</b>&nbsp;&nbsp;'.$model->fep_tipo_publico.'</td><td><b>Número de Patrocinadores:</b>&nbsp;&nbsp;'.$model->fep_numero_patrocinadores.'</td></tr>
	<tr><td><b>Patrocinadores:</b></td><td>'.$model->fep_patrocinadores.'</td></tr>
	<tr id="titulo"><th width="100%" align="center" colspan="2" ><h4>Declaración</h4></th></tr>
	<tr><td width="60%"><b>¿ El destinatario del evento/patrocinio hace parte de algún grupo de interés de TigoUne (accionista, cliente, proveedor, aliado, entre otros)?</b></td><td>'.$model->fep_grupo_interes.'</td></tr>
	<tr><td width="60%"><b>¿ Ha recibido el destinatario patrocinios de TigoUne o Millicom anteriormente?</b></td><td>'.$model->fep_patrocinios_anteriores.'</td></tr>
	<tr id="titulo"><td  align="center"  colspan="2"><h4>Información Adicional</h4></td></tr>
	<tr><td colspan="2">'.$fieldValue.'</td></tr>
	<tr id="titulo"><td  align="center"  colspan="2"><h4>Inventario</h4></td></tr>
	<tr><td colspan="2">'.$model->fep_inventario.'</td></tr>
	<tr><td colspan="2">'.$fieldValue2.'</td></tr>
	<tr id="titulo"><td  align="center"  colspan="2"><h4>Evaluación Comite</h4></td></tr>
	<tr><td>'.$form->labelEx($model,"Aprobado:").
				 $form->dropDownList($model,'fep_comite[]',array('' => '--Seleccione--','Si'=>'SI','No'=>'NO')).
				 $form->error($model,'fep_comite').$form->textArea($model,'fep_comite[]',array('maxlength'=>255,'placeholder'=>"Observaciones / Comentarios",)).
				$form->error($model,'fep_comite').'
				</td></tr>
		</tbody>
		</table></center><br><br>';
		
		echo $tabla;
		
	
		
		?>
		
			<div id="submit_form">
			<?php echo $form->labelEx($model,'fep_soporte_inventario'); ?>
		
		<?php // echo $form->fileField($model,'for_file'); ?>
		<?php // echo $form->field($model, 'for_file[]')->fileInput(['multiple'=>'multiple']); ?>
		<?php // echo $form->fileField($model,'for_file[]',array('multiple'=>true)); ?>
		<?php
		$this->widget('CMultiFileUpload', array(
                'name' => 'fep_soporte_inventario',
                'accept' => $formatos_validos, // useful for verifying files
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
				'htmlOptions'=>array('multiple'=>true)
            ));
		?>
		
		
		<?php echo $form->error($model,'fep_soporte_inventario'); ?>
			<br><br>
				<div id="mc">
					<div>Por favor dibuje la figura en el recuadro para activar el env&iacute;o del formulario</div><br>
					<canvas id="mc-canvas">
					Su navegador no soporta el plugin de captcha que usamos para garantizar la seguridad del sitio y de sus datos. Por favor vis&iacute;tenos desde otro navegador.
					</canvas>
					<input type="hidden" id="" value=""/>
				</div>

				<div class="row buttons">
					<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Guardar',array('disabled'=>'disabled', 'autocomplete'=>'false')); ?>
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
			'id'=>'fep-form','action'=>Yii::app()->createUrl('fep/formulario/create&st=1',array('id'=>$model->fep_id)),
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
	
							
					
						<fieldset>
							<legend style="text-align: center;"><h3>Autenticación</h3><span style="font-size: 12px; ">Si eres Funcionario Ingresa tu usuario y contraseña de red. Si eres Solicitante de Eventos y Patrocinios haz click <a href="index.php?r=fep/formulario/create&st=1&username=proveedor&password=proveedor&loginForm=1" style="text-decoration: none;">aqui</a></span></legend>
							<?php
								if(isset($_SESSION['msjauth']) && $_SESSION['msjauth']!="")
									echo '<div class="errorSummary" style="text-align:center !important">'.$_SESSION['msjauth'].'</div>';
							unset($_SESSION['msjauth']); 
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