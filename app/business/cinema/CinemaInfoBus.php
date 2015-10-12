<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 15/6/24
 * Time: 11:39
 */
namespace business\cinema;

use yii\db\Query;
use yii\base\Object;
use app\models\mysql\db\CinemaInfo;

class CinemaInfoBus extends Object
{
	public $columns = [];

	public function __construct(array $config = [])
	{
		parent::__construct($config);
	}

	/**
	 * 获取电影院数据
	 * @param $condition
	 * @param array $params
	 * @param bool $mark
	 * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
	 */
	public function getCinema($condition, array $params,$mark = false)
	{
		$model = (new Query)->select($this->columns)
			     ->from('{{%cinema_info}}')->where($condition, $params);

		$data = $mark ? $model->one() : $model->all();

		return $data;
	}

	/**
	 * 更新影厅
	 * @param array $attributes
	 * @param $id
	 * @return int
	 */
	public function updateCinema(array $attributes,$id)
	{
		$params[':id'] = $id;
		$condition     = 'id = :id';

		return CinemaInfo::updateAll($attributes,$condition,$params);
	}

}