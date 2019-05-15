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

	<div class="row">
		<?php echo $form->labelEx($model,'for_empresa_id'); ?>
		<?php echo $form->dropDownList($model,'for_empresa_id',CHtml::listData(Empresa::model()->findAll(array('order'=>'emp_nombre')), 'emp_id', 'emp_nombre'), array('empty'=>'')); ?>
		<?php echo $form->error($model,'for_empresa_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_complemento'); ?>
		<?php echo $form->checkBox($model,'for_complemento',array('onClick'=>'showComplemento()')); ?>
		<?php echo $form->error($model,'for_complemento'); ?>
	</div>

	<div class="row oculta" id="div_complemento_id" style="display:none">
		<?php echo $form->labelEx($model,'for_complemento_id'); ?>
		<?php echo $form->dropDownList($model,'for_complemento_id',CHtml::listData(Formulario::model()->findAll(array('order'=>'for_radicado','limit'=>'1000')), 'for_id', 'for_radicado'), array('empty'=>'')); ?>
		<?php echo " &nbsp; ".$form->error($model,'for_complemento_id'); ?>
	</div>

	<p>Identificación de la persona Natural o Jurídica directamente vinculada con la operación reportada.</p>
	
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

	<div class="row">
		<?php echo $form->labelEx($model,'for_sucursal_operacion'); ?>
		<?php echo $form->textField($model,'for_sucursal_operacion',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_sucursal_operacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_pais_id'); ?>
		<?php echo $form->dropDownList($model,'for_pais_id',CHtml::listData(Pais::model()->findAll(array('order'=>'pai_nombre')), 'pai_id', 'pai_nombre'), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectdepartamento'),'update'=>'#'.CHtml::activeId($model,'for_departamento_id'), 'beforeSend'=>'function() { $("#Formulario_for_departamento_id").find("option").remove(); $("#Formulario_for_ciudad_id").find("option").remove(); }' ), 'prompt' => '--Seleccione--' )); ?>
		<?php echo $form->error($model,'for_pais_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_departamento_id'); ?>
		<?php echo $form->dropDownList($model,'for_departamento_id',array(), array('ajax'=>array('type'=>'POST','url'=>CController::createUrl('Formulario/Selectciudad'),'update'=>'#'.CHtml::activeId($model,'for_ciudad_id'), 'beforeSend'=>'function(){ $("#Formulario_for_ciudad_id").find("option").remove(); }' ))); ?>
		<?php echo $form->error($model,'for_departamento_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_ciudad_id'); ?>
		<?php echo $form->dropDownList($model,'for_ciudad_id',array(), array('empty'=>'')); ?>
		<?php echo $form->error($model,'for_ciudad_id'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'for_direccion'); ?>
		<?php echo $form->textField($model,'for_direccion',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_telefono'); ?>
		<?php echo $form->textField($model,'for_telefono',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_codigo_postal'); ?>
		<?php echo $form->textField($model,'for_codigo_postal',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_codigo_postal'); ?>
	</div>

	<p>A cuál de los grupos de interés pertenece la Persona Natural o Jurídica que realiza la operación sospechosa</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'for_grupo_interes_id'); ?>
		<?php echo $form->dropDownList($model,'for_grupo_interes_id',CHtml::listData(Grupo_interes::model()->findAll(array('order'=>'gru_nombre')), 'gru_id', 'gru_nombre'), array('empty'=>'')); ?>
		<?php echo $form->error($model,'for_grupo_interes_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_grupo_interes_otro'); ?>
		<?php echo $form->textField($model,'for_grupo_interes_otro',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_grupo_interes_otro'); ?>
	</div>

	<p>Hechos o circunstancias que hacen considerar una operación inusual</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'for_tipo_operacion_id'); ?>
		<?php echo $form->dropDownList($model,'for_tipo_operacion_id',CHtml::listData(Tipo_operacion::model()->findAll(array('order'=>'tip_nombre')), 'tip_id', 'tip_nombre'), array('empty'=>'')); ?>
		<?php echo $form->error($model,'for_tipo_operacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_tipo_operacion_otro'); ?>
		<?php echo $form->textField($model,'for_tipo_operacion_otro',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_tipo_operacion_otro'); ?>
	</div>

	<p>Identificación de otras personas a este reporte</p>
	
	<!--
	  -- Se maneja como HTML debido a que se necesita la creación dinámica de más filas
	<div class="row">
		<?php // echo $form->labelEx($model_persona,'per_nombre'); ?>
		<?php // echo $form->textField($model_persona,'per_nombre',array('maxlength'=>255)); ?>
		<?php // echo $form->error($model_persona,'per_nombre'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model_persona,'per_tipo_identificacion_id'); ?>
		<?php // echo $form->dropDownList($model_persona,'per_tipo_identificacion_id',CHtml::listData(Tipo_identificacion::model()->findAll(array('order'=>'tid_nombre')), 'tid_id', 'tid_nombre'), array('empty'=>'')); ?>
		<?php // echo $form->error($model_persona,'per_tipo_identificacion_id'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model_persona,'per_identificacion'); ?>
		<?php // echo $form->textField($model_persona,'per_identificacion',array('maxlength'=>255)); ?>
		<?php // echo $form->error($model_persona,'per_identificacion'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model_persona,'per_observacion'); ?>
		<?php // echo $form->textArea($model_persona,'per_observacion',array()); ?>
		<?php // echo $form->error($model_persona,'per_observacion'); ?>
	</div>
	-->
	
	<div class="row">
		<label for="per_nombre">Nombre completo o Razón Social</label>
		<input type="text" id="per_nombre" name="Persona_formulario[per_nombre]" maxlength="255">
	</div>
	<div class="row">
		<label for="per_tipo_identificacion_id">Tipo Identificación</label>
		<select id="per_tipo_identificacion_id" name="Persona_formulario[per_tipo_identificacion_id]">
			<option value=""></option>
			<option value="1">Cédula de ciudadanía</option>
			<option value="4">Cédula de Extranjería</option>
			<option value="2">NIT</option>
			<option value="5">Numero de Pasaporte</option>
			<option value="3">RUT</option>
		</select>
	</div>
	<div class="row">
		<label for="per_identificacion">Número Identificación</label>
		<input type="text" id="per_identificacion" name="Persona_formulario[per_identificacion]" maxlength="255">
	</div>
	<div class="row">
		<label for="per_observacion">Observación</label>
		<textarea id="per_observacion" name="Persona_formulario[per_observacion]"></textarea>
	</div>
	
	<input type="hidden" value="0" id="contador" />
	<div id="otrasPersonas"></div>
	<div class="row"><a href="javascript:;" onclick="addElement();">Adicionar persona</a> &nbsp; &nbsp; &nbsp; &nbsp; <a href="javascript:;" onclick="removeElement();">Remover persona</a></div>
	<br />
	
	<p>Descripción del incidente<br />Haga una descripción de los hechos acontecidos que lo llevan a justificar el por qué de la operación sospechosa.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'for_observacion'); ?>
		<?php echo $form->textArea($model,'for_observacion',array()); ?>
		<?php echo $form->error($model,'for_observacion'); ?>
	</div>

	<p>Periodo en que se realizó la operación</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'for_fecha_inicio'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array('model' => $model,'attribute' => 'for_fecha_inicio','htmlOptions' => array('size' => '10','maxlength' => '10','onChange' => 'javscript:validaFechaInicio()'))); ?>
		<?php echo $form->error($model,'for_fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_fecha_fin'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array('model' => $model,'attribute' => 'for_fecha_fin','htmlOptions' => array('size' => '10','maxlength' => '10','onChange' => 'javscript:validaFechaFin()'))); ?>
		<?php echo $form->error($model,'for_fecha_fin'); ?>
	</div>

	<p>Tipo Producto o Servicio afectado</p>

	<div class="row">
		<?php echo $form->labelEx($model,'for_producto_id'); ?>
		<?php echo $form->dropDownList($model,'for_producto_id',CHtml::listData(Producto::model()->findAll(array('order'=>'pro_nombre')), 'pro_id', 'pro_nombre'), array('empty'=>'')); ?>
		<?php echo $form->error($model,'for_producto_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'for_producto_otro'); ?>
		<?php echo $form->textField($model,'for_producto_otro',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_producto_otro'); ?>
	</div>

	<p>Datos de quien reporta (Opcional)</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'for_reportante_nombre'); ?>
		<?php echo $form->textField($model,'for_reportante_nombre',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_reportante_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_reportante_tipo_identificacion_id'); ?>
		<?php echo $form->dropDownList($model,'for_reportante_tipo_identificacion_id',CHtml::listData(Tipo_identificacion::model()->findAll(array('order'=>'tid_nombre')), 'tid_id', 'tid_nombre'), array('empty'=>'')); ?>
		<?php echo $form->error($model,'for_reportante_tipo_identificacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_reportante_identificacion'); ?>
		<?php echo $form->textField($model,'for_reportante_identificacion',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'for_reportante_identificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'for_reportante_correo'); ?>
		<?php echo $form->textField($model,'for_reportante_correo',array('maxlength'=>255));  //'value'=>trim($this->sincifrar($model->for_reportante_correo)) ?>
		<?php echo $form->error($model,'for_reportante_correo'); ?>
	</div>
	
	<p>Documentos adjuntos</p>

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
	
	<div id="mc">
		<p>Por favor dibuje la figura en el recuadro para activar el envío del formulario</p>
		<canvas id="mc-canvas">
		Su navegador no soporta el plugin de captcha que usamos para garantizar la seguridad del sitio y de sus datos. Por favor visítenos desde otro navegador.
		</canvas>
		<input type="hidden" id="mc-action" value=""/>
	</div>

	<div class="row buttons">
		<br /><?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Save', array('disabled'=>'disabled', 'autocomplete'=>'false' ) ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->