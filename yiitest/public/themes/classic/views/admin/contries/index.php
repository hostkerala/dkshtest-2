<?php
/* @var $this ContriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contries',
);

$this->menu=array(
	array('label'=>'Create Contries', 'url'=>array('create')),
	array('label'=>'Manage Contries', 'url'=>array('admin')),
);
?>

<h1>Contries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
