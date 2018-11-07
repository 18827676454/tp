<?php
/*
 +----------------------------------------------------------------------
 + Title        : Goods 控制器
 + Author       : Randy_chen
 + Version      : V1.0.0.1
 + Initial-Time : 2018/11/5 0005 15:29
 + Last-time    : 2018/11/5 0005 15:29+ Randy_chen
 + Desc         : Goods
 +----------------------------------------------------------------------
*/


namespace app\admin\controller;

\think\Loader::import ( 'controller/Controller' , \think\Config::get ( 'traits_path' ) , EXT );

use app\admin\Controller;
//use app\common\model\Category;

class Goods extends Controller
{
    use \app\admin\traits\controller\VueController;
    protected static $isdelete = false; //禁用该字段

//    protected static $blacklist = [ 'add' , 'edit' , 'delete' , 'deleteforever' , 'forbid' , 'resume' , 'recycle' , 'recyclebin' , 'clear' ];

    public function beforeAdd(){
        $goods_type = db('Category')->select();
        //获取商品分类
        //获取
        $this->assign('goods_type', json_encode(makeTree($goods_type)));
    }

    protected function beforeEdit()
    {
        $goods_type = db('Category')->select();
        //获取商品分类
        //获取
        $this->assign('goods_type', json_encode(makeTree($goods_type)));
    }

}