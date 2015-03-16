<?php $form = $this->beginWidget(
	'bootstrap.widgets.TbActiveForm',
	array('id' => 'login-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('autocomplete' => 'off'))
); ?>

	<div class="row-fluid">
		<div class="span6">
			<p class="help-block">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>
			<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 128)); ?>
			<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span5')); ?>
			<?php echo $form->checkboxRow($model, 'remember'); ?>

		</div>
		<div class="span6">
			<?php	if(Yii::app()->user->isGuest):?>
			<div>
				<a href="<?=Yii::app()->createUrl('user/auth/hybridLogin', array('provider'=>'google'))?>"><img src="<?=Yii::app()->baseUrl?>/img/buttons/google.png" /></a>
				<br/>
				<a href="<?=Yii::app()->createUrl('user/auth/hybridLogin', array('provider'=>'facebook'))?>" ><img src="<?=Yii::app()->baseUrl?>/img/buttons/facebook.png"  /></a>
			</div>
			<?php	endif;?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="form-actions">
			<?php $this->widget(
				'bootstrap.widgets.TbButton',
				array('buttonType' => 'submit', 'label' => 'Login', 'type'=>'primary')
			); ?>
			<?php echo CHtml::link('Forgot your password?', Yii::app()->createUrl('/user/auth/forgot')) ;?>
		</div>

	</div>
<?php $this->endWidget(); ?>