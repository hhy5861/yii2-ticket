<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/12/15
 * Time: 16:04
 */

namespace app\components\response\oss;

use Yii;

class Response
{
	public static function main($namespace, $uid, $model)
	{
		$obj = Yii::createObject(['class' => $namespace,
						          'uid'   => $uid,
			                      'model' => $model
				                 ]);

		return $obj->UploadDir();
	}
}