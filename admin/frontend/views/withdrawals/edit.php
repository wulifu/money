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
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label for="level-id" class="layui-form-label">
                        id
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="level-id" name="level-id" disabled="" value="<?php echo $id ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="level-name" class="layui-form-label">
                        <span class="x-red">*</span>消息
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="level-name" name="level-name" required="" lay-verify="required"
                        autocomplete="off" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                        保存
                    </button>
                </div>
            </form>
        </div>
        <script src="./lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="./js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            
              //监听提交
              form.on('submit(save)', function(data){
                content = $("input[name='level-name']").val();
                id = $("input[name='level-id']").val();
                url = '?r=withdrawals/updatemsg';
                $.get(url,{content:content,id:id});
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
                return false;
              });
              
                
                // location.href='?r=withdrawals/index';
              
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