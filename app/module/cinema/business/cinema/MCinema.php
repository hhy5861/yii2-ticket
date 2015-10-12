<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 7/2/15
 * Time: 16:25
 */

namespace cinema\business\cinema;

use yii\base\Object;
use app\models\mysql\db\CinemaInfo;

class MCinema extends Object
{
	public function __construct(array $cinfig = [])
	{
		parent::__construct($cinfig);
	}

	/**
	 * 更新影院信息
	 * @param array $attributes
	 * @param $id
	 * @return int
	 */
	public function editCinema(array $attributes, $id)
	{
		return CinemaInfo::updateAll($attributes,['id' => $id]);
	}
}