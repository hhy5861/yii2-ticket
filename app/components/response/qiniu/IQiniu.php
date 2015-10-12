<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/30/15
 * Time: 16:00
 */

namespace app\components\response\qiniu;


interface IQiniu
{
	public function action($path);
}