<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	'States'=>array('index'),
	'Manage',
);
?>

<h1>Manage States</h1>
<div class="span8">
    <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add States',
            'url' => Yii::app()->createUrl('admin/states/create'),
            'size' => 'large',
            'htmlOptions' => array('class' => 'pull-right'),
        ));
    ?>
    <br/>   <br/>    
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'states-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                    'id',
                    'state_code',
                    'country_id',
                    'state_name_en',
                    'state_name_ru',
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                    ),
            ),
    )); ?>
</div>
