<?php
/* @var $this ZipareasController */
/* @var $model Zipareas */

$this->breadcrumbs=array(
	'Zipareases'=>array('index'),
	'Manage',
);
?>
<h1>Manage Cities</h1>

<div class="span8">
    <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add Cities',
            'url' => Yii::app()->createUrl('admin/zipareas/create'),
            'size' => 'large',
            'htmlOptions' => array('class' => 'pull-right'),
        ));
    ?>
    <br/>   <br/>    
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'zipareas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'zip',
		'state',
		'city',
		'latitude',
		'longitude',
		/*
		'old_lng',
		'old_lat',
		'updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</div>
