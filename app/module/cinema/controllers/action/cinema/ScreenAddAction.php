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

class ScreenAddAction extends Action
{

	public function run()
	{
		$status = false;
		if(Yii::$app->request->isPost)
		{
			$cls    = Yii::createObject('cinema\business\screen\MScreen');

			$attributes = Yii::$app->request->post();
			$attributes['cinema_id'] && $status = $cls->saveScreen($attributes);
		}

		echo $status ? 0 : 1; exit;
	}
}