<?php
/* @var $this TopicController */
/* @var $model Topic */



?>
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Topics',
    'url' => Yii::app()->createUrl('topic/index'),
    'size' => 'large'
));
?>
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Post a topic',
    'url' => Yii::app()->createUrl('topic/create'),
    'size' => 'large',
    'htmlOptions'=>array('class'=>'pull-right'),
));
?>

<h1>Update Topic: <?php echo $model->title; ?></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>