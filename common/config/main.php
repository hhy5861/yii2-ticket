<?php
ini_set('mongo.native_long', 1);

return [
        'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

        'components' => [
                         'curl'      => [
                                         'class'   => 'yii\curl\Curl',
                                        ],

                         'redis'     => [
                                         'class'       => 'yii\redis\Connection',
                                         'hostname'    => '127.0.0.1',
                                         'port'        => 6379,
                                        // 'password'    => '',
                                         'database'    => 0,
                                         'dataTimeout' => 30,
                                        ],

                         'memCache'  => [
                                         'class'        => 'yii\caching\MemCache',
                                         'useMemcached' => false,
                                         'servers'      => [
                                                             [
                                                              'host'         => '121.40.31.143',
                                                              'port'         => 11211,
                                                              'weight'       => 60,
                                                             ],
                                                            ],
                                         ],

				         'db'        => [
					                     'class'        => 'yii\db\Connection',
					                     'dsn'          => 'mysql:host=121.40.31.143;port=65533;dbname=d_cm_ticket',
					                     'username'     => 'MySQLObjs',
					                     'password'     => 'V6S4C4D6F7P0K3B2J5A3',
					                     'charset'      => 'utf8',
					                     'tablePrefix'  => 't_ticket_',
				                        ],

				         'auth'      => [
					                     'class'        => 'yii\db\Connection',
					                     'dsn'          => 'mysql:host=121.40.31.143;port=65533;dbname=d_cm_ticket_auth_api',
					                     'username'     => 'MySQLObjs',
					                     'password'     => 'V6S4C4D6F7P0K3B2J5A3',
					                     'charset'      => 'utf8',
					                     'tablePrefix'  => 't_auth_',
				                        ],

                         ],
];
