<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 7/3/15
 * Time: 09:39
 */

namespace app\business\screen;

use yii\db\Query;
use yii\base\Object;
use app\models\mysql\db\Screen;

class ScreenBus extends Object
{
	public $columns = [];

	public function __construct(array $config = [])
	{
		parent::__construct($config);
	}

	/**
	 * 获取影厅
	 * @param $condition
	 * @param array $params
	 * @param bool $mark
	 * @return array|bool
	 */
	public function getScreen($condition, array $params, $mark = false)
	{
		$model = (new Query)->select($this->columns)
			     ->from('{{%screen}}')->where($condition, $params)
		         ->orderBy('id desc');

		$data = $mark ? $model->one() : $model->all();

		return $data;
	}

	/**
	 * 更新影厅信息
	 *
	 * @param $attributes
	 * @param $condition
	 * @return int
	 */
	public function updateScreen($attributes,$condition)
	{
		return Screen::updateAll($attributes, $condition);
	}
}