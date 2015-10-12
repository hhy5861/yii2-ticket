<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/10/15
 * Time: 17:37
 */

namespace app\components\file\oss;

use Yii;
use yii\base\Object;

abstract class Oss extends Object
{
	protected $_instance;

	public $bucket = OSS_AUDIO_BUCKET;

	public function __construct($config)
	{
		parent::__construct($config);

		!$this->_instance && $this->_instance = new \ALIOSS(OSS_ACCESS_ID,OSS_ACCESS_KEY);
	}

	/**
	 * 生成文件路径 OR 文件名
	 *
	 * @param string $model
	 * @param string $uid
	 * @return array 0=>path, 1=>file naem
	 */
	protected function generatePath($model = 'public', $uid = '0')
	{
		$proPath = '';
		$model && $proPath = $model . DIRECTORY_SEPARATOR;
		$proPath .= date('Ymd') . DIRECTORY_SEPARATOR;
		$proPath .= substr(md5($uid),0,6) . DIRECTORY_SEPARATOR;

		$name  = rand(100000,9999999);
		$name .= TIME;
		$name .= rand(100000,9999999);

		$proName  = md5($name);

		return [$proPath, $proName];
	}

	/**
	 * @param $response
	 * @return mixed
	 */
	protected function format($response,$m = 1)
	{
		$status = [];

		switch($m)
		{
			case 1 :
				$status['url']  = $response->header['_info']['url'];
				$status['code'] = $response->header['_info']['http_code'];
				$status['size'] = $response->header['_info']['size_upload'];
				break;
			default :

				break;
		}

		return $status;
	}
}