<?php
/* @var $this BjController */
/* @var $model Bj */

$this->breadcrumbs=array(
	'Bjs'=>array('index'),
	$model->bj_id,
);

$this->menu=array(
	array('label'=>'List Bj', 'url'=>array('index')),
	array('label'=>'Create Bj', 'url'=>array('create')),
	array('label'=>'Update Bj', 'url'=>array('update', 'id'=>$model->bj_id)),
	array('label'=>'Delete Bj', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->bj_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bj', 'url'=>array('admin')),
);
?>

<h1>View Bj #<?php echo $model->bj_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bj_id',
		'bj_name',
	),
)); ?>
