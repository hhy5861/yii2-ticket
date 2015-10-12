<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/19/15
 * Time: 09:16
 */

namespace api\components\token;

use yii\base\Object;
use app\components\func\Format;
use app\components\func\Encrypt;
use app\components\func\RandCode;
use app\models\mysql\auth\Account;
use app\components\service\Memcached;

class Token extends Object implements IToken
{
	public $appid;

	public $secretid;

	public function __construct(array $config = [])
	{
		parent::__construct($config);
	}

	/**
	 *
	 * @return bool|string
	 */
	public function createdToken()
	{
		if($data = $this->getAccountInfo())
		{
			$rand  = RandCode::getInstance();
			$tokenArr['uid']   = $data['uid'];
			$tokenArr['code']  = $rand->createCode(1,6,1)[0];
			$tokenArr['token'] = $rand->createCode(1,32)[0];

			$accessToken = Encrypt::getInstance()->encrypt($tokenArr);

			$cache['key']    = TOKEN_KEY . $data['uid'];
			$cache['expire'] = TOKEN_EXPIRE;
			$status = Memcached::getInstance($cache)->set($tokenArr);
			if($status) return Format::messages(0,'get token success',['access_token' => $accessToken, 'expire' => TOKEN_EXPIRE]);
		}

		return Format::messages(100001,'the user has not authorized');
	}

	/**
	 * 获取授权
	 * @return array|null|\yii\db\ActiveRecord
	 */
	protected function getAccountInfo()
	{
		$data = Account::find()->select('*')
			    ->where('appid = :appid AND secretid = :secretid AND valid = 0',
			           [':appid' => $this->appid, ':secretid' => $this->secretid])
			    ->one();

		return $data;
	}
}