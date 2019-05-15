<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
?>

<center><div class="form" style="    width: auto;
    max-width: 845px;
    padding: 10px;
    padding-bottom: 40px;
    overflow: auto;
    border: 1px solid #cccccc;
    -moz-box-shadow: 2px 2px 2px #cccccc;
    -webkit-box-shadow: 2px 2px 2px #cccccc;
    box-shadow: 2px 2px 2px #cccccc;">

	<br /><br />
	El reporte de <?php echo $this->sincifrar($model->consulta_nombre_persona); ?> ha sido enviado correctamente con el número de radicado <?php echo $model->consulta_radicado; // $this->sincifrar($model->consulta_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('consulta_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->consulta_radicado), array('view', 'id'=>$model->consulta_radicado)); ?>
	<br />
	-->
</div></center>