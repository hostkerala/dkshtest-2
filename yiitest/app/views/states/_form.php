<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'states-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'state_code'); ?>
		<?php echo $form->textField($model,'state_code',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'state_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php echo $form->textField($model,'country_id'); ?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state_name_en'); ?>
		<?php echo $form->textField($model,'state_name_en',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'state_name_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state_name_ru'); ?>
		<?php echo $form->textField($model,'state_name_ru',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'state_name_ru'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->