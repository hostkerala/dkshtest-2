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
			//'ipFilters' => array('127.0.0.1', '::1'),
		),

	),

	// application components
	'components' => array(

		'user' => array(
			'allowAutoLogin' => true,
			'loginUrl' => array('/user/auth/login'),
			'class' => 'application.modules.user.components.WebUser',
                        'autoUpdateFlash' => false,
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
            
                'db' => array_merge(
			//require( dirname(__FILE__).DIRECTORY_SEPARATOR. 'db-live.php' ), // Prod DB Conf
			require( dirname(__FILE__).DIRECTORY_SEPARATOR. 'db-local.php' ) // DEV DB Conf
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
            'uploadDir'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR,   
		'hybridAuthIdentity' => array(
			'class' => 'application.components.HybridAuthIdentity',
			'config' => array(
				"hybridLoginAction" => "socialLogin",

				"providers" => array(
					"Google" => array(
						"enabled" => true,
						"keys" => array(
							"id" => "180785155645-b0ov8gh9j4mddir33nkdfg0tf2mpmdic.apps.googleusercontent.com",
							"secret" => "A7PdKXSl__XqdZM6AfYNVzmF",
						),
						"scope" => "https://www.googleapis.com/auth/userinfo.profile " . "https://www.googleapis.com/auth/userinfo.email",
						"access_type" => "online",
					),
					"Facebook" => array (
						"enabled" => true,
						"keys" => array (
							"id" => "843361889069040",
							"secret" => "b7bb9b24c5ae59a673fb031c4de921e6",
						),
						"scope" => "email"
					),
				),

				"debug_mode" => true,

				// to enable logging, set 'debug_mode' to true, then provide here a path of a writable file
				"debug_file" => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR . 'hybridauth.log'
			)
		),
	),
);
