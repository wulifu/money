
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



$('.back-account-main-fund').click(function(){
    back('fund')   //关闭总资产页面
})

$('.back-account-main-recharge').click(function(){
    back('recharge')   //关闭总资产页面
})


