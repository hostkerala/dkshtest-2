<script type="text/javascript">
    $(function () {
        $('#Skills').val('<?php echo $userModel->userSkillsString ?>')
    })
</script>
<div class="container-fluid">
    <div class="span7 ">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'settingsProfileForm',
        )); ?>
        <?php echo $form->textFieldRow($userModel, 'email'); ?>
        <?php echo $form->textFieldRow($userModel, 'username'); ?>
        <?php echo $form->dropDownListRow(
            $userModel,
            'state_id',
            CHtml::listData(States::model()->findAllByAttributes(array('country_id' => 223)),
                'state_code',
                'state_name_en'
            ),
            array('class' => 'span5',
                'prompt' => '- Select State -',
                'ajax' => array(
                    'url' => $this->createUrl('/user/user/AjaxGetCityList'),
                    'success' => "function(html) {
                    $('#city_id').html(html);
//                    $('#city_id').html('$('#city_id option:first').text());
                   }",
                    'data' => 'js:{state_code : $(this).val()}',
                ))

        ); ?>
        <?php echo $form->dropDownListRow($userModel, 'city_id', $userModel->userCityList,
            array('class' => 'span5',
                'id' => 'city_id',
                'empty' => '- Select City -'
        )); ?>
        <!--Select Skill Set-->

        <div class="control-group">
            <?php echo CHtml::label('Select Skills', 'skills', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => false,
                    'name' => 'Skills',
                    'options' => array(
                        'tags' => Skill::getAllSkill(),
                        'placeholder' => 'disciplines',
                        'width' => '40%',
                        'tokenSeparators' => array(',', ' ')
                    ))); ?>
            </div>
        </div>
        <?php $this->widget('bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Update',
            )); ?>
        <?php $this->endWidget(); ?>
    </div>

    <div class="span4">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'settingsProfilePasswordForm',
        )); ?>

        <?php echo $form->passwordFieldRow($changePasswordModel, 'oldPassword'); ?>
        <?php echo $form->passwordFieldRow($changePasswordModel, 'passwd'); ?>

        <?php $this->widget('bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Update Password',
            )); ?>
        <?php $this->endWidget(); ?>
    </div>
</div>