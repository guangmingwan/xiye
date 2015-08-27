<?php
/* @var $this BjController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bjs',
);

$this->menu=array(
	array('label'=>'Create Bj', 'url'=>array('create')),
	array('label'=>'Manage Bj', 'url'=>array('admin')),
);
?>

<h1>Bjs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
