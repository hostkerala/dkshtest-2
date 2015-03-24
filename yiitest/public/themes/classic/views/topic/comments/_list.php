<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>
<div id="comment-list">
	<?php foreach($model->comments as $comment): ?>
		<div class="row-fluid">
                    <div class="span2">        
                        <div class="col-sm-3 col-md-3">
                            <a href="#" class="thumbnail">
                                <?php
                                $user = User::model()->findByPk($comment->userId);
                                
                                ?>
                               <img src="<?php echo $user->avatar; ?>" 
                               alt="Photo">
                            </a>
                         </div>
                    </div>
                    <div class="span10"> 
                        <?php if(Topic::isAuthor($comment->topicId)) { ?>
                            <a href="<?php  echo yii::app()->createUrl('topic/DeleteComments',array('id'=>$comment->id))  ?>" class="btn btn-danger btn-lg pull-right">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>x
                            </a>
                        <?php  } ?>
			<?=CHtml::decode($comment->content)?><br>
			<span>By <strong><?=$comment->user->username?></strong> at <?=date('h:i, F, d Y', strtotime($comment->createdAt)); ?></span>
			<hr>
			<br>
                    </div>
		</div>
	<?php endforeach; ?>
</div>