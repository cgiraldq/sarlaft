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

	<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'consulta_tipo_identificacion_id'); ?>
		<?php //echo $form->dropDownList($model,'consulta_tipo_identificacion_id',CHtml::listData(Tipo_identificacion::model()->findAll(array('order'=>'tid_nombre')), 'tid_id', 'tid_nombre'), array('empty'=>'')); ?>
		<?php //echo $form->error($model,'consulta_tipo_identificacion_id'); ?>
	</div>
	-->

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


	<?php echo $form->hiddenField($model,'fle_radicado',array('value'=>0)); ?>
	
	<?php echo $form->hiddenField($model,'fle_prueba',array('value'=>0)); ?>

	<?php echo $form->hiddenField($model,'fle_estado_id',array('value'=>1)); ?>

	<?php echo $form->hiddenField($model,'fle_usuario_id',array('value'=>1)); ?>
	
	<div class="row buttons">
		<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('disabled'=>'disabled', 'autocomplete'=>'false' ) ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->