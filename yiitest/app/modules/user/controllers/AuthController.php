<?php

/**
 * AuthController
 *
 * @package  application.modules.user.controllers
 * @version  0.1
 * @author Ionut Titei
 */
class AuthController extends Controller
{
	public $layout = '//layouts/main';
	/**
	 * User Login
	 */
	public function actionLogin()
	{
		$this->breadcrumbs = array('Login');
		$model = new UserLoginForm;
		if (Yii::app()->user->isGuest) {			
			if (Yii::app()->request->getPost('UserLoginForm')) {
				$model->attributes = Yii::app()->request->getPost('UserLoginForm');
				if ($model->validate()) {
					$this->redirect(Yii::app()->homeUrl);
				}
			}
			$this->render('form_login', array('model' => $model));
		}else
			$this->redirect(Yii::app()->createUrl(''));		
	}
	/**
	 * Logout User
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	/**
	 * Register new user
	 */
	public function actionRegister()
	{
		$this->breadcrumbs = array('Register');
		$model = new User;
		$model->scenario = 'create';


		if (Yii::app()->request->getPost('User')) {
			$model->attributes = Yii::app()->request->getPost('User');
                        $model->role = User::ROLE_USER; // Sets default role as user when signup

			if ($model->validate()) {

				$login = new UserLoginForm();
				$login->attributes = $model->attributes; //If all data is correct: automatically  logged in  user
                                
                                $model->setHashPassword(); // Hash password
				if ($model->save())
					$login->validate();
				Yii::app()->user->setFlash('success', 'Congratilations you are has been registered!');
				$this->redirect(Yii::app()->homeUrl);
			}
		}

		$this->render(
			'register', array('model' => $model)
		);

	}
	/**
	 * Request for password recovery
	 */
	public function actionForgot()
	{
		$request = Yii::app()->request;
		$forgotPostData = $request->getPost('UserForgotForm');

		$model = new UserForgotForm();
		if ($forgotPostData) {
			$model->attributes = $forgotPostData;
			if ($model->validate()) {
				$user = User::model()->findByAttributes(array(
					'email' => $model->email));
				$user->secret_key = md5(rand() . microtime());
				$user->save(FALSE);
				$activationUrl = Yii::app()->createAbsoluteUrl('/user/auth/recovery', array(
						"key" => $user->secret_key,
						"email" => $user->email
					)
				);
				$mail = new YiiMailer('forgot_password', array('activationUrl' => $activationUrl, 'user' => $user));
				$mail->setFrom('yiioverflow@gmail.com', 'Roopan');
				$mail->setTo($user->email);
				$mail->setSubject('Request password recovery.');
				if ($mail->send()) {
					Yii::app()->user->setFlash('success', 'Further instructions have been sent to your email address.');
				} else {
					Yii::app()->user->setFlash('error', 'Error, please try again later');
				}
				$this->redirect(Yii::app()->createUrl('site/users'));
			}
		}

		$this->render('forgot', array(
			'model' => $model));
	}
	/**
	 * Recover password
	 */
	public function actionRecovery()
	{
		$request = Yii::app()->request;
		$email = $request->getQuery('email');
		$key = $request->getQuery('key');
		$recoveryPostData = $request->getPost('UserRecoveryForm');

		$user = User::model()->findByAttributes(
			array(
				'email' => $email,
				'secret_key' => $key)
		);
		if (!$user) {
			Yii::app()->user->setFlash('success', "Incorrect activation code. Try requesting password recovery again");
			$this->redirect(Yii::app()->createUrl('site/users'));
		}
		$model = new UserRecoveryForm;
		if ($recoveryPostData) {
			$model->attributes = $recoveryPostData;
			if ($model->validate()) {
				$user->password = $model->password;
				$user->setHashPassword();
				$user->secret_key = NULL;
				$user->save(FALSE);
				Yii::app()->user->setFlash('success', "Password successfully changed");
				$this->redirect(Yii::app()->createUrl('site/users'));
			}
		}
		$this->render('recovery', array(
			'model' => $model));
	}

	/**
	 * Action only for the login from third-party authentication providers, such as Google, Facebook etc. Not for direct login using username/password
	 */
	public function actionHybridLogin()
	{
		if (!isset($_GET['provider']))
		{
			$this->redirect(Yii::app()->homeUrl);
			return;
		}
		
		try 
		{
			$haComp = new HybridAuthIdentity();
			if (!$haComp->validateProviderName($_GET['provider']))
				throw new CHttpException ('500', 'Invalid Action. Please try again.');	
			
			$haComp->adapter = $haComp->hybridAuth->authenticate($_GET['provider']);
			$haComp->userProfile = $haComp->adapter->getUserProfile();
                       

			$userData = array();
			$userData['username'] = $haComp->userProfile->displayName;
			$userData['email'] = $haComp->userProfile->email;
			$userData['password'] = $haComp->userProfile->email;
                        $userData['avatar'] = $haComp->userProfile->photoURL;                       

			$this->processHybridLogin($userData);  //further action based on successful login or re-direct user to the required url
		}
		catch (Exception $e)
		{			
			//process error message as required or as mentioned in the HybridAuth 'Simple Sign-in script' documentation
			Yii::app()->user->setFlash('error', $e->getMessage());
			$model = new UserLoginForm;
			$this->render('form_login', array('model' => $model));
			return;
		}
	}
	/**
	 * Process the login data from an external application
	 * @param Array $data the user data having username, email and password
	 */	
	public function processHybridLogin($data = array())
	{
		$user = User::model()->findByAttributes(array('email'=>$data['email']));

		if(!$user){
		
			// we need to register the user
			$model = new User;
			$model->scenario = 'create';
			
			$data['username'] = HybridAuthIdentity::generateUsername($data['username']);
				
			$model->username = $data['username'];
			$model->email = $data['email'];
			$model->password = $data['password'];
                        $model->avatar = $data['avatar'];
			
			if ($model->validate()) {

				$login = new UserLoginForm();
				$login->attributes = $model->attributes; //If all data is correct: automatically  logged in  user
				$login->remember = false;

				$model->setHashPassword(); // Hash password

				if ($model->save()){
					$login->validate();
					Yii::app()->user->setFlash('success', 'Congrats you have been registered!');
				}else					
					Yii::app()->user->setFlash('error', CVarDumper::dumpAsString($model->getErrors()));							

			}else{
				Yii::app()->user->setFlash('error', 'Invalid data!');
			}
			
			$this->redirect(Yii::app()->homeUrl);
			
		}else{
			
			// we are just logging in
			$login = new UserLoginForm;
			$login->username = $user->username;
			$login->password = $data['password'];
			$login->remember = false;

			if (!$login->validate()) {
				Yii::app()->user->setFlash('error', 'Credentials are not valid!');
			}
			
			$this->redirect(Yii::app()->createUrl('site/users'));
			
		}
	}
	/**
	 * External appy callback action
	 */
	public function actionSocialLogin()
	{
		Yii::import('application.components.HybridAuthIdentity');
		$path = Yii::getPathOfAlias('vendors.HybridAuth');
		require_once $path . '/hybridauth-' . HybridAuthIdentity::VERSION . '/hybridauth/index.php';
	}
}