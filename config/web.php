<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'TimeZone'=>'prc',
	'name'=>'团饭网',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TyPUMFpM0nPyB2GRzxCRdaKFJDfklrbm',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//         'user' => [
//             'identityClass' => 'app\models\User',
//             'enableAutoLogin' => true,
//         ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
//             'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
//             'useFileTransport' => true,
        	'class' => 'yii\swiftmailer\Mailer',
        	'viewPath' => '@app/mailer',
        	'useFileTransport' => false,
        	'transport' => [
        		'class' => 'Swift_SmtpTransport',
        		'host' => 'smtp.exmail.qq.com',
        		'username' => 'yangzz@sevenga.com',
        		'password' => '111111',
        		'port' => '465',
        		'encryption' => 'ssl',
        	],
        ],
    	'urlManager' => [
    		'showScriptName' => false,
    		'enablePrettyUrl' => true,
    				 
    	],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
	'modules' => [
		'user' => [
				'class' => 'dektrium\user\Module',
    		    'controllerMap' => [
    		        'admin' => 'app\controllers\user\AdminController'
    		    ],
				'enableUnconfirmedLogin' => true,
// 				'enableGeneratingPassword'=>true,
				'confirmWithin' => 21600,
				'cost' => 12,
				'admins' => ['admin','yangzz']
		],
	],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
