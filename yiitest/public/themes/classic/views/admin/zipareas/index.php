<?php
/* @var $this ZipareasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Zipareases',
);

$this->menu=array(
	array('label'=>'Create Zipareas', 'url'=>array('create')),
	array('label'=>'Manage Zipareas', 'url'=>array('admin')),
);
?>

<h1>Zipareases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
