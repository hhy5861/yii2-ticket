<?php

namespace api\controllers\account;

use Yii;
use api\components\ApiAction;

class GetTokenAction extends ApiAction
{
	/**
	 * @return array
	 */
    public function run()
    {
	    $object = Yii::createObject(['class'    => $this->modelClass,
	                                 'appid'    => $this->data['appid'],
		                             'secretid' => $this->data['secretid'],
	                                ]);

	    return $object->createdToken();
    }

	/**
	 * @return array
	 */
	public function checkParams()
	{
		return [];
	}
}
