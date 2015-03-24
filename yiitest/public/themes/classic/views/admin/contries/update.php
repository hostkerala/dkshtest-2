<?php
/* @var $this ContriesController */
/* @var $model Contries */

$this->breadcrumbs=array(
	'Contries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contries', 'url'=>array('index')),
	array('label'=>'Create Contries', 'url'=>array('create')),
	array('label'=>'View Contries', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Contries', 'url'=>array('admin')),
);
?>

<h1>Update Contries <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>