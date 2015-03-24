<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	'States'=>array('index'),
	'Create',
);

?>

<h1>Add States</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>