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

class ScreenDelAction extends Action
{

	public function run()
	{
		$status = false;
		if(Yii::$app->request->isPost)
		{
			$cls    = Yii::createObject('app\business\screen\ScreenBus');

			$param['id'] = Yii::$app->request->post('id');
			$attributes['valid'] = 1;
			$param['id'] && $status = $cls->updateScreen($attributes, $param);
		}

		echo $status ? 0 : 1; exit;
	}
}
