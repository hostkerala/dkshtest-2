<?php
/* @var $this TopicController */
/* @var $model Topic */


?>

<?php $this->renderPartial('webroot.themes.classic.views.site.menu') ?>

<h1>Manage Topics</h1>




    <div class="span2">
        <br/>   <br/>        <br/>   <br/>
        <div class="bootstrap-widget">
        <?php
        if($showCategory)
        {
            $this->widget('bootstrap.widgets.TbTabs', array(
                    'type' => 'pills',
                    'tabs' => array(
                        array('label' =>  Categories::getLabelCategoriesFilter(), 'items' => Categories::getCategoriesFilterList())
                    ))
            );
        }
        ?>
        </div>
    </div>
    <div class="span8">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'My Topics',
            'url' => Yii::app()->createUrl('topic/mytopics'),
            'size' => 'large',
            'htmlOptions' => array('class' => 'btn-primary pull-left'),
        ));
        ?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Post a topic',
            'url' => Yii::app()->createUrl('topic/create'),
            'size' => 'large',
            'htmlOptions' => array('class' => 'pull-right'),
        ));
        ?>
        <br/>   <br/>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'type' => 'striped bordered condensed',
            'id' => 'topic-grid',
            'afterAjaxUpdate' => 'reinstallDatePickerAndAllDropDown',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'title',
                'content',

                array(
                    'name' => 'created_at',
                    'value' => 'date("m/d/Y", strtotime($data->created_at))',
                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'attribute' => 'created_at',
                        'model' => $model,
                        'options' => array(
                            'hideIfNoPrevNext' => true,
                        ),
                        'htmlOptions' => array(
                            'id' => 'datepicker_for_due_date',
                            'value' => (strtotime($model->created_at)) ? date('m/d/Y', strtotime($model->created_at)) : '',
                        ),
                    ), true)
                ),
                array(
                    'name' => 'skills',
                    'value' => 'Skill::getTopicSkill($data->id)',
                    'filter' => CHtml::activeDropDownList($model, 'skills', CHtml::listData(Skill::model()->findAll(), 'id', 'name'), array('empty' => 'All')),
                ),
                array(
                    'name' => 'topic_end',
                    'value' => 'date("m/d/Y", strtotime($data->topic_end))',
                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'attribute' => 'topic_end',
                        'model' => $model,
                        'options' => array(
                            'hideIfNoPrevNext' => true,
                        ),
                        'htmlOptions' => array(
                            'id' => 'datepicker_topic_end',
                            'value' => (strtotime($model->topic_end)) ? date('m/d/Y', strtotime($model->topic_end)) : '',
                        ),
                    ), true)
                ),
                array(
                    'htmlOptions' => array('nowrap' => 'nowrap'),
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{view} {update} {delete}'
                )
            ),
        ));
        Yii::app()->clientScript->registerScript('re-install-date-picker-and-allDropDown', "
                function reinstallDatePickerAndAllDropDown(id, data) {
                        $(function() {
                            $('#datepicker_topic_end,#datepicker_for_due_date').datepicker();
                        })
                    }
                ");
        ?>

    </div>




