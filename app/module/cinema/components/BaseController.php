<?php
/**
 * Created by PhpStorm.
 * User: renlikang
 * Date: 15/7/3
 * Time: 上午11:10
 */

namespace cinema\components;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
	public function beforeAction($action)
	{
		$result = true;
		if(Yii::$app->user->isGuest){
			$result = $this->_filterGuest($action);
		} else {
			$result = $this->_filterUser($action);
		}
		return $result;
	}

	private function _filterGuest($action)
	{
		if(Yii::$app->user->isGuest && !($this->id == 'login' && $action->id == 'index')) {
			return $this->goHome();
		} else {
			return true;
		}
	}

	private function _filterUser($action)
	{
		if($this->id == 'login' && $action->id == 'index') {
			$this->redirect('/cinema/index');
		}
		return true;
	}
}