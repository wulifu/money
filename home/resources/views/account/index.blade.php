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
            <span class="property-val">{{$user->money}}</span>
            <span>总资产 ></span>
        </div>
        <div>
            <span>{{$earnings}}</span>
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
        <li class="open-fetch">
            <div>
                <span><i class="Hui-iconfont">&#xe63a;</i></span>
                <span>提现</span>
                <span class="jian"><i class="Hui-iconfont">&#xe6d7;</i></span>
            </div>
        </li>
        <li class="open-project">
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
                <span class="binding_username">胖子</span>
            </li>
            <li>
                <span>身份证号</span>
                <span class="binding_idcard">142625*****</span>
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
                <span> <input type="text" class="input card_num" name="name" placeholder="请输入银行卡号" pattern="^\d{19}$" required/></span>
            </li>
            <li>
                <span>预留手机</span>
                <span><input type="text" class="input phone" name="name" placeholder="银行预留手机号" pattern="^1[3|4|5|7|8][0-9]{9}$" required/></span>
            </li>
            <li >
                <span>验证码</span>
                <span style="width: 45%;"><input type="text" style="border-right: 1px solid #BEBEBE;width:95%;" class="input auth_code" name="name" placeholder="请输入短信验证码" pattern="[0-9A-Za-z]{5}" required/></span>
                <span>获取验证码</span>
            </li>
        </ul>
        <div class="quit binding-affirm">
            <span>绑定</span>
        </div>
    </div>
</div>
{{--绑定银行卡end--}}

{{--遮罩层begin--}}
<div class="shade">
    <div class="shade-hei">
        <img src="images/8acbba7381623d7c2940758bc90613ee.gif" alt="">
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
                <span> <input type="text" class="input recharge_val" name="recharge_val" placeholder="请输入充值金额" pattern="[0-9]{1,10}" required/></span>
            </li>
        </ul>
        <div class="quit recharge-affirm">
            <span>充值</span>
        </div>
    </div>
</div>
{{--充值end--}}

{{--提现begin--}}
<div class="fetch">
    <div class="title">
        <span class="back back-account-main-fetch"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>提现</span>
    </div>
    <div class="recharge-main">
        <ul>
            <li style="border-top:none">
                <span><i class="Hui-iconfont">&#xe6a7;</i></span>
                <span class="bank_name">中国工商银行</span>
                <span> > </span>
            </li>
            <li>
                <span>提现金额</span>
                <span> <input type="text" class="input fetch_val" name="recharge_val" placeholder="请输入提现金额" pattern="[0-9]{1,10}" required/></span>
            </li>
        </ul>
        <div class="quit fetch-affirm">
            <span>提现</span>
        </div>
    </div>
</div>
{{--提现end--}}

{{--提示框--}}
<div class="hint">提示框调试</div>

{{--我的投资项目页面--}}
<div class="project">
    <div class="title">
        <span class="back back-account-main-project"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>我的投资项目</span>
    </div>
    <div class="project-nav">
        <ul>
            <li class="project-nav-li project-nav-check">进行中</li>
            <li class="project-nav-li">已结算</li>
        </ul>
    </div>
</div>

</body>
<script src="/js/account.js"></script>
<script>

    $(function(){
        var action = "{{$action}}";
        var prior = "{{$prior}}";

        if(action == 'recharge'){
            open_recharge(prior);
        }
    })

    $('.open-project').click(function(){
        getinto('project');
    })

    $('.back-account-main-project').click(function(){
        back('project');
    })

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
                    if(msg[i].status == 0){
                        var color = 'green';
                        var status = '充值';
                    }else if(msg[i].status == 2){
                        var color = 'green';
                        var status = '收益';
                    }else if(msg[i].status == 1){
                        var color = 'red';
                        var status = '提现';
                    }else if(msg[i].status == 3){
                        var color = 'red';
                        var status = '投资';
                    }else{
                        var color = 'red';
                        var status = '理财有风险，投资需谨慎';
                    }

                    _html += '<li> <span><i class="Hui-iconfont">&#xe6b7;</i></span><span style="color:'+color+'">'+parseFloat(msg[i].money).toFixed(2)+'</span><span style="color:'+color+'">'+status+'</span><span>'+msg[i].time+'</span></li>'
                }
                $('.bill-main ul').html(_html);
                shadeHide();
                getinto('bill');
            },
            error:function(msg){
                shadeHide();
                showHint('查询失败');
            }
        })
    })
    $('.back-account-main').click(function(){
        back('bill')   //关闭我的账单页面
    })

    //充值页面
    $('.open-recharge').click(function(){
        open_recharge('recharge');
    })

    function open_recharge(action){
        shadeShow();
        $.ajax({
            type:'GET',
            url:"{{ action('AccountController@getIsBinding') }}",
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){
                    $('.bank_name').html(msg.data.bank_name+'（尾号'+msg.data.card_num+'）').attr('bind_id',msg.data.bind_id);
                    shadeHide();
                    getinto(action)
                }else if(msg.code == 0){
                    $('.binding_username').html(msg.data.username);
                    $('.binding_idcard').html(msg.data.idcard);
                    shadeHide();
                    getinto('binding')
                }else{
                    shadeHide();
                    showHint(msg.error);
                }

            },
            error:function(msg){
                shadeHide();
                showHint('查询失败');
            }
        })
    }

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
                    $('.fund .balance').html(msg.data.balance.toFixed(2));
                    shadeHide();
                    getinto('fund')
                }else{
                    alert(no);
                }

            },
            error:function(msg){
                shadeHide();
                showHint('查询失败');
            }
        })

    })

    //充值提交
    $('.recharge-affirm').click(function(){
        var recharge_val = $('.recharge_val').val();
        var bind_id = $('bank_name').attr('bind_id');
        if(recharge_val == '' || isNaN(recharge_val) || recharge_val < 1){
            showHint('请输入合法的充值金额')
            return false;
        }
        if(recharge_val > 10000){
            showHint('单笔金额不得超过10000元')
            return false;
        }
        shadeShow();
        $.ajax({
            type:'get',
            url:"/recharge",
            data:'recharge_val='+recharge_val+'&bind_id='+bind_id,
            dataType:'json',
            async:'false',
            success:function(msg){
                showHint('充值成功')
                var prior = "{{$prior}}";
                if(prior == ''){
                    $('.property-val').html(Number($('.property-val').html())+Number(recharge_val))
                    back('recharge')
                    shadeHide();
                }else{
                    location.href=prior;

                }

            },
            error:function(msg){
                showHint('操作失败，请稍后再试')
                shadeHide();
            }
        })
    })

    $('.binding-affirm').click(function(){

        var card_num = $('.card_num').val();
        var phone = $('.phone').val();
        var auth_code = $('.auth_code').val();

        var reg = /^\d{19}$/g;
        if(!reg.test(card_num)){
            showHint('请填写正确银行卡号')
            return false
        }

        var reg = /^1[3|4|5|7|8][0-9]{9}$/;
        if(!reg.test(phone)){
            showHint('请填写正确手机号')
            return false
        }

        var reg = /^\d{5}$/;
        if(!reg.test(auth_code)){
            showHint('请填写正确验证码')
            return false
        }
        shadeShow();
        $.ajax({
            type:'get',
            url:"/binding",
            data:'card_num='+card_num+'&phone='+phone+'&auth_code',
            async:false,
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){
                    var prior = "{{$prior}}";
                    if(prior == ''){
                        showHint('绑定成功')
                        location.replace(document.referrer);
                        //shadeHide()
                    }else{
                        location.href=prior;
                    }

                }else{
                    showHint(msg.error)
                    shadeHide()
                }
            },
            error:function(msg){
                showHint('请求超时，请检查网络')
                shadeHide()
            }
        })
    })
</script>
</html>
