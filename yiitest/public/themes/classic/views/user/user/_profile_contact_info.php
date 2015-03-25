<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/fileuploader/js/fileinput.min.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/js/fileuploader/css/fileinput.min.css');
?>

<script type="text/javascript">
    $(function () {
        $('#Skills').val('<?php echo $userModel->userSkillsString ?>')
    })
</script>
<div class="container-fluid">
    <div class="span7 ">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'settingsProfileForm',
            'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        )); ?>
        <?php echo $form->textFieldRow($userModel, 'email'); ?>
        <?php echo $form->textFieldRow($userModel, 'username'); ?>
        
        
    <div class="row-fluid">
        <div class="pull-left span6"> 
        
        <?php
               if($userModel->state_id)
               {                   
                   $countryList = Contries::model()->getCountryNameFromStateId($userModel->state_id);
                   $userModel->country = States::model()->with('country')->findByPk($userModel->state_id)->country->id;
                   $statesList  = CHtml::listData(States::model()->findAllByAttributes(array('country_id'=>$userModel->country)),'id','state_name_en');                   
               }
               else
               {
                   $countryList = CHtml::listData(Contries::model()->findAll(),'id','country_name_en');
                   $statesList  = array();
                   
               }
        ?>
        <div class="col-sm-6 col-md-3">
           <a href="#" class="thumbnail">
              <img src="<?php echo $userModel->avatar; ?>" 
              alt="...">
           </a>
        </div>   
            
       <input name="avatar" id="avatar" type="file" class="file" data-preview-file-type="text" >
            
        <?php echo $form->dropDownListRow($userModel,'country',$countryList,
                                array(
                                'prompt'=>'Select Country',
                                'ajax' => array(
                                'type'=>'POST', 
                                'url'=>Yii::app()->createUrl('admin/zipareas/getStates'),
                                'update'=>'#User_state_id',
                                'data'=>array('country_id'=>'js:this.value'),
        )));?>
        <?php echo $form->dropDownListRow($userModel,'state_id',$statesList, array(
                        'prompt' => '- Select State -',
                        'ajax' => array(
                            'url' => $this->createUrl('/user/user/AjaxGetCityList'),
                            'update'=>'#city_id',
                            //'success' => "function(html) {
                            //$('#city_id').html(html);
        //                    $('#city_id').html('$('#city_id option:first').text());
                           //}",
                            'data' => 'js:{state_code : $(this).val()}',
                        ))            
                    ); ?>
        </div> 
    </div>        

        <?php echo $form->dropDownListRow($userModel, 'city_id', $userModel->userCityList,
            array(
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
                        'width' => '43%',
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

<script>
// initialize with defaults
$("#avatar").fileinput();

// with plugin options
$("#avatar").fileinput({'showUpload':false, 'previewFileType':'any'});
</script>    