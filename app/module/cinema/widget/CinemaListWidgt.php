<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 7/3/15
 * Time: 17:13
 */

namespace cinema\widget;

use Yii;
use yii\base\Widget;

class CinemaListWidgt extends Widget
{
	public $cinema_id;

	public function init()
	{
		parent::init();
		if(!$this->cinema_id)
		{
			throw new \Exception('cinema_id parameter can not be empty',100001);
		}
	}

	public function run()
	{
		$params[':cinema_id'] = $this->cinema_id;

		$condition = 'cinema_id = :cinema_id AND valid = 0';
		$obj = Yii::createObject('app\business\screen\ScreenBus');
		$data = $obj->getScreen($condition, $params);

		return $this->render('screenList', ['data' => $data]);
	}
}