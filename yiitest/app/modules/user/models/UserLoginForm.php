<?php
/**
 * @property string $email
 * @property string $password
 * @property bool $remember
 */
class UserLoginForm extends CFormModel
{

	public $username;
	public $password;
	public $remember = true;


	/**
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('username, password', 'required'),
			array('username', 'length', 'max' => 255),
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Username',
			'password' => 'Password',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$identity = new UserIdentity($this->username, $this->password);
			$identity->authenticate();

			switch ($identity->errorCode) {
				case UserIdentity::ERROR_NONE:
					$duration = $this->remember ? 3600 * 24 * 30 : 0; // 30 days
					Yii::app()->user->login($identity, $duration);
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError('username', 'Incorrect username');
					break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError('password', 'Incorrect password');
					break;
			}
		}
	}


}