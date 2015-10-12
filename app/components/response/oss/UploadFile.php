<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/11/15
 * Time: 17:57
 */

namespace app\components\response\oss;

use app\components\file\oss\ObjectFile;

class UploadFile extends ObjectFile
{
	public $uid;

	public $model;

	public function __construct(array $config = [])
	{
		parent::__construct($config);
	}

	public function UploadDir($filePath)
	{
		//TODO
		$ret = $this->uploadByFileDir($filePath, $this->model, $this->uid);

		return $ret;
	}
}