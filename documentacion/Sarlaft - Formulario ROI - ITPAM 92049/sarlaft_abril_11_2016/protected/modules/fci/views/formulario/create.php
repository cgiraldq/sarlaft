<?php
/* @var $this MvcUsersController */
/* @var $model MvcUsers */

// $this->breadcrumbs=array(
	// 'Formulario'=>array('index'),
	// 'Create',
// );

// $this->menu=array(
	// array('label'=>'List MvcUsers', 'url'=>array('index')),
	// array('label'=>'Manage MvcUsers', 'url'=>array('admin')),
// );
	if(isset($msjauth) && $msjauth!=""){
									echo '<div class="errorSummary" style="text-align:center !important">'.$msjauth.'</div>';
									}
?>

<!-- <h1>Formato Conflicto de Intereses</h1> -->

<?php $this->renderPartial('_form', array('model'=>$model,'model_persona'=>$model_persona,'row_parametros'=>$row_parametros)); ?>
