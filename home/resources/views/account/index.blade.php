<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="css/account.css">
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link href="hui/iconfont.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery-1.7.2.min.js"></script>

    <title>我的账户</title>
</head>
<body>
<!--top开始-->
<div class="account-main">
{{--引入导航栏--}}
@extends('layouts.nav')

<div class="top">
    <a href="/datum" class="user"><i class="Hui-iconfont">&#xe705;</i></a>
    <div class="datum">
        <span class="username">{{$user->username}}</span>
    </div>
    <div class="property">
        <div style="border-right: 1px solid #F75000" class="open-property">
            <span>{{$user->money}}</span>
            <span>总资产 ></span>
        </div>
        <div>
            <span>20.00</span>
            <span>累计总收益</span>
        </div>
    </div>
    <div class="rate">
        <span>今日收益0.00元&nbsp;年化收益率 3.89%</span>
    </div>
</div>
<div class="memu">
    <ul>
        <li class="open-bill">
            <div>
                <span><i class="Hui-iconfont">&#xe627;</i></span>
                <span>我的账单</span>
                <span class="jian"><i class="Hui-iconfont">&#xe6d7;</i></span>
            </div>
        </li>
        <li class="open-recharge">
            <div>
                <span><i class="Hui-iconfont">&#xe6ca;</i></span>
                <span>充值</span>
                <span class="jian"><i class="Hui-iconfont">&#xe6d7;</i></span>
            </div>
        </li>
        <li>
            <div>
                <span><i class="Hui-iconfont">&#xe63a;</i></span>
                <span>提现</span>
                <span class="jian"><i class="Hui-iconfont">&#xe6d7;</i></span>
            </div>
        </li>
        <li>
            <div>
                <span><i class="Hui-iconfont">&#xe616;</i></span>
                <span>我的投资项目</span>
                <span class="jian"><i class="Hui-iconfont">&#xe6d7;</i></span>
            </div>
        </li>
    </ul>
</div>
<div class="memu memu-two">
    <ul>
        <li>
            <div>
                <span><i class="Hui-iconfont">&#xe6b6;</i></span>
                <span>我的</span>
                <span class="jian"><i class="Hui-iconfont">&#xe6d7;</i></span>
            </div>
        </li>
        <li>
            <div>
                <span><i class="Hui-iconfont">&#xe6ab;</i></span>
                <span>邀请好友</span>
                <span class="jian"><i class="Hui-iconfont">&#xe6d7;</i></span>
            </div>
        </li>
    </ul>
</div>
</div>
{{--主体end--}}

{{--我的账单begin--}}
<div class="bill" >
    <div class="title">
        <span class="back back-account-main"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>我的账单</span>
    </div>
    <div class="bill-main">
        <ul>
            <li>
                <span><i class="Hui-iconfont">&#xe6b7;</i></span>
                <span>+1.89</span>
                <span>收益</span>
                <span>2017-02-15</span>
            </li>
        </ul>
    </div>
</div>
{{--我的账单end--}}

{{--绑定银行卡begin--}}
<div class="binding">
    <div class="title">
        <span class="back back-account-main-binding"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>绑定银行卡</span>
    </div>
    <div class="binding-main">
        <span class="binding-msg">持卡人信息</span>
        <ul>
            <li style="border-top:none">
                <span>姓名</span>
                <span>胖子</span>
            </li>
            <li>
                <span>身份证号</span>
                <span>142625*****</span>
            </li>
        </ul>
        <span class="binding-msg">银行卡信息</span>
        <ul>
            <li style="border-top:none">
                <span>银行名称</span>
                <span>请选择银行类型</span>
            </li>
            <li>
                <span>银行卡号</span>
                <span> <input type="text" class="input" name="name" placeholder="请输入银行卡号" pattern="[0-9A-Za-z]{6,16}" required/></span>
            </li>
            <li>
                <span>预留手机</span>
                <span><input type="text" class="input" name="name" placeholder="银行预留手机号" pattern="[0-9A-Za-z]{6,16}" required/></span>
            </li>
            <li>
                <span>验证码</span>
                <span><input type="text" style="border-right: 1px solid #BEBEBE;" class="input" name="name" placeholder="请输入短信验证码" pattern="[0-9A-Za-z]{6,16}" required/></span>
                <span>获取验证码</span>
            </li>
        </ul>
        <div class="quit">
            <span>绑定</span>
        </div>
    </div>
</div>
{{--绑定银行卡end--}}

{{--遮罩层begin--}}
<div class="shade">
    <div class="shade-hei">
        <img src="/images/8acbba7381623d7c2940758bc90613ee.gif" alt="">
    </div>
</div>
{{--遮罩层end--}}

{{--总资产begin--}}
<div class="fund">
    <div class="title">
        <span class="back back-account-main-fund"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>总资产</span>
    </div>
    <div class="fund-main">
        <div class="fund-earnings">
            <span>总收益（元）</span>
            <span class="earnings">0.00</span>
        </div>
        <ul>
            <li style="border-top:none">
                <span class="dot" style="background:#1E90FF "></span>
                <span>可用余额</span>
                <span class="balance">0.00</span>
            </li>
            <li>
                <span class="dot" style="background:  	#DA70D6"></span>
                <span>理财资产</span>
                <span>0.00</span>
            </li>
            <li>
                <span class="dot" style="background:  	#FFFF00"></span>
                <span>冻结余额</span>
                <span>0.00</span>
            </li>
        </ul>
    </div>
</div>
{{--总资产end--}}

{{--充值begin--}}
<div class="recharge">
    <div class="title">
        <span class="back back-account-main-recharge"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>充值</span>
    </div>
    <div class="recharge-main">
        <ul>
            <li style="border-top:none">
                <span><i class="Hui-iconfont">&#xe6a7;</i></span>
                <span class="bank_name">中国工商银行</span>
                <span> > </span>
            </li>
            <li>
                <span>充值金额</span>
                <span> <input type="text" class="input" name="name" placeholder="请输入充值金额" pattern="[0-9]{1,10}" required/></span>
            </li>
        </ul>
        <div class="quit">
            <span>充值</span>
        </div>
    </div>
</div>
{{--充值end--}}
</body>
<script src="/js/account.js"></script>
<script>

    //我的账单页面
    $('.open-bill').click(function(){
        shadeShow()
        var _html = '<li> <span><i class="Hui-iconfont">&#xe6b7;</i></span><span>+1.89</span><span>收益</span><span>2017-02-15</span></li>';
        $.ajax({
            type:'get',
            url:"{{ action('AccountController@getBill') }}",
            dataType:'json',
            success:function(msg){
                var _html = '';
                for(var i in msg){
                    if(msg[i].status == 1){
                        var color = 'green';
                        var status = '充值';
                    }else if(msg[i].status == 2){
                        var color = 'green';
                        var status = '收益';
                    }else if(msg[i].status == 3){
                        var color = 'red';
                        var status = '提现';
                    }

                    _html += '<li> <span><i class="Hui-iconfont">&#xe6b7;</i></span><span style="color:'+color+'">'+parseFloat(msg[i].money)+'</span><span style="color:'+color+'">'+status+'</span><span>'+msg[i].time+'</span></li>'
                }
                $('.bill-main ul').html(_html);
                shadeHide();
                getinto('bill');
            }
        })
    })
    $('.back-account-main').click(function(){
        back('bill')   //关闭我的账单页面
    })

    //充值页面
    $('.open-recharge').click(function(){

        shadeShow();
        $.ajax({
            type:'GET',
            url:"{{ action('AccountController@getIsBinding') }}",
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){
                    $('.bank_name').html(msg.data.bank_name);
                    shadeHide();
                    getinto('recharge')
                }else{
                    getinto('binding')
                }

            }
        })


    })
    $('.back-account-main-binding').click(function(){
        back('binding')
    })

    //查看总资产
    $('.open-property').click(function(){
        shadeShow();
        $.ajax({
            type:'GET',
            url:"{{ action('AccountController@getProperty') }}",
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){
                    $('.earnings').html(msg.data.earnings);
                    $('.fund .balance').html(msg.data.balance);
                    shadeHide();
                    getinto('fund')
                }else{
                    alert(no);
                }

            }
        })

    })
</script>
</html>
