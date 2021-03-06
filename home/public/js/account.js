
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

$(function(){
    if(window.screen.width > document.body.scrollWidth){
        $('.hint').css('left',(window.screen.width-384)/2)
    }

})

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
    var bind_id = $('fetch_band_id').attr('bind_id');
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
                showHint('提现已提交至审核')
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

$('.back-account-main-fetch').click(function(){
    back('fetch');   //关闭提现页面
})
$('.back-account-main-invite').click(function(){
    back('invite');   //关闭邀请页面
})

$('.not').click(function(){
    showHint('此功能还未开放 敬请期待')
})

/*打开我的投资项目页面*/
$('.open-project').click(function(){
    shadeShow();
    $.ajax({
        type:'get',
        url:'myProject',
        dataType:'json',
        success:function(msg){
            if(msg.code == 1){
                var _html = '';
                for( var i in msg.data){
                    _html += '<li class="li"><div class="project_"><div class="project-title"><a href="details?fin_id='+msg.data[i].fin_id+'">'+msg.data[i].pro_name+'</a><span>我的投资金额：'+msg.data[i].money_sum+' 元</span></div><div class="cent"><div class="data"><span class="trem">'+msg.data[i].yield+'%</span><span class="font">'+msg.data[i].term+'天</span><span  class="font">'+msg.data[i].money+'</span></div><div class="name"><span class="lv" >预期年化收益率</span><span class="nv" >期限</span  ><span class="nv" >预计金额</span></div></div></div></li>';
                }
                $('.project-achieve ul').html(_html);
                getinto('project');
                shadeHide();
            }else{
                shadeHide();
                showHint(msg.error);
            }
        },
        error:function(){
            showHint('查询失败');
            shadeHide();
        }
    })

})

$('.back-account-main-project').click(function(){
    back('project');   //关闭我的投资项目列表

    $('.achieve').addClass('project-nav-check').siblings().removeClass('project-nav-check');
    $('.over').attr('isclick',0);
    $('.project-over').hide();
    $('.project-achieve').show();
})
//我的投资项目tab切换
$('.over').click(function(){
    $(this).addClass('project-nav-check').siblings().removeClass('project-nav-check');
    $('.project-achieve').hide();
    if($(this).attr('isclick') == 0){
        shadeShow();
        $.ajax({
            type:'get',
            url:'myProject?type=1',
            dataType:'json',
            success:function(msg){
                if(msg.code == 1){
                    if(msg.data == ''){
                        showHint('暂无数据');
                        shadeHide();
                    }else{
                        var _html = '';
                        for( var i in msg.data){
                            _html += '<li class="li"><div class="project_"><div class="project-title"><a href="details?fin_id='+msg.data[i].fin_id+'">'+msg.data[i].pro_name+'</a><span投资金额：'+msg.data[i].money_sum.toFixed(2)+'  &nbsp; 收益：'+msg.data[i].profit_sum.toFixed(2)+'</span></div><div class="cent"><div class="data"><span class="trem">'+msg.data[i].yield+'%</span><span class="font">'+msg.data[i].term+'天</span><span  class="font">'+msg.data[i].money+'</span></div><div class="name"><span class="lv" >预期年化收益率</span><span class="nv" >期限</span  ><span class="nv" >预计金额</span></div></div></div></li>';
                        }
                        $('.project-over ul').html(_html);
                        //getinto('project');
                        shadeHide();
                    }
                }else{
                    shadeHide();
                    showHint(msg.error);
                }
            },
            error:function(){
                showHint('查询失败');
                shadeHide();
            }
        })
        $(this).attr('isclick',1)
    }else{
        $('.project-over').show();
        $('.project-achieve').hide();
    }

})
//我的投资项目tab切换
$('.achieve').click(function(){
    $(this).addClass('project-nav-check').siblings().removeClass('project-nav-check');
    $('.project-over').hide();
    $('.project-achieve').show();
})

function smallLoadingIcon(ele) { //小的loading图标
    var spinner = new Spinner({
        lines: 12,
        length: 5,
        width: 2,
        radius: 4,
        color: '#333',
        speed: 1,
        trail: 50,
        shadow: false,
        hwaccel: false,
        className: 'spinner',
        top: 0,
        left: 0
    });
    var target = $(ele+' .spin')[0];
    spinner.spin(target);
    return spinner;
}
smallLoadingIcon('.w-load');


