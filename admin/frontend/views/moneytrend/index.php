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
              <a><cite>资金动向查看</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
        <form class="layui-form x-center" action="?r=moneytrend/index" style="width:800px" method="post">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <label class="layui-form-label">用户名称</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="输入用户名"  name="username" value="<?php echo $username ?>">
                    </div>
                    <label class="layui-form-label">资金动向</label>
                    <div class="layui-input-inline" style="width:120px;text-align: left">
                        <select name="type">
                            <option value="请选择">请选择</option>
                            <option value="0">充值</option>
                            <option value="1">提现</option>
                            <option value="2">返利</option>
                        </select>
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="2017-02-12" name="begin_time" >
                    </div>

                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="2017-02-13" name="over_time" >
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">金额范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="1000"  name="min_money" value="<?php echo $min_money ?>">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="2000"  name="max_money" value="<?php echo $min_money?>">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><span class="x-right" style="line-height:40px">共有数据：<?php echo $count ?> 条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="" value="">
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            用户名
                        </th>
                        <th>
                            资金
                        </th>
                        <th>
                            时间
                        </th>
                        <th>
                            状态
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $key => $value) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php echo $value['m_id'] ?>" name="checkbox">
                        </td>
                        <td>
                            <?php echo $value['m_id'] ?>
                        </td>
                        <td>
                            <u style="cursor:pointer" onclick="member_show('张三','member-show.html','10001','360','400')">
                                <?php echo $value['username'] ?>
                            </u>
                        </td>
                        <td >
                            <?php echo $value['money'] ?>
                        </td>
                        <td>
                           <?php echo date('Y-m-d',$value['time']) ?>
                        </td>
                        <td class="td-status">
                            <span class="layui-btn layui-btn-normal layui-btn-mini">
                                <?php if($value['status'] ==0){ ?>
                                     充值 
                                <?php }else if($value['status'] ==1){ ?>
                                     提现 
                                <?php }else{ ?>
                                     返利 
                                <?php } ?>
                            </span>
                        </td>
                        <td class="td-manage">
                            <a title="删除" href="javascript:;" onclick="member_del(this,<?php echo $value['m_id'] ?>)" 
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
        <script src="./lib/layui/layui.js" charset="utf-8"></script>
        <script src="./js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层
            });

            layui.use(['element','layer','form'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              layer = layui.layer;//弹出层
              form = layui.form();
            })

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                   checkbox = $("input[name='checkbox']");
                    ids = '';
                    for(var i=0;i<checkbox.length;i++){
                        if(checkbox[i].checked){
                            ids+=checkbox[i].value+',';
                        }
                    }
                    ids=ids.substring(ids.length-1,',');
                    url = '?r=moneytrend/delete';
                    $.get(url,{ids:ids},function(msg){
                        //捉到所有被选中的，发异步进行删除
                        if(msg==1)
                        {
                            for(var i=0;i<checkbox.length;i++){
                                if(checkbox[i].checked){
                                    checkbox[i].parentNode.parentNode.remove();
                                }
                            }                          
                            layer.msg('删除成功', {icon: 1,time:1000});
                        }
                        else
                        {
                            layer.msg('删除失败', {icon: 1,time:1000});
                        }
                    })
                });
             }

            /*用户-删除*/
            function member_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    url = '?r=moneytrend/del';
                    $.get(url,{id:id},function(msg){
                        if(msg==1)
                        {
                            //发异步删除数据
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:1,time:1000});
                        }
                        else
                        {
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