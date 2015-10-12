<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 7/1/15
 * Time: 15:12
 */

namespace app\components\response\qiniu;

use Qiniu\Storage\FormUploader;
use app\components\file\qiniu\Qiniu;

class QFormUp extends Qiniu implements IQiniu
{
	private $object;

	public function __construct(array $config = [])
	{
		$this->token  = $this->auth->uploadToken($this->bucket, $this->key);
		$this->object = new FormUploader();
	}

	/**
	 * 表单上传文件
	 *
	 * @param $form
	 * @return array
	 */
	public function action($form)
	{
		$reult = $this->object->putFile($this->token, $this->key, $form, null, 'text/plain', true);
		if($reult[1] === NULL)
		{
			return ['path' => $reult[0]['key'],'name' => $this->fileName, 'status' => 0];
		}

		return ['path' => '','status' => $reult[1]];
	}
}