<?php
/* @var $this MvcUsersController */
/* @var $model MvcUsers */
// $this->renderPartial('../comunes/mensajes');
?>
<br />
<p style="font-size: 24px !important;">Formato Línea Ética</p>

<?php 
// $this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
		// 'consulta_id',
        // // array(
            // // 'label'=>$model->getAttributeLabel('consulta_empresa_id'),
            // // 'value'=>$model->Empresa->emp_nombre,
        // // ),
	// ),
// ));

$this->renderPartial('_view',array('model'=>$model));

?>
