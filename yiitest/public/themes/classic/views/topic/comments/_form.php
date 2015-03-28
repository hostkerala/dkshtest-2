<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'comment-form',
	'type' => 'horizontal',
	'enableAjaxValidation' => false,
)); ?>
	<fieldset>
		<div class="row-fluid">
			<div class="span12">
				<?php echo $form->errorSummary($comment); ?>

				<?php echo $form->hiddenField($comment, 'topicId', array('value' => $model->id)); ?>
				<?php echo $form->textArea($comment, 'content', array('class' => 'span12', 'rows' => 5, 'placeholder' => 'Write your comment here')); ?>
			</div>
		</div>
	</fieldset>

	<div class="form-actions">
		<?php
			$this->widget('bootstrap.widgets.TbButton',
				array(
					'buttonType' => 'submit',
					'type' => 'primary',
					'label' => 'Post comment',
					'htmlOptions' => array('class' => 'pull-right')
				));
		?>
	</div>

<?php $this->endWidget(); ?>