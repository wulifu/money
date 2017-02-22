<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="css/project.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link href="hui/iconfont.css" rel="stylesheet" type="text/css" />
    <script src="js/iscroll.js"></script>
    <script src="js/pullToRefresh.js"></script>
    <script src="js/colorful.js"></script>
    <script src="js/jquery.1.12.min.js"></script>
    <title>天天理财</title>
    <style type="text/css" media="all">
        body, html {
            padding: 0;
            margin: 0;
            height: 100%;
            font-family: Arial, Microsoft YaHei;
            color: #111;
        }
        li {
            /*border-bottom: 1px #CCC solid;*/
            text-align: center;
            line-height: 40px;
        }
        .pagination li{
            float: left;
        }
    </style>
</head>
<body>


{{--引入导航栏--}}
@extends('layouts.nav')

<div class="top">
    <a href="JavaScript:void(0)" onclick="window.history.go(-1);"><span class="user Hui-iconfont">&#xe67d;</span></a>
    <div class="datum">
        <b>理财 项目</b>
    </div>
</div>
<div style="margin-top: 45px" id="wrapper">
    <ul class="uls">
       @foreach($res as $val)
            <li class="li">
                <div class="project">
                    <div class="title"><a href="details?fin_id={{$val->fin_id}}">{{$val->pro_name}}</a></div>
                    <div class="cent">
                        <div class="data"><span class="trem">{{$val->yield}}%</span><span class="font">{{$val->term}}天</span><span  class="font">{{$val->money}}</span></div>
                        <div class="name"><span class="lv" >预期年化收益率</span><span class="nv" >期限</span  ><span class="nv" >剩余金额</span></div>
                    </div>
                </div>
            </li>
        @endforeach
        <span style="display: none" class="sum">{{$sum}}</span>
        <div id="jie"></div>
    </ul>

</div>
</body>
<script>
    var i=2;
    refresher.init({
        id: "wrapper",
        pullUpAction: Load
    });
    function Load() {
        setTimeout(function () {
            var jie=$("#jie");
            var sum= $(".sum").html();
            if(i<=sum){
                var childdiv=$('<div></div>');        //创建一个子div
                childdiv.attr('id','child'+i);            //给子div设置class
                childdiv.prependTo(jie);
                var url="project?page="+i;
                jie.append($("#child"+i).load(url+" .uls"));
                i++;
            }else{
                alert("已经到底部了!!");
            }
            wrapper.refresh();
        }, 3000);
    }
</script>

</html>
