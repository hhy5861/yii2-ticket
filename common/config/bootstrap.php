<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('static', dirname(dirname(__DIR__)));
Yii::setAlias('app', dirname(dirname(dirname(__DIR__))) . '/app');
Yii::setAlias('Qiniu', dirname(dirname(dirname(__DIR__))) . '/app/vendors/Qiniu');