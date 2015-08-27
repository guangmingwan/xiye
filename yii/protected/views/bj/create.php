<?php
/* @var $this BjController */
/* @var $model Bj */

$this->breadcrumbs=array(
	'Bjs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'班级列表', 'url'=>array('index')),
	array('label'=>'管理班级', 'url'=>array('admin')),
);
?>

<h1>创建</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
