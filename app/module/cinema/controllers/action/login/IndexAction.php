<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/24/15
 * Time: 14:17
 */
namespace cinema\controllers\action\login;

use Yii;
use yii\base\Action;
use cinema\business\cinema\MLogin;
use app\components\func\CurlAction;
use yii\helpers\Json;


class IndexAction extends Action
{
	public function run()
    {exit;
		$this->controller->layout = 'login';
		if(Yii::$app->request->isPost && Yii::$app->request->isAjax) {
			if(!Yii::$app->user->isGuest) {
				Yii::$app->user->logout();
			}
			$result = (new MLogin)->login(Yii::$app->request->post());
			if($result['status'] === 200) {
				echo json_encode(array_merge($result, ['url'=>'/cinema/index']));
			} else {
				echo json_encode($result);
			}
			exit;
		}

		return $this->controller->render('index', compact('model'));
	}
}