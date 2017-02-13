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
    <form class="layui-form" action="?r=project/add_list" method="post" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red">*</span>项目名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="link" name="pro_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red">*</span>预期收益率
            </label>
            <div class="layui-input-inline">
                <input type="text" id="link" name="yield" required=""  placeholder="填写数字即可" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red">*</span>期限
            </label>
            <div class="layui-input-inline">
                <input type="text" id="link" name="term" required=""  placeholder="单位以天计算" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red">*</span>总金额
            </label>
            <div class="layui-input-inline">
                <input type="text" id="link" name="money" required=""  lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="link" class="layui-form-label">
                <span class="x-red">*</span>起息时间
            </label>
            <div class="layui-input-inline">
                <input type="text" id="link" name="rebate_time" placeholder="单位以天计算" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="L_content" class="layui-form-label" style="top: -2px;">
                产品介绍
            </label>
            <div class="layui-input-block">
                        <textarea id="L_content" name="product_brief"
                                  placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>计息规则
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="interest_rule" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>投资说明
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="investment_dsc" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="L_content" class="layui-form-label" style="top: -2px;">
                到期处理
            </label>
            <div class="layui-input-block">
                        <textarea id="L_content" name="due_process"
                                  placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <input type="submit" value="增加" class="layui-btn" lay-filter="add" lay-submit="">
        </div>
    </form>
</div>
<script src="./lib/layui/layui.js" charset="utf-8">
</script>
<script src="./js/x-layui.js" charset="utf-8">
</script>
<script>
    layui.use(['form','layer','layedit'], function(){
        $ = layui.jquery;
        var form = layui.form()
            ,layer = layui.layer
            ,layedit = layui.layedit;


        layedit.set({
            uploadImage: {
                url: "./upimg.json" //接口url
                ,type: 'post' //默认post
            }
        })

        //创建一个编辑器
        editIndex = layedit.build('L_content');



        //监听提交
//        form.on('submit(add)', function(data){
//            console.log(data);
//            //发异步，把数据提交给php
//            layer.alert("增加成功", {icon: 6},function () {
//                // 获得frame索引
//                var index = parent.layer.getFrameIndex(window.name);
//                //关闭当前frame
//                parent.layer.close(index);
//            });
//            return false;
//        });


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