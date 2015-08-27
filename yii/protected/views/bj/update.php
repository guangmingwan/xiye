<?php
/* @var $this BjController */
/* @var $model Bj */

$this->breadcrumbs=array(
	'Bjs'=>array('index'),
	$model->bj_id=>array('view','id'=>$model->bj_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bj', 'url'=>array('index')),
	array('label'=>'Create Bj', 'url'=>array('create')),
	array('label'=>'View Bj', 'url'=>array('view', 'id'=>$model->bj_id)),
	array('label'=>'Manage Bj', 'url'=>array('admin')),
);
?>

<h1>Update Bj <?php echo $model->bj_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>