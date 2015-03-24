<?php
/* @var $this ZipareasController */
/* @var $model Zipareas */

$this->breadcrumbs=array(
	'Zipareases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Zipareas', 'url'=>array('index')),
	array('label'=>'Create Zipareas', 'url'=>array('create')),
	array('label'=>'View Zipareas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Zipareas', 'url'=>array('admin')),
);
?>

<h1>Update Zipareas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>