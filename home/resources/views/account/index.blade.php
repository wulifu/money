<?php
namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Session\Session;
$uid = base64_encode(session('user_id'));

?>
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
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/spin.min.js"></script>
    <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=3158961813" type="text/javascript" language="javascript"></script>  <!--新浪微博-->
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
            <span class="property-val">{{round($user->money,2)}}</span>
            <span>总资产 ></span>
        </div>
        <div>
            <span>{{round($earnings,2)}}</span>
            <span>累计总收益</span>
        </div>
    </div>
    <div class="rate">
        <span>今日收益{{round($today_earnings,2)}}元&nbsp;年化收益率 3.89%</span>
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
        <li class="not">
            <div>
                <span><i class="Hui-iconfont">&#xe6b6;</i></span>
                <span>我的</span>
                <span class="jian"><i class="Hui-iconfont">&#xe6d7;</i></span>
            </div>
        </li>
        <li  class="open-invite">
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
<div class="bill" skip="10">
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
        <ul class="bill-more">
            <li style="border: none" class="bill-more-click">
                <p class="gengduo">查看更多</p>
                <div class="quan">
                    <div class="w-load"><div class="spin"></div></div>
                </div>
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
                <span class="project_money">0.00</span>
            </li>
            <li>
                <span class="dot" style="background:#00FF00"></span>
                <span>理财收益</span>
                <span class="project_earnings">0.00</span>
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

            <p  id="contentss">
            </p>
            <li>
                <span>充值金额</span>
                <span> <input type="text" class="input recharge_val" onfocus="" name="recharge_val" placeholder="请输入充值金额" pattern="[0-9]{1,10}" required/></span>
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
                <span class="bank_name fetch_band_id">中国工商银行</span>
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
            <li class="project-nav-li achieve project-nav-check">进行中</li>
            <li class="project-nav-li over" isclick="0">已结算</li>
        </ul>
    </div>
    <div class="project-achieve">
        <div style="margin-top: 0px" id="wrapper">
            <ul class="uls">
                <li class="li">
                    <div class="project_">
                        <div class="project-title">
                            <a href="details?fin_id=1">天使基金</a>
                            <span>我的投资金额：200 元</span>
                        </div>
                        <div class="cent">
                            <div class="data"><span class="trem">5%</span><span class="font">20天</span><span  class="font">100</span></div>
                            <div class="name"><span class="lv" >预期年化收益率</span><span class="nv" >期限</span  ><span class="nv" >预计金额</span></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="project-over">
        <div style="margin-top: 0px" id="wrapper">
            <ul class="uls">
            </ul>
        </div>
    </div>
</div>
{{--邀请begin--}}
<div class="invite">
    <div class="title">
        <span class="back back-account-main-invite"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>邀请奖励</span>
    </div>
    <div class="invite-top">
        <div class="invite-datum">
            <h3 style="color:#FF5809;padding-top: 30px">今日奖励</h3>
            <h1 style="color:#FF5809;padding-top: 20px">{{$user->new_money}}</h1>
        </div>

    </div>
    <div class="memu">
        <ul>
            <li class="">
                <div>
                    <span><i class="Hui-iconfont">&#xe616;</i></span>
                    <span style="color:#FF5809">累积奖励</span>
                    <span class="jian"><i class="Hui-iconfont">{{$user->invite_money}}&nbsp;RMB</i></span>
                </div>
            </li>
            <li class="">
                <div>
                    <span><i class="Hui-iconfont">&#xe705;</i></span>
                    <span style="color: #FF5809">我邀请的好友</span>
                    <span class="jian"><i class="Hui-iconfont">{{$user->invite_num}}&nbsp;人</i></span>
                </div>
            </li>
            {{--<li class="">--}}
                {{--<div>--}}
                    {{--<span><i class="Hui-iconfont">&#xe627;</i></span>--}}
                    {{--<span style="color: #FF5809">奖励说明</span>--}}
                    {{--<span class="jian"><i class="Hui-iconfont"></i></span>--}}
                {{--</div>--}}
            {{--</li>--}}
        </ul>
    </div>
    <input type="hidden" id="uid" value="<?php echo $uid ?>">
    <div class="invite-main">
        {{--<div class="quit">--}}
            {{--<span>邀请微信好友</span>--}}
        {{--</div>--}}
        {{--<div class="quit">--}}
            {{--<span>邀请QQ好友</span>--}}
        {{--</div>--}}
        <div class="quit">
            <a id="invite" href="javascript:void(0)"><span>分享到新浪微博</span></a>
        </div>
        {{--分享--}}
        {{--<!-- JiaThis Button BEGIN -->--}}
        {{--<div class="jiathis_style_m"></div>--}}
        {{--<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_m.js" charset="utf-8"></script>--}}
        {{--<!-- JiaThis Button END -->--}}
        <div style="margin-top: 200px;align-content: center">
            <center>
                <h3 style="color: #f75000;">邀请奖励详解</h3>
            </center>
            <br>
                <p style="font-size: 14px;color: orange">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当您点击分享按钮选择分享方式，并且分享成功后，若有您的好友通过分享的链接成功注册本网站，那么您和您的好友每人将会获得本网站赠送的十元现金红包！机会不多，赶快分享吧！</p>

        </div>
    </div>

</div>

{{--邀请end--}}
</body>
<!-- JiaThis Button BEGIN -->
<script "text/javascript">
var uid = $('#uid').val();
var jiathis_config = {
url: "http://money.itkang.xin/register?uid="+uid,
title: "点击进入天天理财得万元红包",
summary:"点击链接注册成功将得到10元现金红包，在个人中心可以查看。"
}
</script>
<script src="http://v2.jiathis.com/code/jiathis_r.js?move=0"></script>
<!-- JiaThis Button END -->
<script src="/js/account.js"></script>
<script>

    $(function(){
        var action = "{{$action}}";
        var prior = "{{$prior}}";

        if(action == 'recharge'){
            open_recharge(prior);
        }
    })
    //邀请页面
    $('.open-invite').click(function(){
        shadeShow();
        shadeHide();
        getinto('invite');
    })
    //微博分享
    $('#invite').click(function(){
        var uid = $('#uid').val();
        window.sharetitle = "http://money.itkang.xin/register?uid="+uid+"点击前面连接进入天天理财注册页面！"
        window.shareUrl = "http://man.lzpphp.com/img//12324235-1487905577.jpg"
        share()
    })
    function share(){
        //d指的是window
        (function(s,d,e){try{}catch(e){}
            var f='http://v.t.sina.com.cn/share/share.php?',
                    u=d.location.href,
                    p=['url=',e(u),'&title=',e(window.sharetitle),'&appkey=2924220432','&pic=',e(window.shareUrl)].join('');function a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=620,height=450,left=',
                        (s.width-620)/2,',top=',(s.height-450)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent)){setTimeout(a,0)}else{a()}})(screen,document,encodeURIComponent);
    }


    //我的账单页面
    $('.open-bill').click(function(){
        shadeShow()
        var _html = '<li> <span><i class="Hui-iconfont">&#xe6b7;</i></span><span>+1.89</span><span>收益</span><span>2017-02-15</span></li>';
        $.ajax({
            type:'get',
            url:"{{ action('AccountController@getBill') }}",
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){

                    var _html = '';
                    for(var i in msg.data){
                        if(msg.data[i].status == 0){
                            var color = 'green';
                            var status = '充值';
                        }else if(msg.data[i].status == 2){
                            var color = 'green';
                            var status = '收益';
                        }else if(msg.data[i].status == 1){
                            var color = 'red';
                            var status = '提现';
                        }else if(msg.data[i].status == 3){
                            var color = 'red';
                            var status = '投资';
                        }else if(msg.data[i].status == 4){
                            var color = 'green';
                            var status = '投资回款';
                        }else{
                            var color = 'red';
                            var status = '理财有风险，投资需谨慎';
                        }

                        _html += '<li> <span><i class="Hui-iconfont">&#xe6b7;</i></span><span style="color:'+color+'">'+parseFloat(msg.data[i].money).toFixed(2)+'</span><span style="color:'+color+'">'+status+'</span><span>'+msg.data[i].time+'</span></li>'
                    }
                    $('.bill-main ul:first').html(_html);
                    shadeHide();
                    getinto('bill');
                }else{
                    shadeHide();
                    showHint(msg.error)
                }
            },
            error:function(msg){
                shadeHide();
                showHint('查询失败');
            }
        })
    })

    //我的账单查看更多
    $('.bill-more-click').click(function(){
        var skip = $('.bill').attr('skip');
        $('.gengduo').hide();
        $('.quan').show();
        $.ajax({
            type:'get',
            url:"{{ action('AccountController@getBill') }}",
            data:'skip='+skip,
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){
                    var _html = '';
                    for(var i in msg.data){
                        if(msg.data[i].status == 0){
                            var color = 'green';
                            var status = '充值';
                        }else if(msg.data[i].status == 2){
                            var color = 'green';
                            var status = '收益';
                        }else if(msg.data[i].status == 1){
                            var color = 'red';
                            var status = '提现';
                        }else if(msg.data[i].status == 3){
                            var color = 'red';
                            var status = '投资';
                        }else if(msg.data[i].status == 4){
                            var color = 'green';
                            var status = '投资回款';
                        }else{
                            var color = 'red';
                            var status = '理财有风险，投资需谨慎';
                        }

                        _html += '<li> <span><i class="Hui-iconfont">&#xe6b7;</i></span><span style="color:'+color+'">'+parseFloat(msg.data[i].money).toFixed(2)+'</span><span style="color:'+color+'">'+status+'</span><span>'+msg.data[i].time+'</span></li>'
                    }
                    $('.gengduo').show();
                    $('.quan').hide();
                    $('.bill-main ul:first').append(_html);
                    $('.bill').attr('skip', Number($('.bill').attr('skip'))+10)
                }else if(msg.code == 2){
                    $('.gengduo').show();
                    $('.quan').hide();
                    showHint(msg.error);
                }
            },
            error:function(msg){
                $('.gengduo').show();
                $('.quan').hide();
                showHint('查询失败');
            }
        })
    })

    $('.back-account-main').click(function(){
        $('.bill').attr('skip',10)
        back('bill')   //关闭我的账单页面
    })

    //充值页面
    $('.open-recharge').click(function(){
        open_recharge('recharge');
    })

    function open_recharge(action){
        shadeShow();
        var prior = "{{$prior}}";
        var content = $('#contentss');

        var html = '';
        $.ajax({
            type:'GET',
            url:"{{ action('AccountController@getIsBinding') }}",
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){
                    $.each(msg.data,function(k,v){
                       html += '<li style="border-top:none"><span><i class="Hui-iconfont"><input type="radio" name="zhi" class="www" value='+msg.bind_id+' bank_id='+ v.bank_id+'></i></span><span class="bank_name">'+v.bank_name+'</span></li>'
                    })
                    content.html(html)
                    shadeHide();
                    if(prior != ''){
//                        $('.recharge_val').focus();
                        getinto('recharge')
                    }else{
                        getinto(action)
                    }

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
                    $('.fund .project_money').html(msg.data.project_money.toFixed(2));
                    $('.fund .project_earnings').html(msg.data.project_earnings.toFixed(2));
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
        var bind_id = $("input[name='zhi']").attr('value');
        var bank_id = $("input[name='zhi']:checked").attr('bank_id');
        if(recharge_val == '' || isNaN(recharge_val) || recharge_val < 1){
            showHint('请输入合法的充值金额')
            return false;
        }
        if(recharge_val > 10000){
            showHint('单笔金额不得超过10000元')
            return false;
        }
        shadeShow();
        if(bank_id==2)
        {
            $.ajax({
                type: "get",
                url: "/alipay",
                data: 'recharge_val='+recharge_val+'&bind_id='+bind_id+'&bank_id='+bank_id,
                success: function(msg){
                    location.href=msg;
                }
            });
        }else
        {
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
        }

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
