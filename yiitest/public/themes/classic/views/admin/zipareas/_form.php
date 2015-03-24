<?php
/* @var $this ZipareasController */
/* @var $model Zipareas */
/* @var $form CActiveForm */
?>
<div class="container-fluid">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'states-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div class="row-fluid">
        <div class="pull-left span6">           
        <?php echo $form->dropDownListRow($model,'country', CHtml::listData(Contries::model()->findAll(),'id','country_name_en'),
                                array(
                                'prompt'=>'Select Country',
                                'ajax' => array(
                                'type'=>'POST', 
                                'url'=>Yii::app()->createUrl('admin/zipareas/getStates'),
                                'update'=>'#Zipareas_state',
                                'data'=>array('country_id'=>'js:this.value'),
        ))); ?>
        </div>
        <div class="pull-left span6">
        <?php echo $form->dropDownListRow($model,'state',array(), array('prompt'=>'Select State')); ?>
        </div> 
    </div>
    
    <div class="row-fluid">
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'zip', CHtml::listData(Contries::model()->findAll(),'id','country_name_en')); ?>
        </div>
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'city', CHtml::listData(Contries::model()->findAll(),'id','country_name_en')); ?>
        </div> 
    </div>
    
    <div class="row-fluid">
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'latitude', CHtml::listData(Contries::model()->findAll(),'id','country_name_en')); ?>
        </div>
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'longitude', CHtml::listData(Contries::model()->findAll(),'id','country_name_en')); ?>
        </div> 
    </div>
    
    <div class="row-fluid">
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'old_lat', CHtml::listData(Contries::model()->findAll(),'id','country_name_en')); ?>
        </div>
        <div class="pull-left span6">
        <?php echo $form->textFieldRow($model,'old_lng', CHtml::listData(Contries::model()->findAll(),'id','country_name_en')); ?>
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