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
>>>>>>> b43d3dd256f1008e13408bef378c7fb082ea47bd
    <title>Document</title> 
    <link href="hui/iconfont.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/css.css">

<<<<<<< HEAD

=======
>>>>>>> b43d3dd256f1008e13408bef378c7fb082ea47bd
</head>
<body>
<div class="nav">
    <ul>
        <li >
<<<<<<< HEAD

            <a href="index">

            <a href="index">

=======
            <a href="/index">
>>>>>>> b43d3dd256f1008e13408bef378c7fb082ea47bd
                <span><i class="Hui-iconfont">&#xe67f;</i></span>
                <span>首页</span>
            </a>
        </li>
        <li>
            <a href="project">
                <span><i class="Hui-iconfont">&#xe627;</i></span>
                <span>理财</span>
            </a>
        </li>
        <li>
<<<<<<< HEAD

            <a href="account">

=======
            <a href="account">
>>>>>>> b43d3dd256f1008e13408bef378c7fb082ea47bd
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
        if(url.indexOf($(this).attr('href')) >= 0){
            $(this).find('i').addClass('this');
        }
    })
</script>

</html>