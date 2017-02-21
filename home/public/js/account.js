
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




