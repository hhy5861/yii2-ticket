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

class CinemaOptionWidgt extends Widget
{
	public $selected;

	public function init()
	{
		parent::init();
	}

	/**
	 * 获取默认电影进行排片
	 * @return string
	 * @throws \yii\base\InvalidConfigException
	 */
	public function run()
	{
		$params[':publish_date'] = TIME;

		$condition = 'publish_date >= :publish_date AND valid = 0';
		$obj       = Yii::createObject(['class'   => 'cinema\business\showplan\MShowPlan',
									    'columns' => ['id','name'],]
									  );

		$data = $obj->getInitFilmList($condition, $params);

		return $this->render('cinemaOption', ['data' => $data, 'selected' => $this->selected]);
	}
}