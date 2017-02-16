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
	<title>注册</title>
</head>
<body>
	<div>
		<div class='title'>
			<span><a href="javascript:void(0)" onclick="goBack()">〈 返回</a><h4 >天天理财</h4></span>
		</div>
		<div class="img">
			<img src="images/banner_heiban.jpg">
		</div>
		<div class='input'>
			<div>
				<span>手机号</span> <input type="text" name="tell" size="20" placeholder="请输入手机号"/> <span1 class='qx' onclick="del(this)">×</span1>
			</div>
		</div>
		<div class='sub'>
			<button class="but"><h4>下一步</h4></button>
		</div>
		<div class="tsy" style="display:none">
			<p class='tsp'></p>
		</div>
	</div>
</body>

<script src="js/jquery.1.12.js"></script>
<script>
	/* 返回上一页面 */
	function goBack(){
		window.history.go(-1); 
	}
	/* 清空手机号码值 */
	function del(obj){
		document.getElementsByName('tell')[0].value='';
	}

/* status = 0*/
status = 0;
/* 验证密码是否合法 */
$("input[name='tell']").blur(function(){
	tell = $("input[name='tell']").val();
	/* 验证空格 */
	if(tell.indexOf(" ")!= -1)
	{
		$('.tsp').html('手机号码不能包含空格');
		/* 提示语隐藏 */
		$(".tsy").show(400).delay(2000).hide(300);
		status = 1;
		return;
	}

	 // 验证长度 
	if(tell.length!=11)
	{
		$('.tsp').html('请正确填写手机号码');
		/* 提示语隐藏 */
		$(".tsy").show(400).delay(2000).hide(300);
		status = 2;
		return;
	}

	/* 验证数字 */
	if(isNaN(tell))
	{
		$('.tsp').html('手机号码必须为数字');
		/* 提示语隐藏 */
		$(".tsy").show(400).delay(2000).hide(300);
		status = 3;
		return;
	}
	status = 0;
})

/* 发送请求 */
$('.but').click(function(){
	if(status == 0)
	{
		tell = $("input[name='tell']").val();
		if(tell=='')
		{
			$('.tsp').html('请正确正确手机号码');
			/* 提示语隐藏 */
			$(".tsy").show(400).delay(2000).hide(300);
			return;
		}
		/* Ajax请求 */
		url= 'registers';
		$.get(url,{tell:tell},function(msg){
			location.href='registers'+'?tell='+tell;
		});
	}
})
</script>

</html>