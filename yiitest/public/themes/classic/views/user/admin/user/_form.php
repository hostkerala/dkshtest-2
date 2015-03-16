<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array('id' => 'user-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('autocomplete' => 'off'))
); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 128)); ?>


<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 128)); ?>


<?php echo $form->dropDownListRow(
                    $model,
                    'state_id',
                    CHtml::listData(
                        States::model()->findAllByAttributes(array('country_id' => 223)),
                        'state_code',
                        'state_name_en'
                    ),
                    array('class'=>'span5','prompt'=>'- Select State -',
    'ajax' => array(
    'url' => $this->createUrl('/user/user/AjaxGetCityList'),
    'success' => "function(html) {
                    $('#city_id').html(html);
//                    $('#city_id').html('$('#city_id option:first').text());
                   }",
    'data' => 'js:{state_code : $(this).val()}',
))

); ?>


    <?php echo CHtml::activeLabelEx($model, 'city_id') ?>


        <?php
        echo CHtml::activeDropDownList(
            $model, 'city_id', $model->userCityList, array(
                                               'class' => 'span5',
                                               'id' => 'city_id',
                                               'empty' => '- Select City -'
                                               )
        )
        ?>
        <?php echo CHtml::error($model, 'city_id'); ?>

<?php if($this->action->id == 'create'): ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span5')); ?>
<?php endif ?>
<?php echo $form->dropDownListRow($model, 'role', User::getRoles(),array('class'=>'span5')); ?>
<div class="form-actions">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array('buttonType' => 'submit', 'type' => 'primary', 'label' => $model->isNewRecord ? 'Create' : 'Save',)
    ); ?>
</div>

<?php $this->endWidget(); ?>
