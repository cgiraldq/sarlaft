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
?>

<!-- <h1>Formato Líne Ética</h1> -->

<?php $this->renderPartial('_form', array('model'=>$model,'row_parametros'=>$row_parametros)); ?>
