<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/17/15
 * Time: 10:37
 */
namespace app\components\decryption;

class Sha
{
	use ErrorCode;

	/**
	 * 用SHA1算法生成安全签名
	 *
	 * @param $token
	 * @param $timestamp
	 * @param $nonce
	 * @param $encrypt_msg
	 * @return array
	 */
	public function getSha($token, $timestamp, $nonce, $encrypt_msg)
	{
		try
		{
			$array = [$encrypt_msg, $token, $timestamp, $nonce];
			sort($array, SORT_STRING);
			$str   = implode($array);

			return [self::$OK, sha1($str)];
		}
		catch(Exception $e)
		{
			print $e . "\n";
			return [self::$ComputeSignatureError, null];
		}
	}

}


?>