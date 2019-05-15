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
<div class="well">
<h1>Formato Consulta Sarlaft</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'datos'=>$datos,'row_parametros'=>$row_parametros)); ?>
</div>