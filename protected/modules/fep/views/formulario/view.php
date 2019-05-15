<?php

/* @var $this MvcUsersController */
/* @var $model MvcUsers */
// $this->renderPartial('../comunes/mensajes');
?>

<?php 
// $this->widget('zii.widgets.CDetailView', array(
	// 'data'=>$model,
	// 'attributes'=>array(
		// 'fep_id',
        // // array(
            // // 'label'=>$model->getAttributeLabel('fep_empresa_id'),
            // // 'value'=>$model->Empresa->emp_nombre,
        // // ),
	// ),
// ));

if(isset($_GET["st"])){
	$this->renderPartial('_comite',array('model'=>$model));
}else{
$this->renderPartial('_view',array('model'=>$model));
}

?>
