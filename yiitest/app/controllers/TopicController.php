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
				'actions' => array('admin', 'create', 'update', 'delete', 'index', 'view', 'comment'), 'users' => array('@'),
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

		if (isset($_POST['Comment'])) {
			if(Yii::app()->user->id != $model->user_id){
				$comment->attributes = $_POST['Comment'];
				$comment->content = CHtml::encode($_POST['Comment']['content']);
				$comment->userId = Yii::app()->user->id;
				if ($comment->save())
					$this->redirect(Yii::app()->createUrl('topic/view', array('id'=>$id)));
			}
		}

		$this->render('view', array('model' => $model, 'comment' => $comment));
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
			'model' => $model,
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
		$model = Topic::model()->findByPk($id);
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
}
