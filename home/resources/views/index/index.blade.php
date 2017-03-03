<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="m.178hui.com" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no">
<title>天天理财</title>
	<link href="css/owl.carousel.css" rel="stylesheet">
<link href="css/public.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="layer/layer.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$(".mall_list a").click(function(){
		var index = layer.open({
			type: 1,
			title: false,
			closeBtn: false,
			shadeClose: false,
			offset: '25%',
			content: "<div class='no_login_show'><h1>亲！您还没登录一起惠哦！</h1><a href='login.html'>马上登录</a><a href='register.html'>免费注册</a><a href='#'>先购物，再返利</a><a href='javascript:layer.closeAll();'>取消</a></div>"
		});
	});
	$("#msg_bijia").click(function(){
		layer.tips('请耐心等待一下，我们正在拼命开发中···','#msg_bijia');
	});
}); 
</script>
</head>

<body>
<div class="mobile">
	<div class="header">
    	<div class="m_logo"><a href="#"><img src="images/m-index_02.png"></a></div>
       <div class="m_search"><a href="#"><img src="images/m-index_05.png" width="40"></a></div>
    </div>
	<div class="top w">
   	<div class="m_banner" id="owl">
            <a href="#" class="item"><img src="images/123.jpg"></a>
            <a href="#" class="item"><img src="images/888.jpg"></a>
            <a href="#" class="item"><img src="images/50.jpg"></a>
      </div>
        <div class="m_nav">
        <a href="project"><img src="images/gus.png"><span>理财</span></a>
            <a href="account?a=recharge"><img src="images/gdlc.png"><span>充值</span></a>
        	<a href="#"><img src="images/jy.png"><span>交易</span></a>
           <a href="#"><img src="images/dq.png"><span>排行</span></a>
            <a href="#"><img src="images/gs.png"><span>基金公司</span></a>
            <a href="user_prize"><img src="images/qd.png"><span>有奖签到</span></a>
            <a href="#"><img src="images/zhinan.png"><span>新手指南</span></a>
            <a href="account"><img src="images/grzx.png"><span>会员中心</span></a>
        </div>
  </div>
  <div class="m_mall w" >
  	<div class="mall_title"><span>推荐项目</span><em><a href="project">更多</a></em></div>
    <div class="mall_list" style="margin:0px;">
    @foreach ($pros as $pro)
    <a href="details?fin_id={{$pro->fin_id}}" class="mall"><li class="card__item card__item--orange">
      <div class="card__info" >
      <div class="info-player" >
        <img src="images/3.jpg" style="width: 200px height:100px;">
        <span>
          <p class="info-player__name"><?php  echo mb_substr("$pro->pro_name ",0,5,'utf-8');  ?><br><small style='color:red;'>收益： {{ $pro->yield }}%</small></p>
          </span>
        </div>
        <br>
      </div >
    </li></a>
     @endforeach
    </div>
  </div>

  </div>
  
   <div class="m_user w">
   
      <a href="register">登录</a>
      <a href="register">注册</a>
      <a href="javascript:void(0);" class="backtop">返回顶部</a>  
      </div>
 

</div>

<br>
<div style="margin: 50px;">
    {{--引入导航栏--}}
@extends('layouts.nav') 
</div>

</body>

</html>

<script type="text/javascript">
//返回顶部
$(document).ready(function(){
	$(window).scroll(function () {
		var scrollHeight = $(document).height();
		var scrollTop = $(window).scrollTop();
		var $windowHeight = $(window).innerHeight();
		scrollTop > 75 ? $(".gotop").fadeIn(200).css("display","block") : $(".gotop").fadeOut(200).css({"background-image":"url(images/iconfont-fanhuidingbu.png)"});
	});
	$('.backtop').click(function (e) {
		$(".gotop").css({"background-image":"url(images/iconfont-fanhuidingbu_up.png)"});
		e.preventDefault();
		$('html,body').animate({ scrollTop:0});
	});
});
</script>