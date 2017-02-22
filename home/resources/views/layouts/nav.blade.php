<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="hui/iconfont.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/css.css">

</head>
<body>
<div class="nav">
    <ul>
        <li >
            <a href="/index">
                <span><i class="Hui-iconfont">&#xe67f;</i></span>
                <span>首页</span>
            </a>
        </li>
        <li>
            <a href="/project">
                <span><i class="Hui-iconfont">&#xe627;</i></span>
                <span>理财</span>
            </a>
        </li>
        <li>
            <a href="/account">
                <span><i class="Hui-iconfont ">&#xe60d;</i></span>
                <span>我的</span>
            </a>
        </li>
    </ul>
</div>
</body>

<script>
    var url = window.location.pathname;
    $('.nav ul li a').each(function(){
//        alert(url.indexOf($(this).attr('href')))
        if(url.indexOf($(this).attr('href')) >= 0){
            $(this).find('i').addClass('this');
        }
    })
</script>

</html>