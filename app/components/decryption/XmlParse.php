<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/17/15
 * Time: 10:37
 */
namespace app\components\decryption;

class XmlParse
{

	/**
	 *  提取出xml数据包中的加密消息
	 *
	 * return string 提取出的加密消息字符串
	 */
	public function extract($xmltext)
	{
		try
		{
			$xml = new \DOMDocument();
			$xml->loadXML($xmltext);

			$array_e    = $xml->getElementsByTagName('Encrypt');
			$array_a    = $xml->getElementsByTagName('ToUserName');
			$encrypt    = $array_e->item(0)->nodeValue;
			$tousername = $array_a->item(0)->nodeValue;
			return array(0, $encrypt, $tousername);
		}
		catch (Exception $e)
		{
			print $e . "\n";
			return [ErrorCode::$ParseXmlError, null, null];
		}
	}

	/**
	 * 生成xml消息
	 *
	 * @param $encrypt
	 * @param $signature
	 * @param $timestamp
	 * @param $nonce
	 * @return string
	 */
	public function generate($encrypt, $signature, $timestamp, $nonce)
	{
		$format = "<xml>";
		$format .= "<Encrypt><![CDATA[%s]]></Encrypt>";
		$format .= "<MsgSignature><![CDATA[%s]]></MsgSignature>";
		$format .= "<TimeStamp>%s</TimeStamp>";
		$format .= "<Nonce><![CDATA[%s]]></Nonce>";
		$format .= "</xml>";

		return sprintf($format, $encrypt, $signature, $timestamp, $nonce);
	}

}


?>