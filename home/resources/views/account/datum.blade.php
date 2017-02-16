<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="css/datum.css">
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link href="hui/iconfont.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery-1.7.2.min.js"></script>
    <title>我的账户</title>
</head>
<body>
<div class="datum-main">
    <div class="title">
        <span class="back"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>个人中心</span>
    </div>
    <div class="memu memu-datum">
        <ul>
            <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe627;</i></span>--}}
                    <span>头像</span>
                    <span class="jian">
                        <i class="Hui-iconfont" >&#xe705;</i>
                        <i class="Hui-iconfont" style="font-size: 12px;line-height: 30px;">&#xe6d7;</i>
                    </span>
                </div>
            </li>
            <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe627;</i></span>--}}
                    <span>姓名</span>
                    <span class="jian">王康宁</span>
                </div>
            </li>
            <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe6ca;</i></span>--}}
                    <span>身份证号</span>
                    <span class="jian">142625********1110</span>
                </div>
            </li>
            <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe6ca;</i></span>--}}
                    <span>银行卡</span>
                    <span class="jian">未绑定</span>
                </div>
            </li>
            <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe63a;</i></span>--}}
                    <span>手机号</span>
                    <span class="jian">15711061688</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="memu memu-two memu-fatum-two">
        <ul>
            <li style="border: none;">
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe627;</i></span>--}}
                    <span>密码</span>
                    <span class="jian change-password-button">修改 ></span>
                </div>
            </li>
            <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe6ca;</i></span>--}}
                    <span>支付密码</span>
                    <span class="jian">修改 ></span>
                </div>
            </li>
        </ul>
    </div>
    <div class="quit">
        <span>安全退出</span>
    </div>
</div>

{{--修改密码begin--}}
<div class="change-password">
    <div class="title">
        <span class="back back-password"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>修改登录密码</span>
    </div>
    <div class="xiugai">
        <form action="">
            <div class="primary">
                <lable>原登录密码</lable>
                <input type="password" name="name" placeholder="" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
            <div class="primary">
                <lable>新登录密码</lable>
                <input type="password" name="name" placeholder="6-20个字符，区分大小写" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
            <div class="primary">
                <lable>确认新密码</lable>
                <input type="password" name="name" placeholder="" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
        </form>
        <div class="quit">
            <span>确定修改</span>
        </div>
    </div>
</div>
{{--修改密码end--}}
</body>
<script>
    $('.change-password-button').click(function(){
        $('.datum-main').hide();
        $('.change-password').show();
    })
    $('.back-password').click(function(){
        $('.datum-main').show();
        $('.change-password').hide();
    })
</script>
</html>