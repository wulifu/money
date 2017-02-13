<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        X-admin v1.0
    </title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="./css/x-admin.css" media="all">
</head>
<body>
<?php
use yii\helpers\Url;
?>
<div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>后台</cite></a>
              <a><cite>投资项目管理</cite></a>
              <a><cite>投资清单</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock><a href="<?php echo  Url::toRoute(['project/index']);?>"><button class="layui-btn layui-btn-danger"><i class="layui-icon">&#xe630;</i>返回项目列表</button></a></xblock>
    <table class="layui-table">
        <thead>
        <tr>
           <th>投资人</th>
           <th>投资金额</th>
           <th>投资时间</th>
        </tr>
        </thead>
        <tbody id="x-img">
        <?php foreach($res as $val) {?>
        <tr>
           <td><?php echo $val['phone']?></td>
           <td><?php echo $val['money']?></td>
           <td><?php echo $val['time']?></td>

        </tr>

        <?php }?>
        </tbody>
    </table>

    <div id="page"></div>
</div>
</body>
<script src="./lib/layui/layui.js" charset="utf-8"></script>
<script src="./js/x-layui.js" charset="utf-8"></script>
<script>
    layui.use(['laydate','element','laypage','layer'], function(){
        $ = layui.jquery;//jquery
        lement = layui.element();//面包导航
    });
</script>
</html>