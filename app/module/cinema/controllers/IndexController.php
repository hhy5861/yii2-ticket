<?php
/**
 *
 */
namespace cinema\controllers;

use app\components\response\UploadFile;
use Yii;
use yii\console\Controller;
use cinema\business\test\Test;
use app\components\service\Memcached;
use app\components\decryption\Prpcrypt;
use app\components\func\Encrypt;
use app\components\response\qiniu\QResponse;

class IndexController extends Controller
{

	private $earth = 6378.137;

    public function actionIndex()
    {
	    $path = 'http://7xk1ob.com2.z0.glb.qiniucdn.com/app/c0q7tj4birl7s0bv7bjag7kp';

	    $obj = Yii::createObject(['class' => 'app\components\response\qiniu\QDownload',
	                             ]);

	    $data = $obj->action($path);
	    var_dump($data);
    }

	public function actionV()
	{
//		$dir = '/Volumes/web/material/IMG_0401.JPG';
//		$data = (new UploadFile())->UploadDir($dir, 'pubilc');

	/*	$lng = '121.46471';
		$lat = '31.221702';

		$lng2 = '121.503';
		$lat2 = '31.241973';

		$data = $this->getDistance($lng,$lat,$lng2,$lat2);*/
		//$data = $this->getCoor($lng,$lat);

		$arr = ['uid' => 1,'code' => 364896,'token'=>'545452kdjsdfsd932'];
		$str = Encrypt::getInstance()->encrypt($arr);
		echo $str . '<br>' . strlen($str) . '<br>';
		$key = 'token';
		$obj = new Prpcrypt($key);
		$data = $obj->encrypt(serialize($arr));
		echo '<pre>';
		print_r($data[1]);
		echo '<br>';
		echo strlen($data[1]);
		echo '<br>';

		$data = $obj->decrypt($data[1]);
		print_r(unserialize($data[1]));
	}

	private function getCoor($lng,$lat,$distance = 1)
	{
		$range = 180 / pi() * $distance / $this->earth;
		$lngR  = $range / cos($lat * pi() / 180);

		$data["maxLat"] = $lat + $range;
		$data["minLat"] = $lat - $range;
		$data["maxLng"] = $lng + $lngR ;
		$data["minLng"] = $lng - $lngR ;

		return $data;
	}

	private function getDistance($lngOne,$latOne,$lngTwo,$latTwo)
	{
		$dlat = deg2rad($latTwo - $latOne);
		$dlng = deg2rad($lngTwo - $lngOne);
		$disA = pow(sin($dlat / 2), 2) + cos(deg2rad($latOne)) * cos(deg2rad($latTwo)) * pow(sin($dlng / 2), 2);
		$disB = 2 * atan2(sqrt($disA), sqrt(1 - $disA));
		$proDistance = $this->earth * $disB;

		return sprintf('%.2f',$proDistance) . 'KM';
	}
}
