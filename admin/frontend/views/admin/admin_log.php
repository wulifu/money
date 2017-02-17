<?php    
    use yii\helpers\Html;    
    use yii\widgets\LinkPager;    
?>    
<style> 
.divcss5-a,.divcss5-b{ width:98%; height:550px;  border:0px solid #F00} 
.divcss5-b{ margin-left:10px;overflow-y:scroll; overflow-x:scroll;} 

</style> 
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
     
            <form class="layui-form x-center" action="?r=admin/logsou" method="post" style="width:800px">
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
            
            <div class="divcss5-b">
             
              <table class="layui-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="kkk" id="k" onclick="aa()">
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            日期
                        </th>   
                        <th>
                            操作者
                        </th>
                        <th>
                            对象类型
                        </th>  
                        <th>
                            动作
                        </th>
                         <th>
                           操作内容 
                        </th>
                        <th>
                           对象名称
                        </th>
                    </tr>
                </thead>
                
             <?php foreach ($data as $datas): ?>      
      
                <tbody>
                    <tr>
                        <td>
                            <input title=""  name="chk" id="con" class="checkbox" type="checkbox" value="">
                        </td>
                        <td>
                            <?php echo $datas['log_id'];?>
                        </td>
                        <td>
                             <?php
                           echo date('Y-m-d H:i:s', $datas['time']); 
                             ?>
                        </td>
                        <td >
                        <?php echo $datas['admin'];?>
                        </td>
                        <td>
                        <?php
                        if ($datas['type'] == 0) {
                            echo "用户";
                        }elseif ($datas['type'] == 1) {
                           echo "操作";
                        }
                        ?>
                        </td>
                        <td>
     <!--                <?php echo $datas['action'];?> -->
                    <?php
                        if ($datas['action'] == 0) {
                            echo "登录系统";
                        }elseif ($datas['action'] == 1) {
                           echo "新建";
                        }elseif ($datas['action'] == 2) {
                           echo "修改";
                        }elseif ($datas['action'] == 3) {
                           echo "删除";
                        }


                    ?>

                        </td>
                        <td>
                       
                    <?php echo $datas['content'];?>
                        
                        </td>
                        
                         <td>
                         <abbr style="color: blue">
                    <?php echo $datas['object'];?>
                          </abbr>
                        </td>
         
                    </tr>
                </tbody>
                     <?php endforeach; ?>   
                     
            </table>
       </div>
        <div id="page">
  
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

