<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 7/1/15
 * Time: 13:44
 */

namespace app\components\response\qiniu;

use Qiniu\Http\Client;
use app\components\file\qiniu\Qiniu;

class QDownload extends Qiniu implements IQiniu
{
	protected $url;

	/**
	 * 上传文件格式
	 *
	 * @param $url
	 * @param string $path
	 * @return array
	 */
	public function action($url, $path = '/tmp')
	{
		$this->url = $this->auth->privateDownloadUrl($url);
		$response  = Client::get($this->url);
		if($response->statusCode === 200)
		{
			$path .= DIRECTORY_SEPARATOR . $this->fileName;
			file_put_contents($path, $response->body);

			return ['path' => $path,'name' => $this->fileName, 'status' => 0];
		}

		return ['path' => '', 'name' => '', 'status' => $response->statusCode];
	}
}