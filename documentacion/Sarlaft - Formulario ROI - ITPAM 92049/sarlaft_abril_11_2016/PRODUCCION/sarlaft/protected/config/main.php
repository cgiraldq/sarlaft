<?php
Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../extensions/yiichartjs');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>SITENAME,
	'theme'=>'une_internos', //utiliza otro tema.
	'defaultController'=>'site',
	'language'=>'es',
	'sourceLanguage'=>'es',
	'charset'=>'utf-8',
	// preloading 'log' component
	'preload'=>array('log','bootstrap','chartjs'),	

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.jqgrid.lib.classes.*',
		'application.modules.jqgrid.models.*',
	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'jqgrid' => array(),
		'massdataupload' => array(),
		'install' => array(),
		'roi' => array(),		
	),

	// application components
	'components'=>array(
		'request'=>array(
			'enableCsrfValidation'=>true,
		),
        'chartjs' => array('class' => 'application.extensions.yiichartjs.components.ChartJs'),   
        'bootstrap' => array(
            'class' => 'application.extensions.yiibooster.components.Bootstrap',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'sysSecurity'=>array(
				'class'=>'application.components.sysSecurity.Security',
				),
		'soapClient'=>array(
				'class'=>'application.components.soap.InvokeSoapClient',
				'cache'=>1,
				'ttl'=>0,
				'options'=>array('connection_timeout'=>30, 
                                                'trace'=>1, 
                                                "exceptions" => true, 
                                                'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
                                                'stream_context' => stream_context_create(array('http' =>array('protocol_version'  => 1.0)))
                                 )
				),
		'OssManager'=>array(
				'class' => 'application.components.Oss.OssManager',
			),
		'genLoginsDA'=>array(
				'class' => 'application.components.adLdap.genLogins',
			),
		'authManager'=>array(
				'class' => 'application.components.auth.authManager',
			),
		'eventManager'=>array(
					'class' => 'application.components.events.eventManager',
			),
		'menuManager'=>array(
					'class' => 'application.components.menus.menuManager',
			),
		'eWebBrowser'=>array(
					'class' => 'application.components.eWebBrowser.EWebBrowser',
			),
		'generalFunctions'=>array(
					'class' => 'application.components.generalFunctions.generalFunctions',
			),                
		'mailComponent'=>array(
					'class' => 'application.components.phpmailer.mailComponent',
			),
		'format' => array(
            'class' => 'application.components.Formatter',
            'booleanFormat' => array(Yii::t('0', '1'), Yii::t('No', 'Si')),
            'booleanState' => array(Yii::t('0', '1'), Yii::t('Inactivo', 'Activo')),
            'numberFormat'=>array('currencySimbol'=>'$ ','decimals'=>0, 'decimalSeparator'=>',', 'thousandSeparator'=>'.'),
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
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host='.INSTANCE.';dbname='.DB,
			'emulatePrepare' => true,
			'username' => DB_USER,
			'password' => DB_PASS,
			'charset' => 'utf8',
		),		
		'cache' => array (
				'class' => 'CmemCache',
				'useMemcached' => true,
				'servers'=>array(
					array(
						'host'=>'127.0.0.1',
						'port'=>11211,
					),
				),
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
            
		'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(

                array(
					'class' => 'CFileLogRoute',
					'levels'=>'info',
					'categories'=>'system.*, application.*',
					'logPath' => $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR,
					'logFile' => 'info',
                ), 
 
				array(
					'class'=>'CDbLogRoute',
					'levels'=>'info',
					'categories'=>'system.*, application.*',
					'connectionID'=>'db',
					'logTableName'=>'tbl_info_log',
				),				
			),
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['delphos']['aplicacion']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'delphos' => array(
				'aplicacion' 	=> APPLICATION,
				'password_app' 	=> PASSWORD_APP,
		),
        'site' => array('copyright'=>COPYRIGHT),
		// PHP DATA SERVICE	
	'TamPag'                    => 10,
        'cacheTime'                 => 1,
	),
);
