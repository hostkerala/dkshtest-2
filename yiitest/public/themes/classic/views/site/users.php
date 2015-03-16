
<?php $this->renderPartial('webroot.themes.classic.views.site.menu') ?>

<div class="row-fluid">
    <h4>Filter By Skill</h4>
<?php
echo CHtml::beginForm($this->createUrl('/site/users'),'get',array('id'=>'skillFilter'));
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                                  'name'=>'skill',
                                                  'value'=>'',
                                                  'source'=>$this->createUrl('/site/autocompleteSkillSet'),
                                                  'options'=>array(
                                                      'change'=>"js:function(event, ui) {
                                                         $('#skillFilter').submit()
                                                        }",
                                                  ),
                                                  'htmlOptions'=>array(
                                                      'placeholder'=>'begin write skill..',
                                                  ),
                                                  ));
echo CHtml::endForm();
?>

    <?php
    if(Yii::app()->request->getQuery('skill')){
    $this->widget(
        'bootstrap.widgets.TbButton',
        array('label' => 'Reset Filter',
              'size' => 'small',
              'url'=>$this->createUrl('site/users'),
              'type'=>'success'
        )
    );
    }
    ?>

    Specialization: <?php echo Yii::app()->request->getQuery('skill')?Yii::app()->request->getQuery('skill'): 'All'; ?>
<?php
$this->widget(
    'zii.widgets.CListView',
    array('dataProvider'       => $dataProvider, 'itemView' => '_user', // refers to the partial view named '_post'
          'sortableAttributes' => array(
              'username' => 'User Name',
              'state_id' => 'State'
          ),)
);
?>