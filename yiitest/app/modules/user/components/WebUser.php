<?php
/**
 * WebUser - represents the persistent state for a Web application user.
 * @package application.modules.user.components
 * @version  0.1
 */
class WebUser extends CWebUser
{

	/**
	 * @var User
	 */
	protected $_model;

	/**
	 *
	 * @var string
	 */
	public $theme;

	/**
	 * Load User
	 * @return User
	 */
	public function loadUser()
	{
		Yii::app()->getModule('user');
		if ($this->_model == null) {
			$this->_model = User::model()->findByPk(Yii::app()->user->id);
		}
		return $this->_model;
	}

	/**
	 * Check admin role
	 * @return boolean
	 */
	public function getIsAdmin()
	{

		$model = $this->loadUser();


		if ($model && $model->role == User::ROLE_ADMIN) {
			return true;
		}
		return false;
	}
}