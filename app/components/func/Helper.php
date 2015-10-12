<?php
namespace app\components\func;

class Helper
{

	/**
	 * @param $mobile
	 * @return bool|string
	 */
    public static function validateMobile($mobile)
    {
        if(!$mobile)
        {
            return false;
        }

        $preg_map = [
                        ['area' => 'cn', 'preg' => '13\d{9}'],
                        ['area' => 'cn', 'preg' => '1[578][012356789]\d{8}'],
                        ['area' => 'cn', 'preg' => '14[57]\d{8}'],

                        // 台湾
                        ['area' => 'cn', 'preg' => '09\d{8}'],

                        // 香港、澳门  5、6、9打头8位长度
                        ['area' => 'cn', 'preg' => '[569]\d{7}'],

                        // 加拿大  (固定10位数，前三位) 204、250、289、306、403、416、418、450、506、514、519、604、613、647、705、709、778、780、807、819、867、902、905
                        //['area' => 'wg', 'preg' => '(204|250|289|306|403|416|418|450|506|514|519|604|613|647|705|709|778|780|807|819|867|902|905)\d{7}'],

                        // 新西兰  021、022、025、026、027打头，后面有6位，5位，7位都有
                        //['area' => 'wg', 'preg' => '(021|022|025|026|027)\d{5,7}'],

                        // 澳大利亚  (固定10位数，前一位是0)
                        //['area' => 'wg', 'preg' => '0\d{9}'],

                        // 法国  (固定10位数，前一位是0)
                        //['area' => 'wg', 'preg' => '0\d{9}'],

                        // 10到13位数字都通过
                        //['area' => 'international', 'preg' => '\d{9,13}'],
                     ];

        $area = '';

        if($mobile)
        {
            return $area;
        }

        foreach($preg_map as $preg_info)
        {
            if(1 === preg_match("/^{$preg_info['preg']}$/is", $mobile))
            {
                $area = $preg_info['area'];
                break;
            }
        }

        return $area;
    }

	/**
	 * @param $string
	 * @param $length
	 * @param int $line
	 * @return array|string
	 */
    public static function stringCut($string, $length, $line = 1)
    {
        $stringLength = mb_strlen($string, 'UTF-8');
        $offset       = ($length * $line);
        $title        = '';

        if ($stringLength > $offset)
        {
            $title  = $string;
            $string = mb_substr($string, 0, ($offset - 3), 'UTF-8');
        }

        $string     = preg_split('/(?<!^)(?!$)/u', $string);
        $stringInfo = array_chunk($string, $length);

        foreach ($stringInfo as $key => $value)
        {
            $stringInfo[$key] = implode('', $value);
        }
        $string = implode('<br />', $stringInfo);

        if (false === empty($title))
        {
            $string = "<span title='{$title}'>{$string}...</span>";
        }

        return $string;
    }
}