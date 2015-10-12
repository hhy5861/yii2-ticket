<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/11/15
 * Time: 11:24
 */

namespace app\components\file\oss;

abstract class ObjectFile extends Oss
{

	public function __constrcut($config)
	{
		parent::__construct($config);
	}

	/**
	 * 创建目录
	 *
	 * @param $dir
	 * @return mixed
	 */
	protected function createDirectory($dir)
	{
		$response  = $this->_instance->create_object_dir($this->bucket,$dir);

		return $this->format($response);
	}

	/**
	 * 通过内容上传文件
	 *
	 * @param array $uploadFileOptions
	 * $upload_file_options = [
								'content' => $content,
								'length' => strlen($content),
								ALIOSS::OSS_HEADERS => ['Expires' => '2012-10-01 08:00:00',]
							  ];
	 * @param string $model
	 * @param string $uid
	 * @return mixed
	 */
	protected function uploadByContent(array $uploadFileOptions,$model = '',$uid = '')
	{
		$object    = $this->generatePath($model, $uid);
		$proObject = implode(DIRECTORY_SEPARATOR, $object);

		$response  = $this->_instance->upload_file_by_content($this->bucket,$proObject,$uploadFileOptions);

		return $this->format($response);
	}

	/**
	 * 通过路径上传文件
	 *
	 * @param $filePath
	 * @param string $model
	 * @param string $uid
	 * @return mixed
	 * @throws \OSS_Exception
	 */
	protected function uploadByFileDir($filePath, $model = '', $uid = '')
	{
		list($path, $file) = $this->generatePath($model,$uid);

		$pathArr = explode('.', $filePath);
		$ext     = end($pathArr);
		$object  = $path . $file . '.' .$ext;

		$response = $this->_instance->upload_file_by_file($this->bucket, $object, $filePath);

		return $this->format($response);
	}

	/**
	 * 获取object meta
	 *
	 * @param $object
	 * @return mixed
	 */
	protected function getObjectMeta($object)
	{
		$response = $this->_instance->get_object_meta($this->bucket,$object);

		return $this->format($response);
	}

	/**
	 * 删除一个或者多个objects
	 *
	 * @param $object [file1,txt,file2.txt] or string file.txt
	 * @param bool $quiet
	 * @return mixed
	 * @throws \OSS_Exception
	 */
	protected function deleteObjects($object,$quiet = false)
	{
		 if(!is_array($object))
		 {
			 $object[] = $object;
		 }

		$options = ['quiet' => $quiet,];

		$response = $this->_instance->delete_objects($this->bucket,$object,$options);

		return $this->format($response);
	}

	/**
	 * 获取object
	 *
	 * @param $object
	 * @param $localDir
	 * @return mixed
	 */
	protected function getObject($object,$localDir)
	{
		$options = ['fileDownload' => $localDir];

		$response = $this->_instance->get_object($this->bucket,$object,$options);

		return $this->format($response);
	}

	/**
	 * 检测object是否存在
	 *
	 * @param $object
	 * @return mixed
	 */
	public function isObjectExist($object)
	{
		$response = $this->_instance->is_object_exist($this->bucket,$object);

		return $this->format($response);
	}

	/**
	 * 通过multi-part上传整个目录(新版)
	 *
	 * @param $pathDir  本地目录
	 * @param $objectDir  目标目录
	 * @throws \OSS_Exception
	 */
	protected function batchUploadFileDir($pathDir,$objectDir)
	{
		$options['bucket']    = $this->bucket;
		$options['object']    = $objectDir;
		$options['directory'] = $pathDir;

		$this->_instance->batch_upload_file($options);
	}

	/**
	 * 通过multipart上传文件
	 *
	 * @param $filePath
	 * @param $partSize
	 * @param string $model
	 * @param string $uid
	 * @return mixed
	 * @throws \OSS_Exception
	 */
	protected function uploadByMultiPart($filePath,$partSize,$model = '',$uid ='')
	{
		list($path, $file) = $this->generatePath($model,$uid);

		$pathArr = explode('.', $filePath);
		$ext     = end($pathArr);
		$object  = $path . $file . '.' .$ext;

		$options = ['fileUpload' => $filePath,
					'partSize'   => $partSize,
		           ];


		$response = $this->_instance->create_mpu_object($this->bucket, $object, $options);

		return $this->format($response);
	}
}