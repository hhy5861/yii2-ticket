<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 7/2/15
 * Time: 18:04
 */

namespace app\business\film;

use yii\db\Query;
use yii\base\Object;

class FilmBus extends Object
{
	public $columns = [];

	public function __construct(array $config = [])
	{
		parent::__construct($config);
	}


}