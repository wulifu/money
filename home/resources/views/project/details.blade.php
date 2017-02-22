<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="css/des.css">
    <link href="hui/iconfont.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.1.12.min.js"></script>
    <title>驻马店人社</title>
</head>
<body>
<!--top开始-->
@foreach($res as $k=> $val)
<div class="top top_max">
    <div class="datum">
        <a href="JavaScript:void (0)" class="return"><span class="user Hui-iconfont" style="font-size: 16px; color: white">&#xe67d;</span></a>
       <b> <a href="project" style="color: white">{{$val->pro_name}}</a></b>
    </div>
    <div class="property">
       <span class="trem">{{$val->yield}}%<span>
        <span class="trem" style="font-size:12px ; margin-top:-10px;">预期年化收益率</span>
    </div>
    <div class="base">
        <span class="base_info">
            <span class="data font" ><span class="rq">{{$val->term}}</span>天</span>
            <span class="data title" >期限</span>
        </span>
        <span class="base_info">
            <span class="data font">
                <span class="status" style="display: none">{{$val->status}}</span>
              @if($val->status==1)
                进行中
              @elseif($val->status==0)
                已完成
              @endif
            </span>
            <span class="data title" >投资状态</span>
        </span>
        <span class="base_info" style="border: 0">
            <span class="data font">{{$val->money}}</span>
            <span class="data title">投资金额</span>
        </span>
    </div>
</div>
{{--介绍项目--}}
<div class="box">
      <div class="xiangxi"><span class="x_title">投资说明</span> <span class="x_min">{{$val->investment_dsc}}</span></div>
      <div class="xiangxi"><span class="x_title">用户余额</span> <span class="x_min">{{$last_money}}</span>
               <a href="account?a=recharge" class="button">充值</a></div>

    <div class="xiangxi">
        <input type="text" placeholder="请输入投资金额" class="text">
        @if($val->status==1)
        <a href="javascript:void (0)" class="but buts" >立即投资</a>
        @elseif($val->status==0)
        <a href="javascript:void (0)" class="but" style="background-color: grey">募捐完成</a>
        @endif
    </div>
    <a href="javascript:void (0)" class="a"><span class="fonts">点击查看更多信息</span></a>
</div>
{{--加入项目--}}
<span class="datails"style="display:none" >
    <div class="nav" >
        <ul>
            <li class="tab this">计划介绍</li>
            <li  class="tab" style="border-right: 0">加入记录</li>
        </ul>
    </div>
    <div class="tab_all">
        <spans class="referral" >
            <div class="info">
                <span class="check" style="display: none">{{$val->fin_id}}</span>
                <span class="info_1" >发布时间</span>
                <span class="info_2 ">{{date('Y.m.d H:i:s',$val->release_time)}}</span>
                <span class="last_time" style="display: none">{{$val->release_time}}</span>
            </div>
            <div class="info">
                <span class="info_1">募集总额</span>
                <span class="info_2">{{$money}}</span>
            </div>
            <div class="info">
                <span class="info_1">起息时间</span>
                <span class="info_2">T+{{$val->rebate_time}}(T为买标日)</span>
            </div>
            <div class="info">
                <span class="info_1">剩余时间</span>
                <span class="info_2 time" ></span>
            </div>
            <div class="bb">
                <span class="pros"><span class="pro">产品介绍</span></span>
                <p style="text-indent:2em;font-family: '微软雅黑 Light'; font-size: 13px; height: 120px; line-height: 20px;overflow-y:scroll;">{{$val->product_brief}}</p>
            </div>
            <div class="bb">
                  <span class="pros"><span class="pro">产品规则</span></span>
                  <div class="touzi">
                      <span class="touzi_t">投资说明</span>
                      <span class="touzi_c">{{$val->investment_dsc}}</span>
                  </div>
                  <div class="jixi">
                        <span class="touzi_t">计息规则</span>
                        <span class="touzi_c">{{$val->interest_rule}}</span>
                  </div>
                    <div class="chuli">
                        <span class="chuli_t">到期处理</span>
                        <p  class="chuli_x">{{$val->due_process}}</p>
                    </div>
            </div>
        </spans>
    @endforeach
        <spans style="display:none">
            <div class="max">
                <div class="man">
                    <b><span class="man_1">投资人</span>
                    <span class="man_1">投资金额</span>
                    <span class="man_1" >投资时间</span></b>
                </div>
            </div>
            <div id="zhong">
                @foreach($array as $key=>$value)
                <div class="se">
                    <span class="man_2">{{$phone[$key]}}</span>
                    <span class="man_2">{{$value->money}}</span>
                    <span class="man_3" style="text-align: left;">{{date('Y.m.d H:i:s',$value->time)}}</span>
                </div>
                @endforeach
            </div>
        </spans>
    </div>
</span>
{{--支付页面--}}
<span class="zhifu" style="display: none">
    @foreach($res as $k=>$val)
    <div class="datum">
        <a href="JavaScript:void (0)" class="click"><span class="Hui-iconfont user " style="font-size: 16px; color: white">&#xe67d;</span></a>
        <b>确认支付</b>
    </div>
    <div class="bt">
        {{$val->pro_name}}
    </div>
    <div class="sj">
        <div class="ll">
             <span class="ll_sz">{{$val->yield}}%</span>
             <span class="ll_t">预期年化收益率</span>
        </div>
        <div class="ll"; style="text-align: right;">
            <span class="ll_r" style="margin-right: 5%">{{$val->term}}天</span>
            <span class="ll_t" style="margin-right: 5%">投资期限</span>
        </div>
    </div>
    <div class="t_je">
        <span class="t_je_t">投资金额</span>
        <span class="t_je_s"></span>
    </div>
    <div class="t_je" style="border: 1px solid lightgrey">
        <span class="t_je_t">账户余额</span>
        <span class="bill_money">{{$last_money}}</span>
        <span><a href="javascript:void (0)" class="button">充值</a></span>
    </div>
    <div class="t_je" style="border: 0">
        <span class="t_je_t">实际支付</span>
        <span class="t_je_s" style="color: red; "></span>
    </div>
    <div class="ture_payment">
        <a href="javascript:void(0)" class="panment">确认投资</a>
        <input type="hidden" value="{{$user_id}}" class="user_id">
    </div>
    @endforeach
</span>
{{--遮罩层begin--}}
<div class="shade img" >
    <div class="shade-hei">
        <img src="images/8acbba7381623d7c2940758bc90613ee.gif" alt="">
    </div>
</div>
<div class="shade msg" style="background-color:transparent;">
    <div class="shade_text">
        <p class="p" style="color: white; text-align: center">投资金额大于100</p>
    </div>
</div>
<div class="shade bill" style="background-color:transparent;">
    <div class="shade_text">
        <p class="p" style="color: white; text-align: center">余额不足</p>
    </div>
</div>
<div class="shade msg1" style="background-color:transparent;">
    <div class="shade_text">
        <p class="p" style="color: white; text-align: center">投资成功</p>
    </div>
</div>
<div class="shade msg0" style="background-color:transparent;">
    <div class="shade_text">
        <p class="p" style="color: white; text-align: center">投资失败</p>
    </div>
</div>
{{--遮罩层end--}}
</body>
</html>
<script>
    //转移符转化为html
    $(function(){$('p').each(function(){$(this).html($(this).text())})})
    //计时器
    $(function(){
        times = setInterval(setTime, 1000);//每隔1秒执行函数
    })
    function setTime(){
        // 获取发布时候//获取期限
        var  term=$(".rq")
        var  unix =$(".last_time");
        var id=$(".check");
        var status=$(".status");
            var unixs=unix.html();
            var terms=term.html()*3600*24;
            var datetime = Date.parse(new Date())/1000;
            var timeIndex=unixs*1+terms*1-datetime*1;
            if(status.html()==1) {
                if (timeIndex > 0) {
                    var day = parseInt(timeIndex / 3600 / 24);    // 计算天
                    var hour = parseInt(timeIndex % (3600 * 24) / 3600);    // 计算时
                    var minutes = parseInt((timeIndex % 3600) / 60);    // 计算分
                    var seconds = parseInt(timeIndex % 60);    // 计算秒
                    hour = hour < 10 ? "0" + hour : hour;
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
                    $(".time").html(day + "天" + hour + ":" + minutes + ":" + seconds);
                    timeIndex++;
                } else {
                    $(".time").html(day + "天" + hour + ":" + minutes + ":" + seconds);
                }
            }else {
                $(".time").html(0 + "天" + 0 + ":" + 00 + ":" + 00);
            }
    }
    {{--隔行换色--}}
    objName=$("#zhong div");
    for (i=0;i<objName.length;i++ ) {
        (i%2==0)?(objName[i].className = "se"):(objName[i].className = "se_1");
    }
    {{-- 隐藏--}}
    $(".a").click(function(){
        $('.datails').show();
        $('.box').hide();
    })
    $(".return").click(function(){
        $('.box').show();
        $('.datails').hide();
    })
    $(".buts").click(function(){
        var text=$(".text").val();
        if(text>100){
            $(".t_je_s").html(text)
            $('.box').hide();
            $('.datails').hide();
            $('.top_max').hide();
            $('.zhifu').show();
        }else{
            $('.msg').show();
            function img(){
                $('.msg').hide();
            }
            setInterval(img,3000)
        }
    })
    $(".click").click(function(){
        $('.box').show();
        $('.datails').hide();
        $('.top_max').show();
        $('.zhifu').hide();
    })
    //    TAB切换
    $("div ul li ").click(function(){
        $(this).addClass('this').siblings().removeClass('this');
        var _index=$(this).index();
        $('.tab_all spans').eq(_index).show().siblings().hide();
    })
    //ajax投资
    $(".panment").click(function(){
        var money=$('.t_je_s').html()
        var bill_money=$('.bill_money').html()
            if(parseInt(money) > parseInt(bill_money)){
            $('.bill').show();
            function bill(){
                $('.bill').hide();
            }
            setInterval(bill,3000)
        }else{
            $('.img').show();
            var user_id=$('.user_id').val();
            var fin_id=$('.check').html();
            var new_money=bill_money-money;
        $.get('payment',{new_money:new_money,money:money,fin_id:fin_id,user_id:user_id},function(msg){
             if(msg.code==1){
                 $('.img').hide()
                 setInterval(msg1,4000)
                 $('.msg1').show();
                 function msg1(){$('.msg1').hide()}
                 location.reload()
             }else{
                 $('.img').hide()
                 $('.msg0').show();
                 function msg1(){$('.msg0').hide()}
                 setInterval(msg0,4000)
             }
        },'json')
        }

    })
</script>
