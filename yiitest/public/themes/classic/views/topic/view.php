<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Create Topic', 'url'=>array('create')),
	array('label'=>'Update Topic', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Topic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);
?>

<h1>View Topic #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created_at',
		'topic_end',
		'user_id',
		'title',
		'status',
		'thumbnail',
	),
)); ?>

<hr>
<?php	if((((Yii::app()->user->id != $model->user_id) && ($postComment ))) || yii::app()->user->isAdmin) { //Admin Have all Rights?>
<h2>Comments <?php //echo count($model->comments); ?></h2>
	<?php	$this->renderPartial('comments/_form', array('model'=>$model, 'comment' => $comment)); ?>
<?php   } ?>

<?php $this->renderPartial('comments/_list', array('model'=>$model)); ?>
<?php if($authorTopics->totalItemCount && (Topic::isAuthor($model->id) || yii::app()->user->isAdmin)) : ?>
<h2> Other My Topics ( <?php echo $authorTopics->totalItemCount; ?>)</h2>
<?php $this->renderPartial('comments/_authorTopics',array('authorTopics'=>$authorTopics)) ?>
<?php endif; ?>
