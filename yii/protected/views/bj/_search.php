<?php
/* @var $this BjController */
/* @var $model Bj */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'bj_id'); ?>
		<?php echo $form->textField($model,'bj_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bj_name'); ?>
		<?php echo $form->textField($model,'bj_name',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->