<?php

class ZipareasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/admin';

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
		return array(array('allow', // allow all users to perform 'index' and 'view' actions
			'actions' => array('index','update','create','delete','view','contries','getStates'), 'users' => array('@'),),
			array('deny', // deny all users
				'users' => array('*'),),);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Zipareas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Zipareas']))
		{
			$model->attributes=$_POST['Zipareas'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Zipareas']))
		{
			$model->attributes=$_POST['Zipareas'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
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
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Zipareas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Zipareas']))
			$model->attributes=$_GET['Zipareas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Zipareas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Zipareas']))
			$model->attributes=$_GET['Zipareas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Zipareas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Zipareas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Zipareas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='zipareas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
	/**
	 * Get States Lists from country Id
	 */
	public function actiongetStates()
	{
            $data=States::model()->findAll('country_id=:country_id', 
                          array(':country_id'=>(int) $_POST['country_id']));

            $data=CHtml::listData($data,'id','state_name_en');
            echo CHtml::tag('option', array('value' => ''), '-Select a State-', true);
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option',
                           array('value'=>$value),CHtml::encode($name),true);
            }
	}        
}
