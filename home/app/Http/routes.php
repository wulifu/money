<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
<<<<<<< HEAD

Route::group(['middleware' => ['web']], function () {
    //
});

Route::get('account','AccountController@index');



Route::any('index','IndexController@index');


=======
>>>>>>> 02931e66f1764cd004518ec0001488664605a7c1
Route::any('register','RegisterController@index');//注册页面一
Route::any('registers','RegisterController@register'); //注册页面二

Route::group(['middleware' => ['web','common']], function () {
	

Route::any('checkcode','RegisterController@checkcode');//发送验证码
Route::any('user_add','RegisterController@add'); //用户添加
Route::any('login','LoginController@index'); 	//验证用户登录

Route::any('backpwd','RegisterController@backpassword'); // 重置密码页面
Route::any('user_updatepwd','RegisterController@updatepwd'); //用户忘记密码
Route::any('user_shiming','RegisterController@shiming'); //用户实名认证
Route::any('user_editpwd','RegisterController@editpwd'); //用户修改密码
Route::any('user_editpay','RegisterController@editpay'); //用户修改支付密码
Route::any('user_bankcard','RegisterController@bankcard'); //用户个人中心绑定银行卡
//投资项目
Route::get('project','ProjectController@index');
Route::get('details','ProjectController@details');
Route::get('payment','ProjectController@payment');
Route::get('account','AccountController@index');


// Route::get('comm','CommonController@index'); //测试



Route::get('getProperty','AccountController@getProperty');
Route::get('getBill','AccountController@getBill');

<<<<<<< HEAD
Route::get('datum','AccountController@datum');

Route::get('getIsBinding','AccountController@getIsBinding');

Route::get('getIsBinding','AccountController@getIsBinding');



//投资项目
Route::get('project','ProjectController@index');
Route::get('details','P.rojectController@details');


=======
>>>>>>> 02931e66f1764cd004518ec0001488664605a7c1

Route::get('getIsBinding','AccountController@getIsBinding');

Route::get('getIsBinding','AccountController@getIsBinding');
<<<<<<< HEAD
//投资项目
Route::get('project','ProjectController@index');
Route::get('details','ProjectController@details');
Route::get('payment','ProjectController@payment');
=======

Route::get('recharge','AccountController@recharge');
Route::get('binding','AccountController@binding');


Route::any('index','IndexController@index');


});


>>>>>>> 02931e66f1764cd004518ec0001488664605a7c1

