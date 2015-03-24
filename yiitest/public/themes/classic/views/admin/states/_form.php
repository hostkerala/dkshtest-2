<div class="container-fluid">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'states-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row-fluid">
        <div class="pull-left span6">
        <?php echo $form->dropDownListRow($model,'country_id', CHtml::listData(Contries::model()->findAll(),'id','country_name_en')); ?>
        </div>
        <div class="pull-left span6">
            <?php echo $form->textFieldRow($model,'state_code',array('size'=>60,'maxlength'=>64)); ?>           
        </div>  
    </div>
    <div class="row-fluid">      
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'state_name_en',array('size'=>60,'maxlength'=>64)); ?>
        </div>
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'state_name_ru',array('size'=>60,'maxlength'=>64)); ?>
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