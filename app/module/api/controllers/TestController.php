<?php
/**
 * @author mike
 * WeiapiController 控制器调试
 */
namespace api\controllers;

use Yii;
use api\components\ApiController;

class TestController extends ApiController
{

	public $modelClass = 'api\components\auth\CheckToken';
	
	public function init()
	{
		parent::init();
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
				'test'                    => [
							                  'class'      => 'api\controllers\api\TestAction',
					                          'modelClass' => $this->modelClass,
				                             ],

			   ];
	}

	/**
	 * @inheritdoc
	 */
	protected function verbs()
	{
		return [
			    'test'             => ['POST'],
			   ];
	}
}
