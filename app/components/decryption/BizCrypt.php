<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/17/15
 * Time: 10:37
 */
namespace app\components\decryption;

class BizCrypt
{
	use ErrorCode;

	private $m_sToken;

	private $m_sCorpid;

	private $m_sEncodingAesKey;

	public function __construct($token, $encodingAesKey, $Corpid)
	{
		$this->m_sToken = $token;
		$this->m_sEncodingAesKey = $encodingAesKey;
		$this->m_sCorpid = $Corpid;
	}

	/*
	 *验证URL
	 *@param sMsgSignature: 签名串，对应URL参数的msg_signature
	 *@param sTimeStamp: 时间戳，对应URL参数的timestamp
	 *@param sNonce: 随机串，对应URL参数的nonce
	 *@param sEchoStr: 随机串，对应URL参数的echostr
	 *@param sReplyEchoStr: 解密之后的echostr，当return返回0时有效
	 *@return：成功0，失败返回对应的错误码
	 */
	public function VerifyURL($sMsgSignature, $sTimeStamp, $sNonce, $sEchoStr, &$sReplyEchoStr)
	{
		if(strlen($this->m_sEncodingAesKey) != 43)
		{
			return self::$IllegalAesKey;
		}

		$array = (new Sha())->getSha($this->m_sToken, $sTimeStamp, $sNonce, $sEchoStr);
		$ret   = $array[0];

		if($ret != 0)
		{
			return $ret;
		}

		$signature = $array[1];
		if ($signature != $sMsgSignature)
		{
			return self::$ValidateSignatureError;
		}

		$result = (new Prpcrypt($this->m_sEncodingAesKey))->decrypt($sEchoStr, $this->m_sCorpid);
		if($result[0] != 0)
		{
			return $result[0];
		}

		$sReplyEchoStr = $result[1];

		return self::$OK;
	}

	/**
	 * 打包加密并生成xml
	 *
	 * @param $sReplyMsg
	 * @param $sTimeStamp
	 * @param $sNonce
	 * @param $sEncryptMsg
	 * @return int
	 */
	public function EncryptMsg($sReplyMsg, $sTimeStamp, $sNonce, &$sEncryptMsg)
	{
		/*加密*/
		$array = (new Prpcrypt($this->m_sEncodingAesKey))->encrypt($sReplyMsg, $this->m_sCorpid);
		$ret   = $array[0];
		if($ret != 0)
		{
			return $ret;
		}

		if($sTimeStamp == null)
		{
			$sTimeStamp = time();
		}

		$encrypt = $array[1];

		//生成安全签名
		$array = (new Sha())->getSha($this->m_sToken, $sTimeStamp, $sNonce, $encrypt);
		$ret   = $array[0];
		if($ret != 0)
		{
			return $ret;
		}

		$signature = $array[1];

		/*生成发送的xml*/
		$sEncryptMsg = (new XMLParse)->generate($encrypt, $signature, $sTimeStamp, $sNonce);
		return self::$OK;
	}

	/**
	 * 检验消息的真实性，并且获取解密后的明文
	 *
	 * @param $sMsgSignature
	 * @param null $sTimeStamp
	 * @param $sNonce
	 * @param $sPostData
	 * @param $sMsg
	 * @return int
	 */
	public function DecryptMsg($sMsgSignature, $sTimeStamp = null, $sNonce, $sPostData, &$sMsg)
	{
		if(strlen($this->m_sEncodingAesKey) != 43)
		{
			return self::$IllegalAesKey;
		}

		/*提取密文*/
		$array = (new XMLParse)->extract($sPostData);
		$ret   = $array[0];

		if($ret != 0)
		{
			return $ret;
		}

		if($sTimeStamp == null)
		{
			$sTimeStamp = time();
		}

		$encrypt = $array[1];

		/*验证安全签名*/
		$array = (new Sha())->getSha($this->m_sToken, $sTimeStamp, $sNonce, $encrypt);
		$ret   = $array[0];

		if($ret != 0)
		{
			return $ret;
		}

		$signature = $array[1];
		if($signature != $sMsgSignature)
		{
			return self::$ValidateSignatureError;
		}

		$result = (new Prpcrypt($this->m_sEncodingAesKey))->decrypt($encrypt, $this->m_sCorpid);
		if ($result[0] != 0)
		{
			return $result[0];
		}

		$sMsg = $result[1];

		return self::$OK;
	}
}