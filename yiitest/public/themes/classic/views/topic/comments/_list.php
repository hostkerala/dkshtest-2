<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>
<div id="comment-list">
	<?php foreach($model->comments as $comment): ?>
		<div class="row-fluid">
			<?=CHtml::decode($comment->content)?><br>
			<span>By <strong><?=$comment->user->username?></strong> at <?=date('h:i, F, d Y', strtotime($comment->createdAt)); ?></span>
			<hr>
			<br>
		</div>
	<?php endforeach; ?>
</div>