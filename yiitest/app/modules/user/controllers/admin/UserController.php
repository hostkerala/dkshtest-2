<?php

class UserController extends Controller
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
		return array('accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('index', 'view', 'create', 'update', 'LoginAs', 'admin', 'delete'), 'expression' => 'Yii::app()->user->isAdmin',),
			array('deny', // deny all users
				'users' => array('*')));
	}

	/**
	 * Index Action: display greed list of all users.
	 * Action: "/user/admin/user"
	 */
	public function actionIndex()
	{

		$this->breadcrumbs = array('Users');
		$dataProvider = new CActiveDataProvider('User');
		$dataProvider->pagination->pageSize = 50;
		$gridColumns = array(
			array('name' => 'id'),
			array('name' => 'username'),
			array('name' => 'email'),
			array('name' => 'role', 'value' => '$data->role == 1?"Admin":"User"'),
			array(
				'header' => 'Edit',
				'htmlOptions' => array('nowrap' => 'nowrap'),
				'class' => 'bootstrap.widgets.TbButtonColumn',
				'viewButtonUrl' => 'Yii::app()->createUrl(\'/user/admin/user/view\',array(\'id\'=>$data->id))',
				'updateButtonUrl' => 'Yii::app()->createUrl(\'/user/admin/user/update\',array(\'id\'=>$data->id))',
				'deleteButtonUrl' => 'Yii::app()->createUrl(\'/user/admin/user/delete\',array(\'id\'=>$data->id))',
			));
		$this->render(
			'index', array('dataProvider' => $dataProvider, 'gridColumns' => $gridColumns)
		);
	}

	/**
	 * Displays a particular model.
	 *
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->breadcrumbs = array('Users' => Yii::app()->createUrl('user/admin/user'), 'View');
		$this->render(
			'view', array('model' => $this->loadModel($id),)
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->breadcrumbs = array('Users' => Yii::app()->createUrl('/user/admin/user'), 'Create');
		$model = new User;
		$model->scenario = 'create';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (Yii::app()->request->getPost('User')) {
			$model->attributes = Yii::app()->request->getPost('User');
			if ($model->validate()) {
				$model->setHashPassword();
				if ($model->save()) {
					$this->redirect(array('view', 'id' => $model->id));
				}

			}
		}

		$this->render(
			'create', array('model' => $model)
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->breadcrumbs = array('Users' => Yii::app()->createUrl('/user/admin/user'), 'Update');
		$model = $this->loadModel($id);
		$postUser = Yii::app()->request->getPost('User');
		if ($postUser) {
			$model->attributes = $postUser;
			if ($model->validate()) {
				$model->save();
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array('model' => $model));
	}

	/**
	 * Admin ability: Login as any user
	 * */
	public function actionLoginAs($id)
	{
		$user = User::model()->findByPk($id);
		if (!$user) {
			throw new CHttpException('404', 'This user not exists');
		}
//        Yii::app()->user->setStateKeyPrefix('_user');
		$identity = new UserIdentity(false, false, $id);
		$identity->manualAuthenticate($user->id, $user->email);
		$duration = 0;
		Yii::app()->user->login($identity, $duration);
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(
					isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin')
				);
			}
		} else {
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}


	public function actionAdmin()
	{
		$model = new User('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['User'])) {
			$model->attributes = $_GET['User'];
		}

		$this->render(
			'admin', array('model' => $model,)
		);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = User::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 *
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
