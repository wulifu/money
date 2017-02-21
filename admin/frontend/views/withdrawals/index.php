<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
 ?>
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
    </head>
    <style>
        .pagination li{
            float: left;
        }
    </style>
    <body>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>资金管理</cite></a>
              <a><cite>用户提现申请</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <form class="layui-form x-center" action="?r=withdrawals/index" style="width:800px" method="post">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="2017-02-13" id="LAY_demorange_s" name="begin_time" >
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="2017-02-13" id="LAY_demorange_e" name="over_time" >
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="member_add('添加用户','member-add.html','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：<?php echo $count ?>   条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            用户名
                        </th>
                        <th>
                            提现金额
                        </th>
                        <th>
                            账户
                        </th>
                        <th>
                            状态
                        </th>
                        <th>
                            操作时间
                        </th>
                        <th>
                            审核
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $key => $value) { ?>
                    <tr>
                        <td>
                            <?php echo $value['w_id'] ?>
                        </td>
                        <td>
                            <u style="cursor:pointer" onclick="member_show('张三','member-show.html','10001','360','400')">
                                <?php echo $value['username'] ?>
                            </u>
                        </td>
                        <td >
                            <?php echo $value['money'] ?>
                        </td>
                        <td >
                            <?php echo $value['card_num'] ?>
                        </td>
                        <td>
                            <span class="layui-btn layui-btn-normal layui-btn-mini">
                            待审核 
                            </span>
                        </td>
                        <td >
                            <?php echo date('Y-m-d',$value['time']) ?>
                        </td>
                        <td class="td-manage">
                            <a title="审核失败" href="javascript:;" onclick="member_edit('编辑','?r=withdrawals/template&id=<?php echo $value['w_id'] ?>',<?php echo $value['w_id'] ?>)"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="审核通过" href="javascript:;" onclick="ajaxUpdata(this,<?php echo $value['w_id'] ?>)" 
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
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
        </div>
        <script src="./lib/layui/layui.js" charset="utf-8"></script>
        <script src="./js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              layer = layui.layer;//弹出层
              //以上模块根据需要引入
              document.getElementById('LAY_demorange_s').onclick = function(){
                start.elem = this;
                laydate(start);
              }
              document.getElementById('LAY_demorange_e').onclick = function(){
                end.elem = this
                laydate(end);
              }
              
            });

            //  审核失败
            function member_edit (title,url,id) {
                x_admin_show(title,url); 
            }


            /* 即点即改修改状态 (审核成功) */
             function ajaxUpdata (obj,id) {
                url = '?r=withdrawals/updata';
                $.get(url,{id:id},function(msg){
                    if(msg)
                    {
                        $(obj).parents("tr").remove();
                        layer.msg('审核通过!',{icon:1,time:1000});
                    }
                    else
                    {
                        layer.msg('审核失败!',{icon:1,time:1000});
                    }
                })
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