<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Contries'=>array('index'),
	'Manage',
);

?>

<h1>Manage Contries</h1>
    <div class="span8">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add Contries',
            'url' => Yii::app()->createUrl('admin/contries/create'),
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
            	'columns'=>array(
		'id',
		'country_iso_2',
		'country_iso_3',
		'country_name_en',
		'country_name_ru',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	)
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