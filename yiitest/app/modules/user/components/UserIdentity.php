<?php

/**
 * UserIdentity - User Authenticate
 * @package application.modules.user.components
 */
class UserIdentity extends CUserIdentity
{

	const ERROR_USERNAME_INVALID = 100;
	const ERROR_PASSWORD_INVALID = 101;
	const ERROR_NONE = 777;

	protected $_id;
	public $errorCode;

	/**
	 * User Authenticate
	 * @return boolean
	 */
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array('username' => $this->username));

		if (!$user) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} elseif (!$user->checkPassword($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $user->id;
			$this->username = $user->username;
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode;
	}


	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}

	/**
	 * Manual user authentication (without verify)
	 *
	 */
	public function manualAuthenticate($id, $username)
	{
		$this->_id = $id;
		$this->username = $username;
	}

}