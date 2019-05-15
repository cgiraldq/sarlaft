<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
?>

<div class="view">

	El reporte de <?php echo $this->sincifrar($model->consulta_nombre_persona); ?> ha sido enviado correctamente con el número de radicado <?php echo $model->consulta_radicado; // $this->sincifrar($model->consulta_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('consulta_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->consulta_radicado), array('view', 'id'=>$model->consulta_radicado)); ?>
	<br />
	-->

</div>