<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/24/15
 * Time: 14:17
 */
namespace cinema\controllers\action\ticket;

use Yii;
use yii\base\Action;

class IndexAction extends Action
{
	public function run()
	{
		$params[':id'] = 1;
		$condition     = 'id = :id';

		$cls = Yii::createObject(['class'   => 'business\cinema\CinemaInfoBus',
			//'columns' => ['id','name']
		]);

		$data = $cls->getCinema($condition,$params,true);

		return $this->controller->render('index', ['data' => $data]);
	}
}