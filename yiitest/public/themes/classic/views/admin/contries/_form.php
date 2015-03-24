<div class="container-fluid">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'countries-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row-fluid">
        <div class="pull-left span6">
            <?php echo $form->textFieldRow($model,'country_iso_2',array('size'=>2,'maxlength'=>2)); ?>
            <?php //echo $form->textFieldRow($model, 'title', array('class' => 'span11', 'maxlength' => 255)); ?>
        </div>    
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'country_iso_3',array('size'=>3,'maxlength'=>3)); ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'country_name_en',array('size'=>60,'maxlength'=>64)); ?>
        </div>
        
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'country_name_ru',array('size'=>60,'maxlength'=>64)); ?>
        </div>
    </div>
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>