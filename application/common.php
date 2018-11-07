<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 模拟tab产生空格
 * @param int $step
 * @param string $string
 * @param int $size
 * @return string
 */
function tab($step = 1, $string = ' ', $size = 4)
{
    return str_repeat($string, $size * $step);
}



/**
 * 树形列表
 *
 * @param array $list
 *            数据库原始数据
 * @param array $res_list
 *            返回的结果数组
 * @param int $pid
 *            上级ID
 * @param int $level
 *            当前处理的层级
 */
function list_tree($list, &$res_list, $pid = 0, $level = 0)
{
    foreach ($list as $k => $v) {
        if (intval($v ['pid']) != $pid)
            continue;

        if ($level > 0) {
            $space = '';
            for ($i = 1; $i < $level; $i++) {
                $space .= '──';
            }
            $v ['title'] = '├──' . $space . $v ['title'];
        }

        $v ['level'] = $level;
        $res_list [] = $v;
        unset ($list [$k]);

        list_tree($list, $res_list, $v ['id'], $level + 1);
    }
}

//添加等级段
function makeTree ( $data , $id = 0 , $level = 1 )
{
    static $result = [];
    foreach ( $data as $k => $v ) {
        if ( $v[ 'pid' ] == $id ) {
            $v[ 'level' ] = $level;
            $result[]     = $v;
            makeTree ( $data , $v[ 'id' ] , $level + 1 );
        }
    }

    return $result;
}