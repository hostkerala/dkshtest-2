<?php
/* @var $this ContriesController */
/* @var $model Contries */

$this->breadcrumbs=array(
	'Contries'=>array('index'),
	'Create',
);
?>

<h1>Create Contries</h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>