<?php
/* @var $this ZipareasController */
/* @var $model Zipareas */

$this->breadcrumbs=array(
	'Zipareases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Zipareas', 'url'=>array('index')),
	array('label'=>'Create Zipareas', 'url'=>array('create')),
	array('label'=>'Update Zipareas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Zipareas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Zipareas', 'url'=>array('admin')),
);
?>

<h1>View Zipareas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'zip',
		'state',
		'city',
		'latitude',
		'longitude',
		'old_lng',
		'old_lat',
		'updated',
	),
)); ?>
