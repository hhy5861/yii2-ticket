<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace api\components;

use Yii;
use yii\rest\Action;
use app\components\func\Format;
use app\components\func\Encrypt;

/**
 * Action is the base class for action classes that implement RESTful API.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ApiAction extends Action
{

    protected $data;

    public $tokenArr;

    /**
     * @var callable a PHP callable that will be called when running an action to determine
     * if the current user has the permission to execute the action. If not set, the access
     * check will not be performed. The signature of the callable should be as follows,
     *
     * ```php
     * function ($action, $model = null) {
     *     // $model is the requested model instance.
     *     // If null, it means no specific model (e.g. IndexAction)
     * }
     * ```
     */
    public $checkAccess;

    /**
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return array
     */
    public function checkParams()
    {
        return [];
    }

    /**
     * @return array|int
     */
    protected function check()
    {
        $str = '';
        foreach ($this->checkParams() as $k => $v)
        {
            if(!isset($this->data[$v]) || $this->data[$v] === '')
            {
                $str .= ','.$v;
            }
        }

        if($str)
        {
            return Format::messages(-1,'parameters:'.substr($str,1) .'to pass parameters will not be empty');
        }

        return 0;
    }

	/**
	 * Parameter Handling
	 */
	protected function beforeRun()
	{
		if(Yii::$app->request->isGet)
		{
			$this->data = Yii::$app->getRequest()->getQueryParams();
		}
		else
		{
			$param = Yii::$app->getRequest()->getRawBody();
			if($param)
			{
				$param = json_decode($param,true);
				if(json_last_error() !== JSON_ERROR_NONE)
				{
					$this->data = $param;
				}
			}

			$this->data['token'] = Yii::$app->getRequest()->getQueryParam('token');
		}

		if($this->data['token'])
		{
			$this->tokenArr = Encrypt::getInstance()->decrypt($this->data['token']);
		}

		return true;
	}
}
