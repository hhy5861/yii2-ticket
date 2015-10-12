<?php
namespace api\controllers\api;

use Yii;
use api\components\ApiAction;

class TestAction extends ApiAction
{
	/**
	 * @return array
	 */
    public function run()
    {
	    return [1=>'A', 2=>'B',3=>'C'];
    }

	/**
	 * @return array
	 */
	public function checkParams()
	{
		return [];
	}
}
