<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/css.css">
	<title>验证密码</title>
</head>
<body>
	<div>
		<div class='title'>
			<span><a href="javascript:void(0)" onclick="goBack()">〈 返回</a><h4 >个人登录</h4></span>
		</div>
		<div class="img">
			<img src="images/banner_heiban.jpg">
		</div>
		<div class='input'>
			<div>
				<input type="hidden" name="tell" value="<?php echo $tell ?>">
				<span>密码</span> <input type="password" name="password" size="20" placeholder="请输入用户密码"/> <span1 class='qx' onclick="del(this)">×</span1>
			</div>
			<div class='zhaohui'>
				<a href="javascript:void(0)" class="zh" style="font-size:14px">忘记登录密码?</a>
			</div>
		</div>
		<div class='sub'>
			<button class="but"><h4>确认</h4></button>
		</div>

		<div class="tsy" style="display:none">
			<p class='tsp'>用户已注册请登录</p>
		</div>
	</div>
</body>

<script src="js/jquery.1.12.js"></script>
<script>
/* 提示语隐藏 */
$(".tsy").show(400).delay(2000).hide(300);

	/* 返回上一页面 */
	function goBack(){
		window.history.go(-1); 
	}
	/* 清空手机号码值 */
	function del(obj){
		document.getElementsByName('password')[0].value='';
	}


/* 找回密码 */
$('.zh').click(function(){
	tell = $("input[name='tell']").val();
	location.href='backpwd'+'?tell='+tell;
})


/* 发送请求 */
$('.but').click(function(){
	if(status == 0)
	{
		tell = $("input[name='tell']").val();
		password = $("input[name='password']").val();
		if(password=='')
		{
			$('.tsp').html('请输入正确密码');
			/* 提示语隐藏 */
			$(".tsy").show(400).delay(2000).hide(300);
			return;
		}
		/* Ajax请求 */
		url= 'login';
		$.get(url,{tell:tell,password:password},function(msg){
			if(msg.errCode==1)
			{
				$('.tsp').html(msg.msg);
				/* 提示语隐藏 */
				$(".tsy").show(400).delay(2000).hide(300);
				// location.href='registers'+'?tell='+tell;
			}
			else
			{
				$('.tsp').html(msg.msg);
				/* 提示语隐藏 */
				$(".tsy").show(400).delay(2000).hide(300);
			}
		},'json');
	}
})
</script>

</html>