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
    <script src="js/jquery-1.7.2.min.js"></script>
    <title>我的账户</title>
</head>
<body>
<div class="datum-main">
    <div class="title">
        <span class="back backda"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
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
                    <?php if($info->username == ''){ ?>
                    <span class='jian weishim'>未实名</span>
                    <?php }else{ ?>
                    <span class='jian'>{{$info->username}}</span>
                    <?php } ?>
                </div>
            </li>
<!--        <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe6ca;</i></span>--}}
                    <span>身份证号</span>
                    <span class="jian">142625********1110</span>
                </div>
            </li> -->
            <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe6ca;</i></span>--}}
                    <span>银行卡</span>
                    <?php if($show == ''){ ?>
                    <span class='jian bangka'>未绑定</span>
                    <?php }else{ ?>
                    <span class='jian'>已绑定</span>
                    <?php } ?>
                </div>
            </li>
            <li>
                <div>
                    {{--<span><i class="Hui-iconfont">&#xe63a;</i></span>--}}
                    <span>手机号</span>
                    <span class="jian">{{$info->phone}}</span>
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
                    <span class="jian change-pay-button">修改 ></span>
                    <!-- <span class="jian ">设置 ></span> -->
                </div>
            </li>
        </ul>
    </div>
    <div class="quit">
        <span class='sign_out'>安全退出</span>
    </div>
</div>
<p class='tsy'>提示层</p>
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
                <input type="password" name="pri_password" placeholder="" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
            <div class="primary">
                <lable>新登录密码</lable>
                <input type="password" name="password" placeholder="6-20个字符，区分大小写" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
            <div class="primary">
                <lable>确认新密码</lable>
                <input type="password" name="con_password" placeholder="" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
        </form>
        <div class="quit">
            <span class='con_update'>确定修改</span>
        </div>
    </div>
</div>
{{--修改密码end--}}

{{--设置支付密码begin--}}
<div class="change-pay" >
    <div class="title">
        <span class="back back-pay"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>修改交易密码</span>
    </div>
    <div class="xiugai">
        <form action="">
            <div class="primary">
                <lable>原交易密码</lable>
                <input type="password" name="pri_paypwd" placeholder="默认123456" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
            <div class="primary">
                <lable>新交易密码</lable>
                <input type="password" name="paypwd" placeholder="6-20个字符，区分大小写" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
            <div class="primary">
                <lable>确认新密码</lable>
                <input type="password" name="con_paypwd" placeholder="" pattern="[0-9A-Za-z]{6,16}" required/>
            </div>
        </form>
        <div class="quit">
            <span class='pay_button'>确定修改</span>
        </div>
    </div>
</div>
{{--设置支付密码end--}}

{{--实名认证begin--}}
<div class="change-name">
    <div class="title">
        <span class="back back-name"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>实名认证</span>
    </div>
    <div class="shiming">
        <form action="">
            <div class="primary">
                <lable>姓　名</lable>
                <input type="text" name="username" placeholder="请输入您的真实姓名" pattern="[\u4e00-\u9fa5]{2,4}" required/>
            </div>
            <div class="primary">
                <lable>身份证</lable>
                <input type="text" name="idcard" placeholder="请输入您的身份证号码" pattern="^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$" required/>
            </div>
        </form>
        <div class="quit">
            <span class='shiming-ajax'>实名认证</span>
            <p>完成实名认证可保障投资权益及账户安全，一经审核不可修改</p>
        </div>
    </div>
</div>
{{--实名认证end--}}

{{--银行卡认证begin--}}
<div class="bang-card">
    <div class="title">
        <span class="back back-card"><i class="Hui-iconfont">&#xe6d4;</i>&nbsp;返回</span>
        <span>银行卡认证</span>
    </div>
   <div class="shiming">
        <form action="">
<!--             <div class="primary">
                <lable>姓　名</lable>
                <input type="text" name="username" placeholder="请输入您的真实姓名" pattern="[\u4e00-\u9fa5]{2,4}" required/>
            </div> -->
<!--             <div class="primary">
                <lable>身份证</lable>
                <input type="text" name="cardid" placeholder="请输入您的身份证号码" pattern="([0-9]){7,18}(x|X)" required/>
            </div> -->
            <!-- <p>请填写本人真实信息，核实后不可更改</p> -->
            <div class='primary'></div>
            <div class="primary1">
                <lable>银　行</lable>
                <select name="bank" id="bank">
                    <option value="0">请选择银行类型</option>
                    <option value="1">工商银行</option>
                    <option value="2">中国银行</option>
                    <option value="3">农业银行</option>
                </select>
            </div>
            <div class="primary1">
                <lable>卡　号</lable>
                <input type="text" name="card_num" placeholder="请输入您的银行卡号" pattern="([0-9]){18,19}" required/>
            </div>
<!--             <div class="primary1">
                <lable>银行预留手机</lable>
                <input type="text" name="cardid" value="17600016585" placeholder="请输入您的手机号码" pattern="[0-9]{11}" required/>
            </div> -->
        </form>
        <div class="quit">
            <span class="bank_click">绑定</span>
        </div>
    </div>
</div>
{{--银行卡认证end--}}

{{--遮罩层begin--}}
<div class="shade">
    <div class="shade-hei">
        <img src="images/8acbba7381623d7c2940758bc90613ee.gif" alt="">
    </div>
</div>
{{--遮罩层end--}}
</body>
<script>

function shadeShow(){  //显示遮罩层
    $('.shade').show();
}

function shadeHide(){  //隐藏遮罩层
    $('.shade').hide();
}

/* 安全退出 */
$('.sign_out').click(function(){
    url = 'sign_out';
    $.get(url,function(msg){
        if(msg=='')
        {
            location.href='register';
        }
    });
})

/* 绑卡操作 */
$('.bank_click').click(function(){
    bank = $('#bank').val();
    card_num = $("input[name='card_num']").val();
    /* 验证数据 */
    if(bank==0 || bank =='')
    {
        $('.tsy').html('请选择银行');
        $(".tsy").show(400).delay(2000).hide(300);
        return; 
    }
    reg = /([0-9]){18,19}/;
    if(!reg.test(card_num))
    {
        $('.tsy').html('请输入正确银行卡号');
        $(".tsy").show(400).delay(2000).hide(300);
        return;
    }

    shadeShow();
    /* 发送Ajax请求 */
    url = 'user_bankcard';
    a = $('.bang-card');
    main = $('.datum-main');
    $.get(url,{bank:bank,card_num:card_num},function(msg){
        if(msg.errCode == 1)
        {
            // $('.tsy').html(msg.msg);
            // $(".tsy").show(400).delay(2000).hide(300);
            a.hide();
            main.show();
            location.replace(document.referrer);
        }
        else
        {
            $('.tsy').html(msg.msg);
            $(".tsy").show(400).delay(2000).hide(300);
        }
    },'json')
})


/* 完善姓名身份证 */
$('.shiming-ajax').click(function(){
    username = $("input[name='username']").val();
    idcard = $("input[name='idcard']").val();
    /* 验证数据 */
    reg=/[\u4E00-\u9FA5]{2,7}/g;
    if(username =='' || !reg.test(username))
    {
        $('.tsy').html('汉字2-3字');
        $(".tsy").show(400).delay(2000).hide(300);
        return;   
    }
    reg1 = /^\d{15}(\d{2}[A-Za-z0-9])?$/;
    if(idcard=='' || !reg1.test(idcard))
    {
        $('.tsy').html('请输入正确的身份证号码');
        $(".tsy").show(400).delay(2000).hide(300);
        return; 
    }
    shadeShow();

    /* 发送请求 */
    url = 'user_shiming';
    main = $('.datum-main');
    a = $('.change-name');
    $.get(url,{username:username,idcard:idcard},function(msg){
        // $('.tsy').html(msg.msg);
        // $(".tsy").show(400).delay(2000).hide(300);
        a.hide();
        main.show();
        location.replace(document.referrer);
    },'json')
})


/* 修改登录密码 */
$('.con_update').click(function(){
    pri_password = $("input[name='pri_password']").val();
    password = $("input[name='password']").val();
    con_password = $("input[name='con_password']").val();

    /* 验证数据 */
    reg = /[0-9A-Za-z]{6,16}/;
    if(!reg.test(pri_password))
    {
        $('.tsy').html('6-20个字符');
        $(".tsy").show(400).delay(2000).hide(300);
        return;
    }
    if(!reg.test(password))
    {
        $('.tsy').html('6-20个字符');
        $(".tsy").show(400).delay(2000).hide(300);
        return;
    }
    if(!reg.test(con_password))
    {
        $('.tsy').html('6-20个字符');
        $(".tsy").show(400).delay(2000).hide(300);
        return;
    }

    shadeShow();

    /* 发送请求 */
    url='user_editpwd';
    a = $('.change-password');
    main = $('.datum-main');
    $.get(url,{pri_password:pri_password,password:password,con_password:con_password},function(msg){
        if(msg.errCode==1)
        {
            // $('.tsy').html(msg.msg);
            // $(".tsy").show(400).delay(2000).hide(300);
            a.hide();
            main.show();
            location.replace(document.referrer);
        }
        else
        {
            $('.tsy').html(msg.msg);
            $(".tsy").show(400).delay(2000).hide(300);
        }
    },'json')
})

    /* 修改支付密码 */
    $('.pay_button').click(function(){
        pri_paypwd = $("input[name='pri_paypwd']").val();
        paypwd = $("input[name='paypwd']").val();
        con_paypwd = $("input[name='con_paypwd']").val();
        /* 验证数据 */
        reg = /[0-9A-Za-z]{6,16}/;
        if(!reg.test(pri_paypwd))
        {
            $('.tsy').html('6-20个字符');
            $(".tsy").show(400).delay(2000).hide(300);
            return;
        }
        if(!reg.test(paypwd))
        {
            $('.tsy').html('6-20个字符');
            $(".tsy").show(400).delay(2000).hide(300);
            return;
        }
        if(!reg.test(con_paypwd))
        {
            $('.tsy').html('6-20个字符');
            $(".tsy").show(400).delay(2000).hide(300);
            return;
        }

        shadeShow();

        /* 发送请求 */
        url = 'user_editpay';
        main = $('.datum-main');
        a = $('.change-pay');
        $.get(url,{pri_paypwd:pri_paypwd,paypwd:paypwd,con_paypwd:con_paypwd},function(msg){
            if(msg.errCode==1)
            {
                // $('.tsy').html(msg.msg);
                // $(".tsy").show(400).delay(2000).hide(300);
                a.hide();
                main.show();
                location.replace(document.referrer);
            }
            else
            {
                $('.tsy').html(msg.msg);
                $(".tsy").show(400).delay(2000).hide(300);
            }
        },'json')
    })



    /* 返回 */
    $('.backda').click(function(){
        location.href='account';
    })

    /* 修改支付密码 */
    $('.change-pay-button').click(function(){
        $('.datum-main').hide();
        $('.change-pay').show();
    })
    $('.back-pay').click(function(){
        $('.datum-main').show();
        $('.change-pay').hide();
    })
    /* 绑卡操作 */
    $('.bangka').click(function(){
        $('.datum-main').hide();
        $('.bang-card').show();
    })
    $('.back-card').click(function(){
        $('.datum-main').show();
        $('.bang-card').hide();
    })
    /* 实名认证 */
    $('.weishim').click(function(){
        $('.datum-main').hide();
        $('.change-name').show();
    })
    $('.back-name').click(function(){
        $('.datum-main').show();
        $('.change-name').hide();
    })
    /* 修改密码 */
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