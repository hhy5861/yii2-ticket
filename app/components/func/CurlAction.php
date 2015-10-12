<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14-7-22
 * Time: 9:52
 */

namespace app\components\func;

use Yii;
use yii\helpers\Json;

class CurlAction
{
    private static $curl;

    private static $instance;

    /**
     * 防止创建对象
     */
    private function __construct(){}

    //单例方法
    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance=new self();
        }
        return self::$instance;
    }

    //阻止用户复制对象实例
    private function __clone()
    {
        trigger_error('Clone is not allow' ,E_USER_ERROR);
    }

    /**
     * POST 提交
     * @param $url
     * @param array $param
     * @return mixed
     */
    public function sendPost($url,$param = [])
    {
        $message = Yii::$app->curl->setOption(CURLOPT_CONNECTTIMEOUT,5)->post($url,$param);
        return Json::decode($message);
    }

    /**
     * GET提交
     * @param $url
     * @param array $param
     * @return mixed
     */
    public function sendGet($url,$param = [])
    {
        $message = Yii::$app->curl->get($url,$param);
        return Json::decode($message);
    }

    /**
     * HTTP格式删除
     * @param $url
     * @param array $param
     * @return mixed
     */
    public function sendDelete($url,$param = [])
    {
        $message = Yii::$app->curl->delete($url,$param);
        return Json::decode($message);
    }

    /**
     * GET下载图片提交
     * @param $url
     * @param array $param
     * @return mixed
     */
    public function sendImageGet($url,$param = [])
    {
        $message = Yii::$app->curl->setOption(CURLOPT_HEADER, 1)->get($url,$param);

        list($header, $img)  =  explode("\r\n\r\n", $message, 2);

        preg_match('/filename="(.*)"/', $header, $name);
        $fileName            = '/tmp/'.$name[1];
        $size                = file_put_contents($fileName, $img);
        return [$fileName,$size];
    }

    /**
     * 设置两段URL
     * @param $url
     * @param array $param
     * @return bool|string
     */
    public function setUrl($url,$param = [])
    {
        if(is_array($param))
        {
            return $url.http_build_query($param);
        }
        return false;
    }

    /**
     * 图片url下载到本地
     * @param $url
     * @param string $save_dir
     * @param bool $type
     * @return array
     */
    public function downloadImg($url,$save_dir='/tmp/',$type=true)
    {
        if(trim($url) === '')
        {
            return ['fileName' => '','path' => '','code' => 1];
        }

        if(trim($save_dir) == '')
        {
            $save_dir='./';
        }

        //创建文件名
        $filename = (string) new \MongoId();

        //创建保存目录
        if(!file_exists($save_dir) && !mkdir($save_dir,0777,true))
        {
            return ['fileName' => '','path' => '','code' => 5];
        }

        //获取远程文件所采用的方法
        if($type)
        {
            $ch=curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $img = curl_exec($ch);
            curl_close($ch);
        }
        else
        {
            ob_start();
            readfile($url);
            $img = ob_get_contents();
            ob_end_clean();
        }

        file_put_contents($save_dir.$filename,$img);

        return ['fileName' => $filename,'path' => $save_dir.$filename,'code' => 0];
    }

    /**
     * POST 非堵塞
     * @param $url
     * @param $params JSON 格
     */
    public function postNonBlocking($url, array $params = [])
    {
        $post_string = '';
        $params && $post_string = Json::encode($params);

        $parts = parse_url($url);
        $fp    = fsockopen($parts['host'],
                           80,
                           $errno, $errstr, 30);

        $out = "POST ".$parts['path']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/json\r\n";
        $out.= "Content-Length: ".strlen($post_string)."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        if(isset($post_string)) $out.= $post_string;

        fwrite($fp, $out);
        fclose($fp);
    }
}