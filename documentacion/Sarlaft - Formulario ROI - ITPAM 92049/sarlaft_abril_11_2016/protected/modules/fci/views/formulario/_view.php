<?php
/* @var $this MvcUsersController */
/* @var $data MvcUsers */
?>
<style>

	
	
	@media (min-width: 1024px) AND (max-width: 1240px) {
.ci{
 margin-left: 10em;
    margin-right: 14em;
	
	}
}

@media (min-width: 1240px) {
.ci{
 margin-left: 16em;
    margin-right: 14em;
	
	}
}
	
	
</style>


<div class="form" style="    width: auto;

    max-width: 845px;
    padding: 10px;
    padding-bottom: 40px;
    overflow: auto;
    border: 1px solid #cccccc;
    -moz-box-shadow: 2px 2px 2px #cccccc;
    -webkit-box-shadow: 2px 2px 2px #cccccc;
    box-shadow: 2px 2px 2px #cccccc;">

	<br /><br />
	El reporte de <?php echo $this->sincifrar($model->fci_nombre_persona); ?> ha sido enviado correctamente con el número de radicado <?php echo $model->fci_radicado; // $this->sincifrar($model->fci_radicado); ?>
	<!--
	<b><?php echo CHtml::encode($model->getAttributeLabel('fci_radicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($model->fci_radicado), array('view', 'id'=>$model->fci_radicado)); ?>
	<br />
	-->
</div>