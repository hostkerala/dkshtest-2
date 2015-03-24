<?php
/* @var $this ZipareasController */
/* @var $model Zipareas */

$this->breadcrumbs=array(
	'Zipareases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Zipareas', 'url'=>array('index')),
	array('label'=>'Manage Zipareas', 'url'=>array('admin')),
);
?>

<h1>Create Zipareas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>