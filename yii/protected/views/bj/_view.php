<?php
/* @var $this BjController */
/* @var $data Bj */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('bj_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->bj_id), array('view', 'id'=>$data->bj_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bj_name')); ?>:</b>
	<?php echo CHtml::encode($data->bj_name); ?>
	<br />


</div>