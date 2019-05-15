<?php
/* @var $this MvcUsersController */
/* @var $model MvcUsers */
// $this->renderPartial('../comunes/mensajes');
?>
<br />
<p style="font-size: 24px !important;">Formato de Reporte Operación Inusual</p>

<?php 
// $this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
		// 'for_id',
        // // array(
            // // 'label'=>$model->getAttributeLabel('for_empresa_id'),
            // // 'value'=>$model->Empresa->emp_nombre,
        // // ),
	// ),
// ));

$this->renderPartial('_view',array('model'=>$model));

?>
