<?php
/**
 * @package application.modules.user.models
 * @version  0.1
 */
class UserForgotForm extends CFormModel
{

	public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('email', 'required'),
			array('email', 'exist', 'className' => 'User'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email' => "Your email",
		);
	}

}