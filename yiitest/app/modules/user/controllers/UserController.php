<?php

class UserController extends Controller
{
	public $layout = '//layouts/main';

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionAjaxGetCityList()
	{
		$request = Yii::app()->request;
		if (!$request->isAjaxRequest) {
			Yii::app()->end;
		}
		$state_code = $request->getQuery('state_code');

		$criteria = new CDbCriteria();
		$criteria->group = 't.city';
		$cityModel = Zipareas::model()->findAllByAttributes(array('state' => $state_code), $criteria);
		echo CHtml::tag('option', array('value' => ''), '- Select City -');
		foreach ($cityModel as $city) {
			echo CHtml::tag('option', array('value' => $city['id']), CHtml::encode($city['city']), true);
		}
		Yii::app()->end();
	}

	/**
	 * User Settings profile
	 */
	public function actionSettingsProfile()
	{
		$this->breadcrumbs = array('Profile Settings');

		$userModel = User::model()->findByPk(Yii::app()->user->id);
		$changePasswordModel = new UserChangePassword;

		#Change Pass
		$changePasswordPost = Yii::app()->request->getPost('UserChangePassword');
		if ($changePasswordPost) {
			$userModel->skills = $userModel->userSkillsString;
			$changePasswordModel->attributes = $changePasswordPost;
			$changePasswordModel->user = $userModel;
			if ($changePasswordModel->validate()) {
				$userModel->password = $changePasswordModel->passwd;
				$userModel->setHashPassword();
				if ($userModel->save()) {
					Yii::app()->user->setFlash('success', 'Your password has been changed successfully');
					$this->refresh();
				}
			}
		}

		#Change User info

		$cityArray = $userModel->getUserCityList();
		$userPostData = Yii::app()->request->getPost('User');

		if ($userPostData) {
			$userModel->attributes = $userPostData;
			$userModel->skills = Yii::app()->request->getPost('Skills');

			if ($userModel->save()) {
				Yii::app()->user->setFlash('success', 'Your contact information has been saved successfully');
			}
		}
		#render View
		$this->render('settings_profile', compact('userModel', 'changePasswordModel', 'cityArray'));
	}

	public function actionAjaxUploadAvatar()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");


		$folder = 'uploads/users/' . Yii::app()->user->getID() . '/avatar/'; // folder for uploaded files
		$allowedExtensions = array("jpg"); //array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 10 * 1024 * 1024; // maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

		$fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
		$fileName = $result['filename']; //GETTING FILE NAME

		echo $return; // it's array

	}
}