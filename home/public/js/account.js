
/**
 * 隐藏主页面，显示模块
 * @param cla  要显示的子模块class
 */
function getinto(cla){
    $('.account-main').hide();
    $('.nav').hide()
    $('.'+cla).show()
}

/**
 * 隐藏子模块，显示主页面
 * @param cla  要隐藏的子模块class
 */
function back(cla){
    $('.account-main').show();
    $('.nav').show()
    $('.'+cla).hide();
}

function shadeShow(){  //显示遮罩层
    $('.shade').show();
}

function shadeHide(){  //隐藏遮罩层
    $('.shade').hide();
}

/**
 * 显示提示框
 * @param msg  提示信息
 */
function showHint(msg){
    $('.hint').html(msg).fadeIn('slow');
    var t = setTimeout("$('.hint').fadeOut(1000)",3000);
}

/**
 * 时间戳转日期格式
 * @param nS
 * @returns {string}
 */
function getLocalTime(nS) {
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
}

$('.back-account-main-fund').click(function(){
    back('fund')   //关闭总资产页面
})

$('.back-account-main-recharge').click(function(){
    back('recharge')   //关闭总资产页面
})

$('.open-fetch').click(function(){
    open_recharge('fetch');
    //getinto('fetch');
})

$('.fetch-affirm').click(function(){
    var fetch_val = $('.fetch_val').val();
    var bind_id = $('bank_name').attr('bind_id');
    if(fetch_val == '' || isNaN(fetch_val) || fetch_val < 1){
        showHint('请输入合法的提现金额')
        return false;
    }
    if(fetch_val > 10000){
        showHint('单笔金额不得超过10000元')
        return false;
    }
    shadeShow();
    $.ajax({
        type: 'get',
        url: "/fetch",
        data: 'fetch_val=' + fetch_val + '&bind_id=' + bind_id,
        dataType: 'json',
        async: 'false',
        success:function(msg){
            if(msg.code == 1){
                showHint('提现金额将在2小时内到账')
                $('.property-val').html(Number($('.property-val').html())-Number(fetch_val))
                back('fetch')
                shadeHide();
            }else{
                showHint(msg.error);
                shadeHide();
            }
        },
        error:function(msg){
            showHint('操作失败，请稍后再试')
            shadeHide();
        }
    })

})


