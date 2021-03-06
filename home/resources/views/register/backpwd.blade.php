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
	<title>重置密码</title>
</head>
<body>
	<div>
		<div class='title'>
			<span><a href="javascript:void(0)" onclick="goBack()">〈 返回</a><h4 >重置密码</h4></span>
		</div>
		<div class="p" >
			<p style="display:none" id='block'>短信验证码已经发送，请您及时查收 !</p>
		</div>
		<div class='input'>
			<div>
				<span>手机号  </span> <input type="text" name="tell" size="30" placeholder="请输入手机号码" value="<?php echo $tell ?>" /> <span1 class='qx' onclick="del(this)">×</span1>
			</div>
		</div>
		<hr style='border-top:1px solid #808080;'>
		<div class='input'>
			<div>
				<span style='margin-right:3px'>验证码　</span> <input type="text" name="code" size="30" placeholder="请输入短信验证码"/><span class='shu'>|</span><input type="button" id="btn" onclick="time(this)" value="获取验证码" />
			</div>
		</div>
		<div>
			<p style="display:none" id='ts'></p>
		</div>
		<hr style='border-top:1px solid #808080;'>
		<div class='input'>
			<div>
				<span>新密码  </span> <input type="password" name="password" size="30" placeholder="请输入新密码"/>
			</div>
		</div>

		<div class='sub'>
			<button class="but"><h4>确认</h4></button>
		</div>
		<div class="tsy" style="display:none">
			<p class='tsp'></p>
		</div>
{{--遮罩层begin--}}
<div class="shade">
    <div class="shade-hei">
        <img src="images/8acbba7381623d7c2940758bc90613ee.gif" alt="">
    </div>
</div>
{{--遮罩层end--}}
	</div>
</body>
<script src="js/jquery.1.12.js"></script>
<script type="text/javascript"> 

	/* 返回上一页面 */
	function goBack(){
		window.history.go(-1); 
	}
	/* 清空手机号码值 */
	function del(obj){
		document.getElementsByName('tell')[0].value='';
	}

	function shadeShow(){  //显示遮罩层
    $('.shade').show();
	}

	function shadeHide(){  //隐藏遮罩层
	    $('.shade').hide();
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
		$('.tsp').html('密码为6-12位');
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
			$('.tsp').html('请输入短信验证码');
			/* 提示语隐藏 */
			$(".tsy").show(400).delay(2000).hide(300);
			return;
		}
		if(password=='')
		{
			$('.tsp').html('请填写新密码');
			/* 提示语隐藏 */
			$(".tsy").show(400).delay(2000).hide(300);
			return;
		}

		shadeShow();

		/* Ajax请求 */
		url='user_updatepwd';
		$.get(url,{tell:tell,password:password,code:code},function(msg){
			if(msg.errCode==1)
			{
				// $('.tsp').html(msg.msg);
				// /* 提示语隐藏 */
				// $(".tsy").show(400).delay(2000).hide(300);
				location.href='index';
			}
			else
			{
				$('.tsp').html(msg.msg);
				/* 提示语隐藏 */
				$(".tsy").show(400).delay(2000).hide(300);
				shadeHide();
			}
		},'json');
	}

})

</script> 
</html>