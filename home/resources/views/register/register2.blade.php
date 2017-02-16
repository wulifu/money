<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/css.css">
	<title>注册2</title>
</head>
<body>
	<div>
		<div class='title'>
			<span><a href="javascript:void(0)" onclick="goBack()">〈 返回</a><h4 >个人注册</h4></span>
		</div>
		<div class="p" >
			<p style="display:none" id='block'>短信验证码已经发送，请您及时查收 !</p>
		</div>
		<div class='input'>
			<div>
				<input type="hidden" name="tell" value="<?php echo $tell ?>">
				<span>验证码　</span> <input type="text" name="code" size="20" placeholder="请输入短信验证码"/><span class='shu'>|</span><input type="button" id="btn" onclick="time(this)" value="获取验证码" />
			</div>
		</div>
		<div class='input'>
			<div>
				<span>登录密码</span> <input type="password" name="password" size="20" placeholder="6-12位字符，区分大小写"/>
			</div>
		</div>
		<div  >
			<p style="display:none" id='ts'></p>
		</div>
		<div class='sub'>
			<button class="but"><h4>立即注册</h4></button>
		</div>
		<div class="tsy" style="display:none">
			<p class='tsp'></p>
		</div>
	</div>
</body>
<script src="js/jquery.1.12.js"></script>
<script type="text/javascript"> 

/* 返回上一页面 */
function goBack(){
	window.history.go(-1); 
}

/* 验证码 */
var wait=60;  
function time(o) {  
	console.log(o);
        if (wait == 0) {  
            o.removeAttribute("disabled");            
            o.value="获取验证码";  
            wait = 60;  
        } else {  
            o.setAttribute("disabled", true);  
            o.value="重新发送(" + wait + ")";  
            wait--; 
            if(wait==55)
            {
            	url = 'checkcode';
				tell = $("input[name='tell']").val();
				/* 发送验证码 */
				$.get(url,{tell:tell});
				document.getElementById('block').style.display='';
            } 
            setTimeout(function() {  
                time(o)  
            },  
            1000) ; 
        }  
    }  

/* status = 0*/
var status = 0;
/* 验证密码是否合法 */
$("input[name='password']").blur(function(){
	password = $("input[name='password']").val();
	/* 验证空格 */
	if(password.indexOf(" ")!= -1)
	{
		$('.tsp').html('密码包含非法字符');
		/* 提示语隐藏 */
		$(".tsy").show(400).delay(2000).hide(300);
		status = 1;
		return;
	}

	/* 验证长度 */
	if(password.length<6 || password.length>12)
	{
		$('.tsp').html('6-12位字符');
		/* 提示语隐藏 */
		$(".tsy").show(400).delay(2000).hide(300);
		status = 2;
		return;
	}
	status = 0;
})


/* 发送请求 */
$('.but').click(function(){
	if(status == 0)
	{
		tell = $("input[name='tell']").val();
		code = $("input[name='code']").val();
		password = $("input[name='password']").val();
		if(code=='')
		{
			$('.tsp').html('请填写手机验证码');
			/* 提示语隐藏 */
			$(".tsy").show(400).delay(2000).hide(300);
			return;
		}

		if(password=='')
		{
			$('.tsp').html('6-12位字符');
			/* 提示语隐藏 */
			$(".tsy").show(400).delay(2000).hide(300);
			return;
		}

		/* Ajax请求 */
		url='user_add';
		$.get(url,{tell:tell,password:password,code:code},function(msg){
			if(msg.errCode==1)
			{
				$('.tsp').html(msg.msg);
				/* 提示语隐藏 */
				$(".tsy").show(400).delay(2000).hide(300);
				// location.href='';
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