<?php
/* @var $this FormularioController */
/* @var $model Formulario */
/* @var $form CActiveForm */

// Se definen los parametros válidos para archivos adjuntos
$formatos_validos = str_replace(',','|',$row_parametros[0]['par_formatos_validos']);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'roi-form',
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

	<p>Ingrese los siguientes datos para la consulta</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'for_tipo_identificacion_id'); ?>
		<?php echo $form->dropDownList($model,'for_tipo_identificacion_id',CHtml::listData(Tipo_identificacion::model()->findAll(array('order'=>'tid_nombre')), 'tid_id', 'tid_nombre'), array('empty'=>'')); ?>
		<?php echo $form->error($model,'for_tipo_identificacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_identificacion_persona'); ?>
		<?php echo $form->textField($model,'for_identificacion_persona',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_identificacion_persona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_nombre_persona'); ?>
		<?php echo $form->textField($model,'for_nombre_persona',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_nombre_persona'); ?>
	</div>

	
	<p>Documento adjunto con los registros a consultar </p>

	<div class="row">
		<?php echo $form->labelEx($model,'for_file'); ?>
		
		<?php // echo $form->fileField($model,'for_file'); ?>
		<?php // echo $form->field($model, 'for_file[]')->fileInput(['multiple'=>'multiple']); ?>
		<?php // echo $form->fileField($model,'for_file[]',array('multiple'=>true)); ?>
		<?php
		$this->widget('CMultiFileUpload', array(
                'name' => 'for_file',
                'accept' => $formatos_validos, // useful for verifying files
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
				'htmlOptions'=>array('multiple'=>true)
            ));
		?>
		
		<?php echo $form->error($model,'for_file'); ?>
	</div>
	
	<?php echo $form->hiddenField($model,'for_radicado',array('value'=>0)); ?>
	
	<?php echo $form->hiddenField($model,'for_prueba',array('value'=>0)); ?>

	<?php echo $form->hiddenField($model,'for_estado_id',array('value'=>1)); ?>

	<?php echo $form->hiddenField($model,'for_usuario_id',array('value'=>1)); ?>
	
	<div class="row buttons">
		<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('disabled'=>'disabled', 'autocomplete'=>'false' ) ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->