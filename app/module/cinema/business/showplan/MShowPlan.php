<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 7/6/15
 * Time: 13:41
 */

namespace cinema\business\showplan;

use yii\db\Query;
use yii\base\Object;

class MShowPlan extends Object
{
	public $columns;

	public function __construct(array $config = [])
	{
		parent::__construct($config);
	}

	/**
	 * 获取影院排片
	 *
	 * @param $condition
	 * @param array $params
	 * @param bool $mark
	 * @return array|bool
	 */
	public function getShowPlanList($condition, array $params, $mark = false)
	{
		$model = (new Query)->select($this->columns)
			     ->from('{{%cinema_film_row}} a')
			     ->leftJoin('{{%film_init}} b', 'a.film_id = b.code')
			     ->where($condition, $params)
			     ->orderBy('session_time desc');

		$data = $mark ? $model->one() : $model->all();

		return $data;
	}

	/**
	 * 获取电影院
	 *
	 * @param $condition
	 * @param array $params
	 * @param bool $mark
	 * @return array|bool
	 */
	public function getInitFilmList($condition, array $params, $mark = false)
	{
		$model = (new Query)->select($this->columns)
			     ->from('{{%film_init}}')->where($condition, $params);

		$data = $mark ? $model->one() : $model->all();

		return $data;
	}
}