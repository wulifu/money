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
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>资金管理</cite></a>
              <a><cite>网站资金统计</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
        <hr>
        </div>
        <table class="layui-table">
            <input type="hidden" name="count" value="<?php echo $count ?> ">    
            <input type="hidden" name="profit" value="<?php echo $profit ?> ">    
            <input type="hidden" name="branch" value="<?php echo $branch ?> ">    
            <div id="main" style="width::400px;height:300px"></div>
        </table>
        <script src="./lib/layui/layui.js" charset="utf-8"></script>
        <script src="./js/x-layui.js" charset="utf-8"></script>
        <script src="./js/echarts.min.js"></script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航

     // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        var count = $("input[name='count']").val();
        var count1 = $("input[name='profit']").val();
        var count2 = $("input[name='branch']").val();
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '　　网站集资动态'
            },
            tooltip: {},
            legend: {
                data:['Money']
            },
            xAxis: {
                data: ["总支出","进账","总金额"]
            },
            yAxis: {},
            series: [{
                name: 'Money',
                type: 'bar',
                data: [count2, count1, count]
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
              
            });

            </script>
            <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>
</html>