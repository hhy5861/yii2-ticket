<?php
return [
        'id'                  => 'api',
        'basePath'            => dirname(dirname(dirname(dirname(__FILE__)))) . '/app/',
        'defaultRoute'        => 'api/index/index',
        'bootstrap'           => ['log'],

        'modules'   => [
                        'api' => [
                                  'class' => 'app\module\api\ApiModule',
                                 ],
                       ],

        'components' => [
                         'urlManager'   => [
                                            'enablePrettyUrl'     => true,
                                            'showScriptName'      => false,
                                            'rules' => [
                                                        '<controller:^(?!api)\w+>/<action:\w+>' => 'api/<controller>/<action>',
                                                        '<url:^(?!api).+>' => 'api/<url>',
                                                       ],
                                           ],

                        'log'           => [
                                            'traceLevel' => YII_DEBUG ? 3 : 0,
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
					                       'identityClass'     => 'api\components\auth\CheckToken',
				                          ],

                        /*'errorHandler' => [
                          'errorAction'  => 'site/index',
                        ],*/
                     ],

		];

