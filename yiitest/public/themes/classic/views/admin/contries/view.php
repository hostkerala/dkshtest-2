<?php
/* @var $this ContriesController */
/* @var $model Contries */

$this->breadcrumbs=array(
	'Contries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Contries', 'url'=>array('index')),
	array('label'=>'Create Contries', 'url'=>array('create')),
	array('label'=>'Update Contries', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Contries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contries', 'url'=>array('admin')),
);
?>

<h1>View Contries #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'country_iso_2',
		'country_iso_3',
		'country_name_en',
		'country_name_ru',
	),
)); ?>
