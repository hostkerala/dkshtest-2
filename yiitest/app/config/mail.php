<?php

/**
* Created By Roopan v v <yiioverflow@gmail.com>
* Date : 17-03-2015
* Time :08:08 PM
* Mail Configuration file for Yiimailer Extension
*/

return array(
	'viewPath' => 'webroot.themes.classic.views.mail',
	'layoutPath' => 'webroot.themes.classic.views.layouts',
	'baseDirPath' => 'webroot.images.mail', //note: 'webroot' alias in console apps may not be the same as in web apps
	'savePath' => 'webroot.assets.mail',
	'testMode' => false,
	'layout' => 'mail',
	'CharSet' => 'UTF-8',
	'AltBody' => Yii::t('YiiMailer', 'You need an HTML capable viewer to read this message.'),
	'language' => array(
		'authenticate' => Yii::t('YiiMailer', 'SMTP Error: Could not authenticate.'),
		'connect_host' => Yii::t('YiiMailer', 'SMTP Error: Could not connect to SMTP host.'),
		'data_not_accepted' => Yii::t('YiiMailer', 'SMTP Error: Data not accepted.'),
		'empty_message' => Yii::t('YiiMailer', 'Message body empty'),
		'encoding' => Yii::t('YiiMailer', 'Unknown encoding: '),
		'execute' => Yii::t('YiiMailer', 'Could not execute: '),
		'file_access' => Yii::t('YiiMailer', 'Could not access file: '),
		'file_open' => Yii::t('YiiMailer', 'File Error: Could not open file: '),
		'from_failed' => Yii::t('YiiMailer', 'The following From address failed: '),
		'instantiate' => Yii::t('YiiMailer', 'Could not instantiate mail function.'),
		'invalid_address' => Yii::t('YiiMailer', 'Invalid address'),
		'mailer_not_supported' => Yii::t('YiiMailer', ' mailer is not supported.'),
		'provide_address' => Yii::t('YiiMailer', 'You must provide at least one recipient email address.'),
		'recipients_failed' => Yii::t('YiiMailer', 'SMTP Error: The following recipients failed: '),
		'signing' => Yii::t('YiiMailer', 'Signing Error: '),
		'smtp_connect_failed' => Yii::t('YiiMailer', 'SMTP Connect() failed.'),
		'smtp_error' => Yii::t('YiiMailer', 'SMTP server error: '),
		'variable_set' => Yii::t('YiiMailer', 'Cannot set or reset variable: ')
	),        
	'Mailer' => 'smtp',
	'Host' => 'smtp.lookathere.com',
	'Port' => 25,
	'SMTPAuth' => true,
	'Username' => 'roopz@lookathere.com',
	'Password' => 'TESTroopz@123'
);
