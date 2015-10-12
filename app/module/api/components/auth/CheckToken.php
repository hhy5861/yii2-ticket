<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14/12/11
 * Time: 下午4:27
 */

namespace api\components\auth;

use Yii;
use app\components\func\Encrypt;
use app\components\service\Memcached;
use yii\web\UnauthorizedHttpException;

class CheckToken implements IdentityInterface
{

	/**
	 * @param $token
	 * @return bool
	 * @throws UnauthorizedHttpException
	 */
	public static function checkAccessToken($token)
	{
		$tokenArr = Encrypt::getInstance()->decrypt($token);
		if($tokenArr)
		{
			return self::verificationToken($tokenArr);
		}
		else
		{
			throw new UnauthorizedHttpException('Illegal access token');
		}
	}

	/**
	 * @param $tokenArr
	 * @return bool
	 * @throws UnauthorizedHttpException
	 */
	private static function verificationToken($tokenArr)
	{
		$cache['key']    = TOKEN_KEY . $tokenArr['uid'];
		$cacheData = Memcached::getInstance($cache)->get();
		if($cacheData)
		{
			/** @var TYPE_NAME $cacheData */
			foreach($cacheData as $key => $val)
			{
				if($val !== $tokenArr[$key])
				{
					throw new UnauthorizedHttpException("Invalid access token {$key}");
				}
			}

			return true;
		}

		throw new UnauthorizedHttpException('access token has expired');
	}
}