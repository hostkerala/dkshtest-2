<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Console Application',

	// preloading 'log' component
	'preload' => array('log'),

	// application components
	'components' => array(
                /*
                'db' => array(
			'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
		),
                */
		'db' => array(
			'connectionString' =>'mysql:host=serwer1505663.home.pl;dbname=17191726_0000001',
			'emulatePrepare' => true,
			'username' => '17191726_0000001',
			'password' => 'test123400',
			'charset' => 'utf8',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),
);