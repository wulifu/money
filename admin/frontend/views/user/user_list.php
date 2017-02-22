<?php    
    use yii\helpers\Html;    
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
    <body>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>会员列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
     
            <form class="layui-form x-center" action="?r=user/sou" method="post" style="width:800px">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="开始日" id="LAY_demorange_s" type="text" name="b_time">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="截止日" id="LAY_demorange_e" type="text" name="e_time">
                    </div>
                    <div class="layui-input-inline">
                      <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
              
            <xblock><a href="javascript:location.replace(location.href);"><button  class="layui-btn layui-btn-danger" onclick="dels()"><i class="layui-icon">&#xe640;</i>批量删除</button></a></xblock>
            
             
              <table class="layui-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="kkk" id="k" onclick="aa()">
                        </th>
                        <th>
                            ID
                        </th>
                        
                        <th>
                            姓名
                        </th>
                        <th>
                            手机号
                        </th>
                        <th>
                            可用资金(单位：元)
                        </th>
                       
                        <th>
                            加入时间
                        </th>
                      
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
             <?php foreach ($data as $datas): ?>      
      
                <tbody>
                    <tr>
                        <td>
                            <input title="<?= $datas['user_id']; ?>"  name="chk" id="con" class="checkbox" type="checkbox" value="<?= $datas['user_id']; ?>">
                        </td>
                        <td>
                        <?= $datas['user_id']; ?>
                        </td>
                        <td>
                          <?= $datas['username']; ?>
                        </td>
                        <td >
                        <?php
                        echo substr($datas['phone'], 0, 3); 
                           ?>
                           ****
                           <?php
                        echo substr($datas['phone'], -4, 4); 
                           ?>
                        </td>
                        <td>
                        <?php
                        echo number_format($datas['money'], 2); 
                        ?>
                          
                        </td>
                        <td>
                         <span class="layui-btn layui-btn-normal layui-btn-mini">
                             <?php
                           echo date('Y-m-d H:i:s', $datas['time']); 
                             ?>
                          
                             </span>
                        </td>   
                        
                        <td class="td-manage">
                            <a style="text-decoration:none" onclick="member_stop(this,'10001')" href="javascript:;" title="停用">
                                <i class="layui-icon">&#xe601;</i>
                            </a>
                            <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member-edit.html','4','','510')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a style="text-decoration:none"  onclick="member_password('修改密码','member-password.html','10001','600','400')"
                            href="javascript:;" title="修改密码">
                                <i class="layui-icon">&#xe631;</i>
                            </a>
                            <a title="删除" href="?r=user/del&user_id=<?php echo $datas['user_id'];?>" 
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                </tbody>
                     <?php endforeach; ?>   
            </table>
       
        <div id="page">
        <div style="margin-left: 450px;" id="layui-laypage-0" class="layui-box layui-laypage layui-laypage-default" >
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
         <style>

        .pagination li{
            float: left;

        }
    </style>

           
        </div>
        <script src="./lib/layui/layui.js" charset="utf-8"></script>
        <script src="./js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              lement = layui.element();//面包导航
                         //slaypage = layui.laypage;//分页
              layer = layui.layer;//弹出层

              //以上模块根据需要引入

              // laypage({
              //   cont: 'page'
              //   ,pages: 100
              //   ,first: 1
              //   ,last: 100
              //   ,prev: '<em><</em>'
              //   ,next: '<em>></em>'
              // }); 
              
              var start = {
                min: '1099-06-16 23:59:59'
                ,max: '2099-06-16 23:59:59'
                ,istoday: false
                ,choose: function(datas){
                  end.min = datas; //开始日选好后，重置结束日的最小日期
                  end.start = datas //将结束日的初始值设定为开始日
                }
              };
              
              var end = {
                min: laydate.now()
                ,max: '2099-06-16 23:59:59'
                ,istoday: false
                ,choose: function(datas){
                  start.max = datas; //结束日选好后，重置开始日的最大日期
                }
              };
              
              document.getElementById('LAY_demorange_s').onclick = function(){
                start.elem = this;
                laydate(start);
              }
              document.getElementById('LAY_demorange_e').onclick = function(){
                end.elem = this
                laydate(end);
              }
              
            });

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
             /*用户-添加*/
            function member_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }
            /*用户-查看*/
            function member_show(title,url,id,w,h){
                x_admin_show(title,url,w,h);
            }

             /*用户-停用*/
            function member_stop(obj,id){
                layer.confirm('确认要停用吗？',function(index){
                    //发异步把用户状态进行更改
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!',{icon: 5,time:1000});
                });
            }

            /*用户-启用*/
            function member_start(obj,id){
                layer.confirm('确认要启用吗？',function(index){
                    //发异步把用户状态进行更改
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!',{icon: 6,time:1000});
                });
            }
            // 用户-编辑
            function member_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            /*密码-修改*/
            function member_password(title,url,id,w,h){
                x_admin_show(title,url,w,h);  
            }
            /*用户-删除*/
            function member_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
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

<script>
var chk = document.getElementsByName('chk');
function aa(){
    for(var i=0; i<chk.length; i++){
        chk[i].checked=true;
    }
}
function aa(){
    for(var i=0; i<chk.length; i++){
        if(chk[i].checked){
            chk[i].checked=false;
        }else{
            chk[i].checked=true;
        }
    }
}

function dels(){
    var str='';
    var box=document.getElementsByName('chk');
    var aa=document.getElementById('aa');
    for(var i=0;i<chk.length;i++){
        if(chk[i].checked){
            str=str+chk[i].title+',';
        }
    }
    str=str.substring(str.length-1,',');
    //alert(str);die;
    var ajax=new XMLHttpRequest();
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4){
            document.getElementById('rep').innerHTML=ajax.responseText;
        }
    }
    ajax.open('get','?r=user/delall&user_id='+str);
 
    ajax.send(null);  
}
</script>