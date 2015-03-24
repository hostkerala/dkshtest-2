<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>
<div id="comment-list">
	<?php foreach($model->comments as $comment): ?>
                <?php if(Topic::isAuthor($comment->topicId) || ($comment->userId == yii::app()->user->id)) { ?>
		<div class="row-fluid">
                    <div class="span2 pull-left">        
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
                    <div class="span10 pull-left" style="height:10%"> 
                        <div class="span4 pull-left">
                            <?php $user =  User::model()->findByPk($comment->userId) ?>
                            <h3 style="color:#3366FF"><?php echo $user->username ?></h3>
                        </div>

                        <div class="span4 pull-left"> 
                            <h6><?php echo $comment->createdAt;  ?></h6>
                        </div>
                        <div class="span2 pull-right"> 
                        <?php if(Topic::isAuthor($comment->topicId)) { ?>
                            <a href="<?php  echo yii::app()->createUrl('topic/DeleteComments',array('id'=>$comment->id))  ?>" class="btn btn-danger btn-lg pull-right">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>x
                            </a>
                        <?php  } ?>  
                        </div>
                    </div>
                    
                    <div class="span10 pull-left" style="height:90%">                       
			<?=CHtml::decode($comment->content)?><br>
			<span>By <strong><?=$comment->user->username?></strong> at <?=date('h:i, F, d Y', strtotime($comment->createdAt)); ?></span>                                          
                    </div>
		</div>
                <?php  } ?>
                <hr>
		<br> 
	<?php endforeach; ?>
</div>