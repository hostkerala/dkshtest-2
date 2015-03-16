<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'topic-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
)); ?>
<fieldset>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 128)); ?>

    <?php echo $form->textAreaRow($model, 'content', array('class' => 'span8', 'rows' => 5)); ?>

    <div class="control-group ">
        <?php echo $form->labelEx($model, 'topic_end',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
            array(
                'name' => 'Topic[topic_end]',
                'value' => (strtotime($model->topic_end)) ? date("m/d/Y", strtotime($model->topic_end)) : "",
                'language' => 'en-GB',
                'options' => array(
                    'dateFormat' => 'mm/dd/yy',
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'showButtonPanel' => 'true',
                    'constrainInput' => 'false',
                    'duration' => 'fast',
                    'showAnim' => 'slide',
                ),
            )
        );?>
        </div>
    </div>
    <div class="control-group">
        <?php echo CHtml::label('Skills', 'skills',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php
        $this->widget('bootstrap.widgets.TbSelect2', array(
            'asDropDownList' => false,
            'name' => 'Skills',
            'options' => array(
                'class' => 'TbSelect2',
                'tags' => Skill::getAllSkill(),
                'placeholder' => 'disciplines',
                'width' => '40%',
                'tokenSeparators' => array(',', ' ')
            )));
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                $("#Skills").val('<?php echo Skill::getTopicSkill($model->id);?>');
            });
        </script>
        </div>
    </div>
        <?php echo $form->dropDownListRow($model, 'category_id', CHtml::listData(Categories::model()->findAll(), 'id', 'name')); ?>

</fieldset>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Submit')); ?>
</div>

<?php $this->endWidget(); ?>
