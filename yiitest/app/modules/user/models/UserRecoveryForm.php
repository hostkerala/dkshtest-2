<?php
/**
 * @package application.modules.user.models
 * Date: 18.07.13
 * Time: 18:46
 */
class UserRecoveryForm extends CFormModel
{

	public $password;
	public $confirmPassword;


	/**
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('password, confirmPassword', 'required'),
			array('password', 'length', 'min' => 6),
			array('password', 'compare', 'compareAttribute' => 'confirmPassword'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'password' => 'Password',
			'confirmPassword' => 'Confirm Password',
		);
	}
}