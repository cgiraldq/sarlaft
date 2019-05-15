<?php
/* @var $this HelpController */
/* @var $model Help */

$this->breadcrumbs=array(
		'Helps'=>array('index'),
		'Admin',
	);

$this->menu=array(
	array('label'=>'List Help', 'url'=>array('index')),
	array('label'=>'Create Help', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#help-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Helps</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'id'=>'help-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'responsiveTable' => true,
	'columns'=>array(
		'help_id',
		'controller',
		'action',
		'title',
		'content',
		'create_by',
		/*
		'create_date',
		'modified_by',
		'modified_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
