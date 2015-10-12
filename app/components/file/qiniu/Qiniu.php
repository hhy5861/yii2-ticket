<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/30/15
 * Time: 15:29
 */
namespace app\components\file\qiniu;

use Qiniu\Auth;
use yii\base\Object;
use app\components\func\RandCode;

class Qiniu extends Object
{
	public $key;

	protected $auth;

	protected $token;

	protected $fileName;

	public $bucket = QINIU_AUDIO_BUCKET;

	public $access_key = QINIU_ACCESS_KEY;

	public $secret_key = QINIU_SECRET_KEY;

	public function __construct(array $config = [])
	{
		parent::__construct($config);

		$this->replaceFileName();
		$this->auth  = new Auth($this->access_key,$this->secret_key);
	}

	/**
	 * 重新创建文件名
	 * @return string
	 */
	protected function replaceFileName()
	{
		$this->fileName = RandCode::getInstance()->createCode(1,24,6)[0];
		if($this->key)
		{
			$arr = explode('/', $this->key);
			$arr[count($arr)-1] = $this->fileName;
			return $this->key = implode('/',$arr);
		}
		else
		{
			return $this->key = $this->fileName;
		}
	}
}