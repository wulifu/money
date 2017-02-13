<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        X-admin v1.0
    </title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="./css/x-admin.css" media="all">
    <style>
        .pagination li{
            float: left;
        }
    </style>
</head>
<?PHP
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<body>
<div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>投资项目管理</cite></a>
              <a><cite>项目列表</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
        <a href="<?php echo  Url::toRoute(['project/add']);?>"><button class="layui-btn" ><i class="layui-icon">&#xe608;</i>添加</button></a>
        <span class="x-right" style="line-height:40px"></span></xblock>
    <form class="layui-form x-center" action="" style="width:100%">
        <?php
        $form=ActiveForm::begin([
            'action'=>Url::toRoute(['index']),
            'method'=>'get',
        ]);
        ?>
        <div class="layui-form-pane" style="margin-top: 15px; float: left">
            <div class="layui-form-item">
                <label class="layui-form-label"><?php echo '项目名称:'?></label>
                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="项目名称" name="name" value="<?php echo $name?>">
                </div>
                <label class="layui-form-label"><?php echo '投资总金额:'?></label>
                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="最小" name="money_min" value="<?php echo $money_min?>">
                </div>
                <div class="layui-input-inline">
                    <input class="layui-input" placeholder="最大" name="money_max" value="<?php echo $money_max?>">
                </div>
                <div class="layui-input-inline" style="width:80px">
                    <i  class="layui-btn" ;lay-filter="sreach"><?PHP  echo Html::submitButton('搜索');?></i>
                </div>
            </div>
        </div>
        <?php ActiveForm::end();
        ?>
    </form>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <input type="checkbox"  class="all">
            </th>
            <th>
                ID
            </th>
            <th>
                项目名称
            </th>
            <th>
                期限
            </th>
            <th>
                预期收益率
            </th>
            <th>
                发布时间
            </th>
            <th>
                剩余时间
            </th>
            <th>
                投资状态
            </th>
            <th>
                投资总金额
            </th>
            <th>
                集资总金额
            </th>
            <th>
                操作
            </th>
        </tr>
        </thead>
        <tbody id="x-img">
        <?php foreach ($arr as $key=>$val) {?>
        <tr>
            <td>
                <input type="checkbox" value="<?php echo $val['fin_id']?>" class="check">
            </td>
            <td>
                <?php echo $val['fin_id']?>
            </td>
            <td>
                <?php echo $val['pro_name']?>
            </td>
            <td >
                <span class="term"><?php echo $val['term']?></span>天
            </td>
            <td >
                <?php echo $val['yield']?>%
            </td>
            <td>
                <span class="unix" style="display: none"><?php echo $val['release_time']?></span>
                <span class="time"><?php echo date("Y-m-d H:i:s",$val['release_time']);?></span>
            </td>
            <td>
                <span class="showTime"></span>
            </td>
            <td ><span class="status" style="display: none"><?php echo $val['status']?></span>
                <?PhP  if( $val['status']==1) {
                   echo '  <span class="img">进行中</span>';
               } else {
                    echo ' <span class="img">已完成</span>';
               } ?>
            </td>
            <td>
                <?PhP echo $val['money_sum']?>
            </td>
            <td class="td-status">
                <?php echo $val['money']?>
            </td>
            <td class="td-manage">
                <a style="text-decoration:none"  href="<?php echo  Url::toRoute(['project/list', 'fin_id' =>$val['fin_id']]);?>" title="投资清单">
                    <i class="layui-icon">&#xe601;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="banner_del(this,<?php echo $val['fin_id']?>)"
                   style="text-decoration:none" >
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div id="page">
        <div id="layui-laypage-0" class="layui-box layui-laypage layui-laypage-default" >
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',
                'maxButtonCount'=>3,
            ]);?>
        </div>
    </div>
<script src="./lib/layui/layui.js" charset="utf-8"></script>
<script src="./js/x-layui.js" charset="utf-8"></script>
<script src="./js/jquery.min.js" charset="utf-8"></script>
<script>
    //计时器
     // 获取发布时候//获取期限
    $(function(){
       times = setInterval(setTime, 1000);//每隔1秒执行函数
    })
    function setTime(){
        var status=$(".status");
        var  term=$(".term")
        var  unix =$(".unix");
        var id=$(".check");
        for(var i=0; i<unix.length; i++ ){
            var unixs=unix.eq(i).html();
            var terms=term.eq(i).html()*3600*24;
            var datetime = Date.parse(new Date())/1000;
            var timeIndex=unixs*1+terms*1-datetime*1;
            if(status.eq(i).html()==1) {
                if (timeIndex > 0) {
                    var day = parseInt(timeIndex / 3600 / 24);    // 计算天
                    var hour = parseInt(timeIndex % (3600 * 24) / 3600);    // 计算时
                    var minutes = parseInt((timeIndex % 3600) / 60);    // 计算分
                    var seconds = parseInt(timeIndex % 60);    // 计算秒
                    hour = hour < 10 ? "0" + hour : hour;
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
                    $(".showTime").eq(i).html(day + "天" + hour + ":" + minutes + ":" + seconds);
                    timeIndex++;
                } else {
                    $(".showTime").eq(i).html(0 + "天" + 00 + ":" + 00 + ":" + 00);
                    $.get("?r=project/update",{fin_id:id.eq(i).val()},function(msg){
                        if(msg==1){
                            location.replace(location.href);
                        }
                    })
                }
            }else {
                $(".showTime").eq(i).html(0 + "天" + 00 + ":" + 00 + ":" + 00);
            }

        }
    }

    //全选
    $(".all").click(function(){
        var check=$(".check");
        for(var i=0; i<check.length; i++ ){
            check[i].checked=!check[i].checked;
        }
    })
    layui.use(['laydate','element','laypage','layer'], function(){
        $ = layui.jquery;//jquery
        laydate = layui.laydate;//日期插件
        lement = layui.element();//面包导航
        laypage = layui.laypage;//分页
        layer = layui.layer;//弹出层


        //以上模块根据需要引入

        layer.ready(function(){ //为了layer.ext.js加载完毕再执行
            layer.photos({
                photos: '#x-img'
                //,shift: 5 //0-6的选择，指定弹出图片动画类型，默认随机
            });
        });
    });

    //批量删除提交
    function delAll (obj) {
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            var check=$(".check");
            var ids= "";
            for(var i=0; i<check.length; i++ ){
                if(check[i].checked==true){
                    ids+= ","+check[i].value;
                }
            }
            ids=ids.substr(1);
            $.get("?r=project/delete",{fin_id:ids},function(msg){
                if(msg==1){
                    //发异步删除数据
                    for(var j=check.length-1;j>=0;j--){
                        if(check[j].checked){
                            check[j].parentNode.parentNode.parentNode.removeChild(check[j].parentNode.parentNode);
                        }
                    }
                    layer.msg('已删除!',{icon:1,time:1000});
                }else{
                    layer.msg('删除失败!',{icon:1,time:1000});
                }
            })


        });
    }
    /*添加*/
    function banner_add(title,url,w,h){
        x_admin_show(title,url,w,h);
    }
    /*停用*/
    function banner_stop(obj,id){
        layer.confirm('确认不显示吗？',function(index){
            //发异步把用户状态进行更改
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_start(this,id)" href="javascript:;" title="显示"><i class="layui-icon">&#xe62f;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">不显示</span>');
            $(obj).remove();
            layer.msg('不显示!',{icon: 5,time:1000});
        });
    }

    /*启用*/
    function banner_start(obj,id){
        layer.confirm('确认要显示吗？',function(index){
            //发异步把用户状态进行更改
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_stop(this,id)" href="javascript:;" title="不显示"><i class="layui-icon">&#xe601;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已显示</span>');
            $(obj).remove();
            layer.msg('已显示!',{icon: 6,time:1000});
        });
    }
    // 编辑
    function banner_edit (title,url,id,w,h) {
        x_admin_show(title,url,w,h);
    }
    /*删除*/
    function banner_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.get("?r=project/delete",{fin_id:id},function(msg){
                if(msg==1){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }else{
                    layer.msg('删除失败!',{icon:1,time:1000});
                }
            })

        });
    }
</script>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>
</html>