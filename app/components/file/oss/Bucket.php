<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/11/15
 * Time: 10:29
 */

namespace app\components\file\oss;


abstract class Bucket extends Oss
{

	public function __constrcut(array $config = [])
	{
		parent::__construct($config);
	}

	/**
	 * 获取bucket列表
	 *
	 * @return mixed
	 */
	protected function getBucketList()
	{
		$response = $this->_instance->list_bucket();

		return $this->format($response);
	}

	/**
	 * 创建bucket
	 *
	 * @param $type (public-read,private)
	 * @return mixed
	 */
	protected function createBucket($type = 'public-read')
	{
		$response = $this->_instance->create_bucket($this->bucket, $type);

		return $this->format($response);
	}

	/**
	 * 删除bucket
	 *
	 * @return mixed
	 */
	protected function deleteBucket()
	{
		$response = $this->_instance->delete_bucket($this->bucket);

		return $this->format($response);
	}

	/**
	 * 设置bucket ACL
	 *
	 * @param string $type (public-read,private)
	 * @return mixed
	 */
	protected function setBucketAcl($type = 'public-read')
	{
		$response = $this->_instance->set_bucket_acl($this->bucket,$type);

		return $this->format($response);
	}

	/**
	 * 获取bucket ACL
	 *
	 * @param array $options  ['Content-Type' => 'text/xml'],
	 *                       ['Content-Md5'   => 'text/xml'],
	 *                      ['Content-Length' => 'text/xml']
	 * @return mixed
	 */
	protected function getBucketAcl(array $options = ['Content-Type' => 'text/xml'])
	{
		$response = $this->_instance->get_bucket_acl($this->bucket,$options);

		return $this->format($response);
	}

	/**
	 * 设置bucket logging
	 *
	 * @param string $targetBucket
	 * @param string $targetPrefix
	 * @return mixed
	 */
	protected function setBucketLogging($targetBucket = 'backet2', $targetPrefix='test')
	{
		$response = $this->_instance->set_bucket_logging($this->bucket,$targetBucket,$targetPrefix);

		return $this->format($response);
	}

	/**
	 * 获取bucket logging
	 *
	 * @return mixed
	 */
	protected function getBucketLogging()
	{
		$response = $this->_instance->get_bucket_logging($this->bucket);

		return $this->format($response);
	}

	/**
	 * 删除bucket logging
	 *
	 * @return mixed
	 */
	protected function deleteBucketLogging()
	{
		$response = $this->_instance->delete_bucket_logging($this->bucket);

		return $this->format($response);
	}

	/**
	 * 设置bucket website
	 *
	 * @param string $indexDocument
	 * @param string $errorDocument
	 * @return mixed
	 */
	protected function setBucketWebsite($indexDocument='index.html', $errorDocument='error.html')
	{
		$response = $this->_instance->set_bucket_website($this->bucket,$indexDocument,$errorDocument);

		return $this->format($response);
	}

	/**
	 * 获取bucket website
	 *
	 * @return mixed
	 */
	protected function getBucketWebsite()
	{
		$response = $this->_instance->get_bucket_website($this->bucket);

		return $this->format($response);
	}

	/**
	 * 删除bucket website
	 *
	 * @return mixed
	 */
	protected function  deleteBucketWebsite()
	{
		$response = $this->_instance->delete_bucket_website($this->bucket);

		return $this->format($response);
	}
}