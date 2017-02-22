<?php

Route::any('register','RegisterController@index');//注册页面一
Route::any('registers','RegisterController@register'); //注册页面二
Route::any('checkcode','RegisterController@checkcode');//发送验证码
Route::any('backpwd','RegisterController@backpassword'); // 重置密码页面
Route::any('user_updatepwd','RegisterController@updatepwd'); //用户忘记密码


Route::group(['middleware' => ['web','common']], function () {


	Route::get('/','IndexController@index');
	Route::any('index','IndexController@index');
	Route::any('user_add','RegisterController@add'); //用户添加
	Route::any('login','LoginController@index'); 	//验证用户登录
	Route::any('user_shiming','RegisterController@shiming'); //用户实名认证
	Route::any('user_editpwd','RegisterController@editpwd'); //用户修改密码
	Route::any('user_editpay','RegisterController@editpay'); //用户修改支付密码
	Route::any('user_bankcard','RegisterController@bankcard'); //用户个人中心绑定银行卡
	//投资项目
	Route::get('project','ProjectController@index');
	Route::get('details','ProjectController@details');
	Route::get('payment','ProjectController@payment');
	Route::get('account','AccountController@index');
	Route::get('getProperty','AccountController@getProperty');
	Route::get('getBill','AccountController@getBill');
	Route::get('datum','AccountController@datum');
	Route::get('getIsBinding','AccountController@getIsBinding');
	Route::get('recharge','AccountController@recharge');
	Route::get('binding','AccountController@binding');


});