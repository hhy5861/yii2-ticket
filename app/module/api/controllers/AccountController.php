<?php
/**
 * @author mike
 * WeiapiController 控制器调试
 */
namespace api\controllers;

use Yii;
use api\components\ApiController;

class AccountController extends ApiController
{

	public $modelClass = 'api\components\token\Token';

	public $authMethods = false;
	
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
				'gettoken'                => [
							                  'class'         => 'api\controllers\account\GetTokenAction',
					                          'modelClass'    => $this->modelClass
				                             ],

			   ];
	}

	/**
	 * @inheritdoc
	 */
	protected function verbs()
	{
		return [
			    'gettoken'             => ['GET'],
			   ];
	}
}
