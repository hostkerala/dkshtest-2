<?php

class SiteController extends Controller
{
	public $layout = '//layouts/main';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'accessRules',
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array(
				'allow',
				'actions' => array('admin'),
				'expression' => 'Yii::app()->user->isAdmin'
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('users', 'index', 'autocompleteSkillSet'),
				'users' => array('@'),
			),
			array(
				'deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Display admin
	 */
	public function actionAdmin()
	{
		$this->breadcrumbs = array('Home');
		$this->layout = '//layouts/admin';
		$this->render('admin/index');
	}

	/**
	 * List users
	 */
	public function actionUsers()
	{
		Yii::app()->getModule('user');
		$dataProvider = new CActiveDataProvider('User', array('pagination' => array('pageSize' => 2)));
		if (Yii::app()->request->getQuery('skill')) {
			$skill = Skill::model()->findByAttributes(array('name' => Yii::app()->request->getQuery('skill')));
			if ($skill) {
				$dataProvider->criteria->join = 'JOIN rel_user_skills t1 ON t.id = t1.user_id';
				$dataProvider->criteria->compare('t1.skill_id', $skill->id);
			}
		}

		$this->render('users', array('dataProvider' => $dataProvider));
	}

	/**
	 * Autocomplete suggest options
	 */
	public function actionAutocompleteSkillSet()
	{
		$res = array();

		if (isset($_GET['term'])) {
			$sql = "SELECT name FROM skill WHERE name LIKE :name";
			$command = Yii::app()->db->createCommand($sql);
			$command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
			$res = $command->queryColumn();
		}

		echo CJSON::encode($res);
		Yii::app()->end();
	}

}