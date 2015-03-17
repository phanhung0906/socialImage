<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'global.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'database.php');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SocialImage',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
        'admin',
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
            ),
        ),
		// database settings are configured in database.php
        'db'=>array(
            'connectionString' => 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
            'emulatePrepare' => true,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'charset' => 'utf8',
            //'enableProfiling' => YII_DEBUG,
            //'enableParamLogging' => YII_DEBUG,
            'schemaCachingDuration'=>YII_DEBUG ? false : 3600,
            'tablePrefix' => 'tb_',
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

        'clientScript' => array(
//            'class' => 'MyClientScript',
            'scriptMap' => array(
                'jquery.js'=>false,  //disable default implementation of jquery
                'jquery.min.js'=>false,  //desable any others default implementation
//                 'jquery.ba-bbq.js' => false,
//                 'jquery.yiigridview.js' => false,
            ),
            'coreScriptPosition' => CClientScript::POS_END
        ),

        'session' => array(
            //'class' => 'CDbHttpSession',
            'timeout' => 24 * 60 * 60, // 1 day
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'params.php'),
);
