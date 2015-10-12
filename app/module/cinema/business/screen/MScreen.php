<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 7/3/15
 * Time: 09:39
 */

namespace cinema\business\screen;

use yii\base\Object;
use app\models\mysql\db\Screen;

class MScreen extends Object
{
	public $columns = [];

	public function __construct(array $config = [])
	{
		parent::__construct($config);
	}

	/**
	 * 保存影厅信息
	 * @param $attributes
	 * @return bool|mixed
	 */
	public function saveScreen($attributes)
	{
		$model = new Screen();
		$attributes['screen_code'] >= 10 ? : $attributes['screen_code'] = "0" . $attributes['screen_code'];
		$attributes['ctime'] = TIME;
		$attributes['utime'] = TIME;
		$model->attributes   = $attributes;

		$status = $model->save(false);
		if($status)
			return $model->primaryKey;
		else
			return false;
	}
}