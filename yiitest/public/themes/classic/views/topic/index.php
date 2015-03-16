<?php
/* @var $this TopicController */
/* @var $dataProvider CActiveDataProvider */

?>

<h1>Topics</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
