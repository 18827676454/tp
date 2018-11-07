<?php


use \think\Request;

$basename = Request::instance()->root();
if (pathinfo($basename, PATHINFO_EXTENSION) == 'php') {
    $basename = dirname($basename);
}

return [
    // 模板参数替换
    'view_replace_str' => [
        '__ROOT__'   => $basename,
        '__STATIC__' => $basename . '/static',
        '__LIB__'    => $basename . '/static/lib',
    ],

    // traits 目录
    'traits_path'      => APP_PATH . 'admin' . DS . 'traits' . DS,

    // 异常处理 handle 类 留空使用 \think\exception\Handle
    'exception_handle' => '\\TpException',

    'template' => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'            => 'Think',
        // 模板路径
        'view_path'       => '',
        // 模板后缀
        'view_suffix'     => '.html',
        // 预先加载的标签库
        'taglib_pre_load' => 'app\\admin\\taglib\\Tp',
        // 默认主题
        'default_theme'   => '',
    ],
    //验证码
    'captcha'  => [
        // 验证码字符集合
        'codeSet'  => '2345679',
        // 使用中文验证码
        'useZh' =>false,
        // 字体大小
        'fontSize' => 35,
        // 是否画混淆曲线
        'useCurve' => true,
        // 验证码图片高度
        'imageH'   => '',
        // 验证码图片宽度
        'imageW'   => '',
        // 验证码长度（位数）
        'length'   => 4,
        // 验证成功后是否重置
        'reset'    => true
    ],
];
