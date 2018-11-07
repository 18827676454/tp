<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"F:\phpstudy\WWW\tp-admin\public/../application/admin\view\demo\qrcode.html";i:1488899632;s:66:"F:\phpstudy\WWW\tp-admin\application\admin\view\template\base.html";i:1541129842;s:77:"F:\phpstudy\WWW\tp-admin\application\admin\view\template\javascript_vars.html";i:1539246613;}*/ ?>
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
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
    <script type="text/javascript" src="/static/lib/html5.js"></script>
    <script type="text/javascript" src="/static/lib/respond.min.js"></script>

    <link rel="stylesheet" href="/static/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/static/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/bootstrap-table/bootstrap-table.min.css">
    <link rel="stylesheet" href="/static/bootstrap-table/assets/examples.css">




    <link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/icheck/icheck.css"/>

    <script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>

    
    <!--定义JavaScript常量-->
<script>
    window.THINK_ROOT = '<?php echo \think\Request::instance()->root(); ?>';
    window.THINK_MODULE = '<?php echo \think\Url::build("/" . \think\Request::instance()->module(), "", false); ?>';
    window.THINK_CONTROLLER = '<?php echo \think\Url::build("___", "", false); ?>'.replace('/___', '');
</script>
</head>
<body>

<nav class="breadcrumb">
    <div id="nav-title"></div>
    <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:;"
       title="刷新"><i class="Hui-iconfont"></i></a>
</nav>


<div class="page-container">
    <div class="form form-horizontal">
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>Url 地址：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="请填写链接，包含 http 等协议前缀，支持 URL Scheme" name="url" id="qrcode-input">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="button" class="btn btn-primary radius generate">&nbsp;&nbsp;生成&nbsp;&nbsp;</button>
            </div>
        </div>

        <div class="row cl mt-50">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <div id="qrcode"></div>
                <p class="mt-10 c-red" id="qrcode-url"></p>
            </div>
        </div>
    </div>
    <div id="markdown" class="mt-20"></div>
</div>


<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/js/app.js"></script>
<script type="text/javascript" src="/static/lib/icheck/jquery.icheck.min.js"></script>

<!--<script src="/static/bootstrap-table/assets/bootstrap/js/bootstrap.js"></script>-->

<script src="/static/bootstrap-table/bootstrap-table.js"></script>

<script src="/static/bootstrap-table/tableExport.js"></script>

<script src="/static/bootstrap-table/bootstrap-table-export.js"></script>


<script src="/static/bootstrap-table/ga.js"></script>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script type="text/javascript" src="/static/lib/qrcode/qrcode.min.js"></script>
<script type="text/javascript" src="/static/lib/showdown/1.4.2/showdown.min.js"></script>
<script>
    $(function () {
        var url = 'https://github.com/yuan1994/tpadmin';
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: url,
            width: 128,
            height: 128,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        $("#qrcode-url").html(url);

        $(".generate").click(function () {
            url = $("#qrcode-input").val();
            if (!url || !/^[\w]*:\/\//i.test(url)) {
                layer.alert('请输入正确的链接，支持 URL Scheme');
                return ;
            }
            qrcode.makeCode(url);
            $("#qrcode-url").html(url);
        });

        var converter = new showdown.Converter(),
                text      = $("#markdown_tpl").html();
        $("#markdown").html(converter.makeHtml(text));
    })
</script>

<script type="text/plain" id="markdown_tpl">
---
方法
```
<div id="qrcode"></div>
var qrcode = new QRCode(document.getElementById("qrcode"), {
	text: "http://tpadmin.demo.tianpian.net.cn",
	width: 128,
	height: 128,
	colorDark : "#000000",
	colorLight : "#ffffff",
	correctLevel : QRCode.CorrectLevel.H
});
```
详细使用请参考 path/to/tpadmin/public/static/lib/qrcode/README.md
</script>


</body>
</html>