<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/24/15
 * Time: 14:17
 */
namespace cinema\controllers\action\cinema;

use Yii;
use yii\base\Action;

class EditAction extends Action
{
	public function run()
	{
		if(Yii::$app->request->isPost)
		{
			$param  = Yii::$app->request->post();
			$cls    = Yii::createObject('cinema\business\cinema\MCinema');

			$cls->editCinema($param,$param['id']);
		}

		Yii::$app->controller->redirect('/cinema');
	}
}