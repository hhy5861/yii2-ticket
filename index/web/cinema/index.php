<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV')   or define('YII_ENV', 'dev');

require(dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php');
require(dirname(dirname(dirname(__DIR__))) . '/vendor/yiisoft/yii2/Yii.php');
require(dirname(dirname(dirname(__DIR__))) . '/common/config/bootstrap.php');
require(dirname(dirname(dirname(__DIR__))) . '/common/config/params.php');
require(dirname(dirname(dirname(__DIR__))) . '/common/config/include.php');
require(dirname(dirname(__DIR__))          . '/config/cinema/bootstrap.php');
require(dirname(dirname(__DIR__))          . '/config/cinema/params.php');

$config = yii\helpers\ArrayHelper::merge(require(dirname(dirname(dirname(__DIR__))) . '/common/config/main.php'),
                                         require(dirname(dirname(__DIR__))          . '/config/cinema/main.php')
										);

$application = new yii\web\Application($config);
$application->run();
