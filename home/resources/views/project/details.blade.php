<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="{{asset('css/des.css')}}">
    <link href="{{asset('hui/iconfont.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/jquery.1.12.min.js')}}"></script>
    <title>驻马店人社</title>
</head>
<body>
<!--top开始-->
@foreach($res as $k=> $val)
<div class="top">
    <div class="datum">
        <a href="JavaScript:void (0)" class="return"><span class="user Hui-iconfont" style="font-size: 16px; color: white">&#xe67d;</span></a>
        <b>{{$val->pro_name}}</b>
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
<div class="box">
      <div class="xiangxi"><span class="x_title">投资说明</span> <span class="x_min">{{$val->investment_dsc}}</span></div>
      <div class="xiangxi"><span class="x_title">用户余额</span> <span class="x_min">2000.00</span>
               <a href="javascript:void (0)" class="button">充值</a></div>
    <div class="xiangxi"><input type="text" placeholder="请输入投资金额" class="text"> <a href="javascript:void (0)" class="but">立即投资</a></div>
    <a href="javascript:void (0)" class="a"><span class="fonts">点击查看更多信息</span></a>
</div>
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
</body>
</html>
<script>
    $(function(){$('p').each(function(){$(this).html($(this).text())})})
    //计时器
    // 获取发布时候//获取期限
    $(function(){
        times = setInterval(setTime, 1000);//每隔1秒执行函数
    })
    function setTime(){
        var  term=$(".rq")
        var  unix =$(".last_time");
        var id=$(".check");
        var status=$(".status");
            var unixs=unix.html();
            var terms=term.html()*3600*24;
            var datetime = Date.parse(new Date())/1000;
            var timeIndex=unixs*1+terms*1-datetime*1;
//        alert(timeIndex)
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


$(".a").click(function(){
    $('.datails').show();
    $('.box').hide();
})
$(".return").click(function(){
    $('.box').show();
    $('.datails').hide();
})
$("div ul li ").click(function(){
    $(this).addClass('this').siblings().removeClass('this');
    var _index=$(this).index();
    $('.tab_all spans').eq(_index).show().siblings().hide();
})
</script>
