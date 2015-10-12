<?php
/**
 * Created by PhpStorm.
 * User: renlikang
 * Date: 15/7/6
 * Time: 上午11:27
 */

namespace cinema\controllers\action\login;

use Yii;
use yii\base\Action;

class OutAction extends Action
{
	public function run()
	{
		$this->controller->layout = false;
		if(Yii::$app->request->isAjax && Yii::$app->request->isPost) {
			if(Yii::$app->user->logout()) {
				echo json_encode(['status' => 200, 'message' => '注销成功', 'url'=>Yii::$app->user->loginUrl]);
			} else {
				echo json_encode(['status' => 100, 'message' => '注销失败']);
			}
		}
		exit;
	}
}