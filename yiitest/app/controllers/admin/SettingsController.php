<?php

class SettingsController extends Controller
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
	 *
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(array('allow', // allow all users to perform 'index' and 'view' actions
			'actions' => array('index','contries'), 'users' => array('@'),),
//                     array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                           'actions' => array('create', 'update'), 'users' => array('@'),),
//                     array('allow', // allow admin user to perform 'admin' and 'delete' actions
//                           'actions' => array('admin', 'delete'), 'users' => array('admin'),),
			array('deny', // deny all users
				'users' => array('*'),),);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex()
	{

		$this->breadcrumbs = array('Settings');
		$dataProvider = new CActiveDataProvider('Config');
		$dataProvider->pagination->pageSize = 50;
		$this->render('view', array('dataProvider' => $dataProvider));
	}
        
        public function actionContries()
	{
            $this->breadcrumbs = array('Settings/Countries');
            $model=new Contries('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Contries']))
                    $model->attributes=$_GET['Contries'];

            $this->render('contries/admin',array(
                    'model'=>$model,
            ));
	}
        
        public function actionStates()
	{
            $this->breadcrumbs = array('Settings/States');
            $dataProvider = new CActiveDataProvider('Config');
            $dataProvider->pagination->pageSize = 50;
            $this->render('view', array('dataProvider' => $dataProvider));
	}


}
