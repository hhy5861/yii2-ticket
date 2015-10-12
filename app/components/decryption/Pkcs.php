<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/17/15
 * Time: 10:37
 */

namespace app\components\decryption;

class Pkcs
{
	public static $block_size = 32;

	/**
	 * 对需要加密的明文进行填充补位
	 * @param $text
	 * @return string
	 */
	public function encode($text)
	{
		$text_length = strlen($text);

		/*计算需要填充的位数*/
		$amount_to_pad = self::$block_size - ($text_length % self::$block_size);
		if($amount_to_pad == 0)
		{
			$amount_to_pad = self::$block_size;
		}

		/*获得补位所用的字符*/
		$pad_chr = chr($amount_to_pad);
		for($index = 0; $index < $amount_to_pad; $index++)
		{
			$text .= $pad_chr;
		}

		return $text;
	}

	/**
	 * 对解密后的明文进行补位删除
	 *
	 * @param $text
	 * @return string
	 */
	public function decode($text)
	{
		$pad = ord(substr($text, -1));

		if($pad < 1 || $pad > self::$block_size)
		{
			$pad = 0;
		}

		return substr($text, 0, (strlen($text) - $pad));
	}
}