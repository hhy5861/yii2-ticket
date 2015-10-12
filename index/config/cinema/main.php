<?php
$modulesBath = dirname(dirname(dirname(dirname(__FILE__))));

return [
        'id'                  => 'cinema',
        'basePath'            => $modulesBath . '/app/',
        'defaultRoute'        => 'cinema/login/index',
        'bootstrap'           => ['log'],

        'modules'   => [
                        'cinema' => [
                                     'class' => 'app\module\cinema\CinemaModule',
                                    ],
                       ],

        'components' => [
                         'urlManager'   => [
                                            'enablePrettyUrl'     => true,
                                            'showScriptName'      => false,
                                            'rules' => [
                                                        '<controller:^(?!resource|Resource|feedback|Feedback)\w+>/<action:\w+>' => 'cinema/<controller>/<action>',
                                                        '<url:^(?!resource|Resource|feedback|Feedback).+>' => 'cinema/<url>',
                                                       ],
                                           ],

                        'log'           => [
                                            'traceLevel' => 0,
                                            'targets'    => [[
                                                              'class' => 'yii\log\FileTarget',
                                                              'levels' => ['error', 'warning'],
                                                             ],

                                                            ],
                                           ],

                        'request'      => [
                                           'enableCookieValidation' => true,
                                           'enableCsrfValidation'   => false,
                                           'cookieValidationKey'    => '8a5da52ed126447d359e70c05721a8aa',
                                          ],

	                    'user'         => [
		                                    'identityClass'   => 'app\models\mysql\db\Users',
		                                    'enableAutoLogin' => false,
		                                    'loginUrl'        => '/login/index',
		                                    'authTimeout'     => 18000,
	                                      ],

	                    'assetManager' => [
		                                    'basePath'            => $modulesBath . '/static/',
		                                    'baseUrl'             => 'http://local.static.caimiao.com',
	                                      ],

                        /*'errorHandler' => [
				                           'errorAction'  => 'site/index',
                                          ],*/
                     ],

		];

