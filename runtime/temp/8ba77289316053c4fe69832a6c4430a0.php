<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"F:\phpstudy\WWW\tp-admin\public/../application/admin\view\demo\download.html";i:1488899632;s:66:"F:\phpstudy\WWW\tp-admin\application\admin\view\template\base.html";i:1488899632;s:77:"F:\phpstudy\WWW\tp-admin\application\admin\view\template\javascript_vars.html";i:1539208302;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title><?php echo \think\Config::get('site.title'); ?></title>
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/static/lib/html5.js"></script>
    <script type="text/javascript" src="/static/lib/respond.min.js"></script>
    <script type="text/javascript" src="/static/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/icheck/icheck.css"/>
    
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--定义JavaScript常量-->
<script>
//    window.THINK_ROOT = '<?php echo \think\Request::instance()->root(); ?>';
//    window.THINK_MODULE = '<?php echo \think\Url::build("/" . \think\Request::instance()->module(), "", false); ?>';
//    window.THINK_CONTROLLER = '<?php echo \think\Url::build("___", "", false); ?>'.replace('/___', '');
</script>
</head>
<body>

<nav class="breadcrumb">
    <div id="nav-title"></div>
    <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:;" title="刷新"><i class="Hui-iconfont"></i></a>
</nav>


<div class="page-container">
    <a class="btn btn-success" href="<?php echo \think\Url::build('','file=build.php'); ?>" target="download">下载文件</a>
    <div id="markdown" class="mt-20"></div>
</div>

<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/js/app.js"></script>
<script type="text/javascript" src="/static/lib/icheck/jquery.icheck.min.js"></script>

<script type="text/javascript" src="/static/lib/showdown/1.4.2/showdown.min.js"></script>
<script>
    $(function () {
        var converter = new showdown.Converter(),
                text      = $("#markdown_tpl").html();
        $("#markdown").html(converter.makeHtml(text));
    })
</script>
<script type="text/plain" id="markdown_tpl">
---
方法：
```
/File::download($file_path,$file_name = '',$file_size = '',$ext='');
```
助手函数：
```
download($file_path,$file_name = '',$file_size = '',$ext='');
```
html 代码：
```
<a class="btn btn-success" href="<?php echo \think\Url::build('','file=build.php'); ?>" target="download">下载文件</a>
```
php 代码：
```
public function download()
{
    if ($this->request->param('file')) {
        return \File::download("../build.php");
    } else {
        return $this->view->fetch();
    }
}
```
</script>

</body>
</html>