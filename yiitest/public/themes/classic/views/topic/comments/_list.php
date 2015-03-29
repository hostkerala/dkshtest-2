<?php
/* @var $this TopicController */
/* @var $model Topic */
/* @var $form CActiveForm */
?>

<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/flag-icon.min.css');
?>

<div id="comment-list">
	<?php foreach($model->comments as $comment): ?>               
		<div class="row-fluid">
                    <div class="span2 pull-left">
                        <?php
                        $user = User::model()->findByPk($comment->userId);                                
                        ?>
                        <img src="<?php echo $user->avatar; ?>" alt=".." class="img-rounded" height="150px" width="150px">
                    </div>
                    <div class="span10 pull-left"> 
                        <div class="span8 pull-left" >
                            <?php $user =  User::model()->findByPk($comment->userId) ?>
                            <?php $countryCode = Contries::model()->getCountrycode($user->state_id); ?>
                            <?php //date_default_timezone_set(yii::app()->params['timeZone']);  ?>
                            <h2 class="text-info"><?php echo $user->username ?>&nbsp;<div class="flag-icon flag-icon-<?php echo $countryCode ?> flag-style"></div>&nbsp;<small><?php echo Yii::app()->format->timeago(new DateTime($comment->createdAt)); ?></small></h2>
                        </div>             
                        <div class="span2 pull-right"> 
                            <?php if(Topic::isAuthor($comment->topicId) || yii::app()->user->isAdmin) {  //Admin Have all Rights ?> 
                                <a href="<?php  echo yii::app()->createUrl('topic/DeleteComments',array('id'=>$comment->id)); ?>" class="close" aria-label="Close"
                                <span aria-hidden="true">&times;</span>                           
                                </a>
                            <?php } ?> 
                        </div>
                    </div>
                    <hr>
                     <?php if(Topic::isAuthor($comment->topicId) || ($comment->userId == yii::app()->user->id) || yii::app()->user->isAdmin) { //Admin Have all Rights ?>
                    <div class="span10 pull-left text-justify">                       
                        <p class="text-muted"><?=CHtml::decode($comment->content)?></p>			                                          
                    </div>
                    <?php  }  else   { ?>
                    <div class="span10 pull-left text-justify">                       
                        <p class="text-muted">No access to read comments</p>	                                          
                    </div>
                        	
                    <?php } ?>
		</div>
                <hr>
		<br> 
                
	<?php endforeach; ?>
</div>
<style>
    .flag-style
    {        
        height:20px;
        width:20px; 
        vertical-align:middle;
    }
</style>   

<script type="text/javascript">
    
    $(document).ready(function() {        
        setInterval(ajaxCall, 30000); // Request in every 30 seconds
        function ajaxCall() {
            <?php echo CHtml::ajax(array(
                'url'=> CController::createUrl('topic/UpdateCommentsList',array('id'=>$model->id)),
                'type'=>'post',
                'update'=> '#comment-list',
            )) 
            ?>
        }
    }
    );
</script>
