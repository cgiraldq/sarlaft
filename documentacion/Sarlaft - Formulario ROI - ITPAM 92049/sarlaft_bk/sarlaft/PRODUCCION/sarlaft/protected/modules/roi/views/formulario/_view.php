<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
?>

<div class="view">

	El reporte de <?php echo $this->sincifrar($model->for_nombre_persona); ?> con identificación <?php echo $this->sincifrar($model->for_identificacion_persona); ?> ha sido enviado correctamente con el número de radicado <?php echo $model->for_radicado; // $this->sincifrar($model->for_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('for_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->for_radicado), array('view', 'id'=>$model->for_radicado)); ?>
	<br />
	-->

</div>