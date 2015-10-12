<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14-8-26
 * Time: 15:01
 */

namespace app\components\service;

use yii;

class Redis implements IService
{
    public $data;

    private static $key;

    private static $_instance;

    private function __construct(){}

    public static function getInstance($key)
    {
        //self::$key  = '';
        //$defaultKey = '20650294a3a2a6a4bf7e785f1ec39dcc';
        //self::$key  = md5($defaultKey.$key);
        self::$key = $key;
        !self::$_instance && self::$_instance = new self();
        return self::$_instance;
    }

    private function __clone()
    {
        trigger_error('Clone is not allow' ,E_USER_ERROR);
    }

    /**
     * 返回数据集处理
     * @param array $data
     * @return array
     */
    private function dataSet(array $data)
    {
        $arr = [];
        if($data)
        {
            $m     = 0;
            $value = '';
            foreach($data as $v)
            {
                if(!$m)
                {
                    $m++;
                    $value = $v;
                }
                else
                {
                    $m       = 0;
                    $arr[$v] = $value;
                }
            }
        }

        return $arr;
    }

    /**
     * 从左边插入一个元素
     * @param $value
     */
    public function lPush($value)
    {
        return Yii::$app->redis->executeCommand('LPUSH',[self::$key,serialize($value)]);
    }

    /**
     * 从右边插入一个元素
     * @param $value
     */
    public function rPush($value)
    {
        return Yii::$app->redis->executeCommand('RPUSH',[self::$key,serialize($value)]);
    }

    /**
     * 获取列表起
     * @param array $param
     * @internal param $offset
     * @internal param $size
     * @return mixed
     */
    public function lRange(array $param)
    {
        $data = Yii::$app->redis->executeCommand('LRANGE',[self::$key,
                                                           $param['offset'],
                                                           $param['size']
                                                          ]);

        $proData = [];
        if($data)
        {
            for($i=0;$i<count($data);$i++)
            {
                $proData[] = unserialize($data[$i]);
            }
        }

        return $proData;
    }

    /**
     * 获取对列分页
     * @param int $page
     * @param int $size
     * @return mixed
     */
    public function listAll($page=0, $size=0)
    {
        !$size && $size = Yii::$app->redis->executeCommand('LLEN',[self::$key]);


        if($page >= 2)
        {
            $next = $size * $page -1;
            $page = $next - $size + 1;
        }
        else
        {
            $page = ($page - 1);
            $next = $size - 1;
        }
        $arr['offset'] = $page;
        $arr['size']   = $next;
        return self::lRange($arr);
    }

    /**
     * 删除某个元素
     * @param $limit
     * @param $value
     */
    public function lRem($limit,$value)
    {
        return Yii::$app->redis->executeCommand('LREM',[self::$key, $limit, serialize($value)]);
    }

    /**HDEL
     * 删除某个列表
     * @return mixed
     */
    public function del()
    {
        return Yii::$app->redis->executeCommand('DEL',[self::$key]);
    }

    /**
     * 删除某个列表
     * @return mixed
     */
    public function hDel($field)
    {
        return Yii::$app->redis->executeCommand('HDEL',[self::$key,$field]);
    }

    /**
     * 设置hash里面一个字段的值
     * @param array $param
     * @param $seconds
     */
    public function hSet($field,$param,$seconds=0)
    {
        $status = Yii::$app->redis->executeCommand('HSET',[self::$key,
                                                           $field,
                                                           serialize($param)
                                                          ]
                                                     );

        if($seconds && $status)
        {
            $this->expiree($seconds);
        }

        return $status;
    }

    /**
     * 读取哈希域的的值
     * @param $field
     * @return mixed
     */
    public function hGet($field)
    {
        $data = Yii::$app->redis->executeCommand('HGET',[self::$key,
                                                         $field,
                                                        ]
                                                  );

        return unserialize($data);
    }

    /**
     * 设置有较时间
     * @param $seconds
     * @return mixed
     */
    public function expiree($seconds)
    {
        $status = Yii::$app->redis->executeCommand('EXPIRE', [self::$key,$seconds]);

        return $status;
    }

    /**
     * 执行原子加1操作
     * @return mixed
     */
    public function incr()
    {
        return Yii::$app->redis->executeCommand('INCR', [self::$key]);
    }

    /**
     * 获取key的有效时间（ 单位：秒）
     * @return mixed
     */
    public function ttl()
    {
        return Yii::$app->redis->executeCommand('TTL', [self::$key]);
    }

    /**
     * 字符串设置
     * @param $param
     * @return mixed
     */
    public function set($param,$seconds = 0)
    {
        $status = Yii::$app->redis->executeCommand('SET', [self::$key, serialize($param)]);
        if($status && $seconds)
        {
            $this->expiree($seconds);
        }

        return $status;
    }

    /**
     * 字符串获取
     * @return mixed
     */
    public function get()
    {
        $data = Yii::$app->redis->executeCommand('GET', [self::$key]);

        $proData = '';
        $data && $proData = unserialize($data);

        return $proData;
    }

    /**
     * 添加指定的成员到key对应的有序集合中
     * @param $score
     * @param $member
     * @return mixed
     */
    public function zAdd($score,$member)
    {
        $this->data = Yii::$app->redis->executeCommand('ZADD',[self::$key,
                                                               $score,
                                                               $member]);

        return $this;
    }

    /**
     * 有序集key中，指定区间内的成员。其中成员的位置按score值递减(从大到小)来排列
     * @param $start
     * @param $stop
     * @return mixed
     */
    public function zRevranGe($start,$stop)
    {
        $data = Yii::$app->redis->executeCommand('ZREVRANGE',[self::$key,
                                                              $start,
                                                              $stop-1,
                                                              'WITHSCORES'
                                                             ]);



        return $this->dataSet($data);
    }

    /**
     * 指定分数范围的元素列表(也可以返回他们的分数)
     * @param $max
     * @param $limit
     * @param int $min
     * @return mixed
     */
    public function zRevrangeByScore($max,$limit,$min = 0, $start = false)
    {
        $min  = $min ? $min: '-inf';
        $start && $max = $max - 1;
        $data = Yii::$app->redis->executeCommand('ZREVRANGEBYSCORE',[self::$key,
                                                                     $max,
                                                                     $min,
                                                                     'WITHSCORES',
                                                                     'LIMIT',
                                                                     0,
                                                                     $limit
                                                                    ]);

        return $this->dataSet($data);
    }

    /**
     * 添加一个或多个指定的member元素到集合
     * @param $param
     * @return mixed
     */
    public function sAdd($param)
    {
        $key  = 'clump' . self::$key;
        if(is_array($param))
        {
            $param = serialize($param);
        }

        $data = Yii::$app->redis->executeCommand('SADD',[$key,$param]);
        return $data;
    }

    /**
     * 获取集合里面的所有
     * @return mixed
     */
    public function sMembers()
    {
        $key  = 'clump' . self::$key;
        $data = Yii::$app->redis->executeCommand('SMEMBERS',[$key]);

        return $data;
    }

    /**
     * 删除集合key
     * @return mixed
     */
    public function sDel()
    {
        self::$key  = 'clump' . self::$key;
        return $this->del();
    }


    /**
     * 有序集合中元素个数。 从key对应的有序集合中删除给定的成员。如果给定的成员不存在就
     * @return mixed
     */
    public function zRem($value)
    {
        $data = Yii::$app->redis->executeCommand('ZREM',[self::$key,$value]);
        return $data;
    }
}