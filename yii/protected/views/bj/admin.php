<?php
/* @var $this BjController */
/* @var $model Bj */

$this->breadcrumbs=array(
	'Bjs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'班级列表', 'url'=>array('index')),
	array('label'=>'创建班级', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bj-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理班级</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bj-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'bj_id',
		'bj_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
