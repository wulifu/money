<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Document</title>

    <link href="{{asset('hui/iconfont.css')}}" rel="stylesheet" type="text/css" />

    <link href="hui/iconfont.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/css.css">


    <link href="{{asset('css/css.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('hui/iconfont.css')}}" rel="stylesheet" type="text/css" />

=======
    <title>Document</title> 
    <link href="hui/iconfont.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/css.css">

>>>>>>> 02931e66f1764cd004518ec0001488664605a7c1
</head>
<body>
<div class="nav">
    <ul>
        <li >
<<<<<<< HEAD
            <a href="index">
=======
            <a href="/index">
>>>>>>> 02931e66f1764cd004518ec0001488664605a7c1
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
<<<<<<< HEAD
            <a href="account">

                <span><i class="Hui-iconfont ">&#xe60d;</i></span>
                <span>我的</span>

               

=======
            <a href="/account">
                <span><i class="Hui-iconfont ">&#xe60d;</i></span>
                <span>我的</span>
>>>>>>> 02931e66f1764cd004518ec0001488664605a7c1
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