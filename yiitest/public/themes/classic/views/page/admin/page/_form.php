<div class="container-fluid">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'page-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row-fluid">
        <div class="pull-left span6">
            <?php echo $form->textFieldRow($model, 'title', array('class' => 'span11', 'maxlength' => 255)); ?>
        </div>
        <?php echo $form->dropDownListRow($model, 'status', Page::getStatusList(), array('class' => 'span3')); ?>
    </div>

    <?php echo $form->ckEditorRow($model, 'content', array('options' => array('fullpage' => 'js:true', 'width' => '640', 'resize_maxWidth' => '640', 'resize_minWidth' => '320'))); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        )); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>