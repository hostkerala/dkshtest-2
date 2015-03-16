<?php

// uncomment the following to define a path alias
//Yii::setPathOfAlias('themes','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'theme' => 'classic',
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Web Application',

	// preloading 'log' component
	'preload' => array('log', 'config', 'bootstrap'),

	'aliases' => array(
		'vendors' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'  . DIRECTORY_SEPARATOR . '..'  . DIRECTORY_SEPARATOR . '..'  . DIRECTORY_SEPARATOR . 'vendors' .  DIRECTORY_SEPARATOR,
	),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.modules.user.models.*',
		'application.components.*',
		'application.modules.user.components.WebUser',
		'ext.YiiMailer.YiiMailer',
		'ext.slug.*',
	),

	'modules' => array(
		'user',
		'page',
		'content',
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'generatorPaths' => array(
				'bootstrap.gii'
			),
			'password' => '123321',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),

	),

	// application components
	'components' => array(

		'user' => array(
			'allowAutoLogin' => true,
			'loginUrl' => array('/user/auth/login'),
			'class' => 'application.modules.user.components.WebUser',
		),
		'config' => array('class' => 'GeneralConfig'),
		'bootstrap' => array(
			'class' => 'ext.bootstrap.components.Bootstrap',
			'responsiveCss' => true,
			'fontAwesomeCss' => true
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'/' => '/site/users',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				'admin/<controller:\w+>/<action:\w+>' => 'admin/<controller>/<action>',
			),
		),

		'db' => array(
			'connectionString' => 'mysql:host=my14344.d15579.myhost.ro;dbname=ionut_titei_ro_test012',
			'emulatePrepare' => true,
			'username' => '15579test012',
			'password' => 'test012345',
			'charset' => 'utf8',
		),

		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),

		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
					'logPath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR,
				),			
				array(
					'class' => 'CWebLogRoute',
					'levels' => 'trace',
					'showInFireBug' => true,
				),
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		'hybridAuthIdentity' => array(
			'class' => 'application.components.HybridAuthIdentity',
			'config' => array(
				"hybridLoginAction" => "socialLogin",

				"providers" => array(
					"Google" => array(
						"enabled" => true,
						"keys" => array(
							"id" => "1097309955025.apps.googleusercontent.com",
							"secret" => "Z2Nr2B1abV14DCwfsF2Y9_H_",
						),
						"scope" => "https://www.googleapis.com/auth/userinfo.profile " . "https://www.googleapis.com/auth/userinfo.email",
						"access_type" => "online",
					),
					"Facebook" => array (
						"enabled" => true,
						"keys" => array (
							"id" => "581741311888501",
							"secret" => "ae697c9523c701c7e4d88d49c4052d41",
						),
						"scope" => "email"
					),
				),

				"debug_mode" => false,

				// to enable logging, set 'debug_mode' to true, then provide here a path of a writable file
				"debug_file" => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR . 'hybridauth.log'
			)
		),
	),
);
