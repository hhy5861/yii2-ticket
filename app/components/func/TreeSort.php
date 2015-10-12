<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14-9-17
 * Time: 11:18
 */

namespace app\components\func;

trait TreeSort
{
    /**
     * 树型排序
     * @param $id
     * @param $items
     * @return array
     */
    public static function generateTree($id,$items)
    {
        $tree = [];
        foreach($items as $item)
        {
            if(isset($items[$item[$id]]))
            {
                $items[$item[$id]]['second'][] = &$items[$item['id']];
            }
            else
            {
                $tree[] = &$items[$item['id']];
            }
        }
        return $tree;
    }
} 