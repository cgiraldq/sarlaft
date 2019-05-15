<?php
/* @var $this MvcUsersController */
/* @var $model MvcUsers */
// $this->renderPartial('../comunes/mensajes');
?>

<?php 
// $this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
		// 'fci_id',
        // // array(
            // // 'label'=>$model->getAttributeLabel('fci_empresa_id'),
            // // 'value'=>$model->Empresa->emp_nombre,
        // // ),
	// ),
// ));
//var_dump($model);DIE;
$this->renderPartial('_view',array('model'=>$model));

?>
