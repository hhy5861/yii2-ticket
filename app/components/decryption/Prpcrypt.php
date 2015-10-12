<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/17/15
 * Time: 10:37
 */
namespace app\components\decryption;

use app\components\func\RandCode;

class Prpcrypt extends Pkcs
{
	public $key;

	use ErrorCode;

	function __construct($k = '')
	{
		$this->key = base64_decode($k . "=");
	}

	/**
	 * 对明文进行加密
	 *
	 * @param $text
	 * @param $corpid
	 * @return array
	 */
	public function encrypt($text, $corpid = '')
	{
		try
		{
			/*获得16位随机字符串，填充到明文之前*/
			$random = RandCode::getInstance()->createCode(1,16)[0];
			$text   = $random . pack("N", strlen($text)) . $text . $corpid;

			/*网络字节序*/
			mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
			$module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
			$iv     = substr($this->key, 0, 16);

			/*使用自定义的填充方式对明文进行补位填充*/
			$text = $this->encode($text);
			mcrypt_generic_init($module, $this->key, $iv);

			/*加密*/
			$encrypted = mcrypt_generic($module, $text);
			mcrypt_generic_deinit($module);
			mcrypt_module_close($module);

			/*使用BASE64对加密后的字符串进行编码*/
			return [self::$OK, rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=')];
		}
		catch (Exception $e)
		{
			error_log(var_export($e));
			return [self::$EncryptAESError, null];
		}
	}

	/**
	 * 对密文进行解密
	 *
	 * @param $encrypted
	 * @param $corpid
	 * @return array|bool
	 */
	public function decrypt($encrypted, $corpid = '')
	{

		try
		{
			/*使用BASE64对需要解密的字符串进行解码*/

			$ciphertext_dec = base64_decode(str_pad(strtr($encrypted, '-_', '+/'), strlen($encrypted) % 4, '=', STR_PAD_RIGHT));
			$module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
			$iv     = substr($this->key, 0, 16);
			mcrypt_generic_init($module, $this->key, $iv);

			/*解密*/
			$decrypted = mdecrypt_generic($module, $ciphertext_dec);
			mcrypt_generic_deinit($module);
			mcrypt_module_close($module);
		}
		catch (Exception $e)
		{
			error_log(var_export($e));
			return [self::$DecryptAESError, null];
		}


		try
		{
			/*去除补位字符*/
			$result = $this->decode($decrypted);

			//去除16位随机字符串,网络字节序和AppId
			if(strlen($result) < 16)
			{
				error_log('解密，去除16位随机字符串失败');
				return false;
			}

			$content  = substr($result, 16, strlen($result));
			$len_list = unpack("N", substr($content, 0, 4));
			$xml_len  = $len_list[1];

			$xml_content = substr($content, 4, $xml_len);
			$from_corpid = substr($content, $xml_len + 4);

		}
		catch(Exception $e)
		{
			error_log(var_export($e));
			return array(self::$IllegalBuffer, null);
		}

		if($corpid && $from_corpid != $corpid)
		{
			return [self::$ValidateCorpidError, null];
		}

		return [0, $xml_content];
	}
}