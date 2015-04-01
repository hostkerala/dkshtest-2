<?php

class TopicController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('admin', 'create', 'update', 'delete', 'index', 'view', 'comment', 'deleteComments','mytopics','UpdateCommentsList'), 'users' => array('@'),
			),
			array(
				'deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$comment = new Comment;
		$model = $this->loadModel($id);
                $postComment = $comment->isAbletoComment(Yii::app()->user->id,$model->id);

		if (isset($_POST['Comment'])) {
			if((Yii::app()->user->id != $model->user_id) || (Yii::app()->user->isAdmin)){
				$comment->attributes = $_POST['Comment'];
				$comment->content = CHtml::encode($_POST['Comment']['content']);
				$comment->userId = Yii::app()->user->id;
				if ($comment->save())
					$this->redirect(Yii::app()->createUrl('topic/view', array('id'=>$id)));
			}
		}
                
                $criteria=new CDbCriteria(array(                    
                                'order'=>'id desc',
                                'condition'=>"user_id=$model->user_id AND id <> $model->id AND topic_end > UNIX_TIMESTAMP( CURDATE( ))"
                        ));

                $authorTopics=new CActiveDataProvider('Topic', array(
                    'criteria'=>$criteria,
                ));

		$this->render('view', array('model' => $model, 'comment' => $comment, 'postComment'=>$postComment, 'authorTopics'=>$authorTopics));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Topic;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Topic'])) {
			$model->attributes = $_POST['Topic'];
			if ($model->save())
				$this->redirect(array('topic/update/', 'id' => $model->id));
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (isset($_POST['Topic'])) {
			$model->attributes = $_POST['Topic'];
			$model->save();
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		
                $model = new Topic('search');
		$model->unsetAttributes(); // clear any default values

		$model->category_id = Yii::app()->request->getQuery('category_id');
		if (isset($_GET['Topic'])) {
			$model->attributes = $_GET['Topic'];
			$model->created_at = (strtotime($model->created_at)) ? date("Y-m-d", strtotime($model->created_at)) : "";
			$model->topic_end = (strtotime($model->topic_end)) ? date("Y-m-d", strtotime($model->topic_end)) : "";
		}

		$this->render('admin', array(
			'model' => $model, 'showCategory'=>true
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Topic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Topic::model()->with(array('comments'=>array('order'=>'comments.id DESC')))->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Topic $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'topic-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionDeleteComments($id)
	{
		$model = $this->loadModelCommentsModel($id);
                $model->delete();
                $this->redirect(yii::app()->createUrl('topic/view',array('id'=>$model->topicId)));
	}
        
        public function loadModelCommentsModel($id)
	{
		$model = Comments::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
        
         /**
	 * Manages My Topics.
	 */
	public function actionMyTopics()
	{
                $model = new Topic('search');
                $model->user_id = yii::app()->user->getId();
        	$model->category_id = Yii::app()->request->getQuery('category_id');
		if (isset($_GET['Topic'])) {
			$model->attributes = $_GET['Topic'];
			$model->created_at = (strtotime($model->created_at)) ? date("Y-m-d", strtotime($model->created_at)) : "";
			$model->topic_end = (strtotime($model->topic_end)) ? date("Y-m-d", strtotime($model->topic_end)) : "";
		}

		$this->render('admin', array(
			'model' => $model, 'showCategory'=>false
		));
	}
        
        public function actionUpdateCommentsList($id)
	{
		$comment = new Comment;
		$model = $this->loadModel($id);
                Yii::app()->clientScript->scriptMap=array('*.js'=>false, '*.min.js'=>false, '*.css'=>false); 
                echo $this->renderPartial('comments/_list', array('model'=>$model),false,true);
                yii::app()->end();
	
	}
        
        
}
