<?php

namespace app\module\cinema;

class CinemaModule extends \yii\base\Module
{
	public $layout = 'main.php';

    public $controllerNamespace = 'cinema\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
