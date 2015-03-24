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
                        
                        $tmpName = $_FILES['avatar']['tmp_name'];
                        $fileName = $_FILES['avatar']['name'];
                        

                        if(isset($fileName))
                        {                    
                            $fileName = self::uploadFiles($fileName,$tmpName);

                            if(!$fileName) 
                            {                         
                                throw new CHttpException(400, 'Error::File uploading failed.');     
                                yii::app()->end();
                            }
                        }
                        $userModel->avatar = Yii::app()->getBaseUrl(true)."/uploads/users/".Yii::app()->user->getID()."/avatar/".$fileName;
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
            $folder=Yii::app() -> getBasePath() . "/../public/uploads/users/" . Yii::app()->user->getID() . '/avatar/';// folder for uploaded files
            $allowedExtensions = array("jpg","png","pdf");//array("jpg","jpeg","gif","exe","mov" and etc...
            $sizeLimit = 1 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);

            $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
            $fileName=$result['filename'];//GETTING FILE NAME
            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);

            echo $result;// it's array            


	}
        
        
        public static function uploadFiles($fileName,$tmpName)
        {
            try
            {
                $folderName  = yii::app()->params['uploadDir'].Yii::app()->user->getID().DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR;   
                //Make sure we have a filepath
                if ($tmpName != "")
                {                
                    if(!is_dir($folderName)) 
                    {                     
                          mkdir($folderName,0777);                                     
                    }
                    //Setup our new file path
                    $newFilePath = $folderName.$fileName;
                    
                    //Delete existing file
                    $files = glob($folderName.DIRECTORY_SEPARATOR."/*"); // get all file names
                    foreach($files as $file){ // iterate files
                      if(is_file($file))
                        unlink($file); 
                    }
                    //Upload the new file
                    move_uploaded_file($tmpName, $newFilePath);                
                }
            }
            catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
                return false;
            }
            return $fileName;
        } 
}