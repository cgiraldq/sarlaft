<?php
/* @var $this FormularioController */
/* @var $model Formulario */
/* @var $form CActiveForm */

// Se definen los parametros válidos para archivos adjuntos
$formatos_validos = str_replace(',','|',$row_parametros[0]['par_formatos_validos']);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fle-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php // echo $form->errorSummary(array($model, $model_persona));
		  $html=CHtml::errorSummary($model);
		  if($html!=='') echo '<div class="errorSummary">Por favor corrija los errores en los campos indicados</div>';
	?>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_descripcion_consulta'); ?>
		<?php echo $form->textArea($model,'fle_descripcion_consulta',array()); ?>
		<?php echo $form->error($model,'fle_descripcion_consulta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_fecha_ocurrencia'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array('model' => $model,'attribute' => 'fle_fecha_ocurrencia','htmlOptions' => array('size' => '10','maxlength' => '10','onChange' => 'javscript:validaFechaOcurrencia()'))); ?>
		<?php echo $form->error($model,'fle_fecha_ocurrencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_nombre_persona'); ?>
		<?php echo $form->textField($model,'fle_nombre_persona',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'fle_nombre_persona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_reportante_nombre'); ?>
		<?php echo $form->textField($model,'fle_reportante_nombre',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'fle_reportante_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_otros_datos_contacto'); ?>
		<?php echo $form->textField($model,'fle_otros_datos_contacto',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'fle_otros_datos_contacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_empresa_id'); ?>
		<?php echo $form->dropDownList($model,'fle_empresa_id',CHtml::listData(Empresa::model()->findAll(array('order'=>'emp_nombre')), 'emp_id', 'emp_nombre'), array('empty'=>'')); ?>
		<?php echo $form->error($model,'fle_empresa_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_pais_id'); ?>
		<?php echo $form->dropDownList($model,'fle_pais_id',CHtml::listData(Pais::model()->findAll(array('order'=>'pai_nombre')), 'pai_id', 'pai_nombre'), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectdepartamento'),'update'=>'#'.CHtml::activeId($model,'fle_departamento_id'), 'beforeSend'=>'function() { $("#Formulario_fle_departamento_id").find("option").remove(); $("#Formulario_fle_ciudad_id").find("option").remove(); }' ), 'prompt' => '--Seleccione--' )); ?>
		<?php echo $form->error($model,'fle_pais_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_departamento_id'); ?>
		<?php echo $form->dropDownList($model,'fle_departamento_id',array(), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectciudad'),'update'=>'#'.CHtml::activeId($model,'fle_ciudad_id'), 'beforeSend'=>'function(){ $("#Formulario_fle_ciudad_id").find("option").remove(); }' ))); ?>
		<?php echo $form->error($model,'fle_departamento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fle_ciudad_id'); ?>
		<?php echo $form->dropDownList($model,'fle_ciudad_id',array(), array('empty'=>'')); ?>
		<?php echo $form->error($model,'fle_ciudad_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recaptcha'); ?>
		<div class="input_captcha"><div class="g-recaptcha" data-sitekey="6LeW9BMTAAAAAP_kuCKz1_Vzt0CFYMECj0S5ApOs"></div></div>
		<?php echo $form->error($model,'recaptcha'); ?>
	</div>

	
	<?php echo $form->hiddenField($model,'fle_radicado',array('value'=>0)); ?>
	
	<?php echo $form->hiddenField($model,'fle_prueba',array('value'=>0)); ?>

	<?php echo $form->hiddenField($model,'fle_estado_id',array('value'=>1)); ?>

	<?php echo $form->hiddenField($model,'fle_usuario_id',array('value'=>1)); ?>
	
	<div class="row buttons">
		<br />
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('disabled'=>'disabled', 'autocomplete'=>'false' ) ); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('autocomplete'=>'false' ) ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->