<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/30/15
 * Time: 15:58
 */
namespace app\components\response\qiniu;

use Qiniu\Storage\UploadManager;
use app\components\file\qiniu\Qiniu;

class QResponse extends Qiniu implements IQiniu
{
	public function __construct(array $config = [])
	{
		$this->token = $this->auth->uploadToken($this->bucket, $this->key);
	}

	/**
	 * 通过文件上传
	 * @param $filePath
	 * @return array
	 * @throws \Exception
	 */
	public function action($filePath)
	{
		$reult = (new UploadManager())->putFile($this->token,$this->key,$filePath);
		if($reult[1] === NULL)
		{
			return ['path' => $reult[0]['key'],'name' => $this->fileName, 'status' => 0];
		}

		return ['path' => '','status' => $reult[1]];
	}
}