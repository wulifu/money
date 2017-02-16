<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use App\Http\Requests;
use DB,Input,Redirect,url,Validator,Request,Session;
use App\User;
class LoginController extends Controller
{

	/**
	 * 用户登录
	 * @return [type] [description]
	 */
	public function index()
	{
		$data =  Request::input();
		/* 查询用户 */
        $user = new User();
        $info = $user->where('phone','=',$data['tell'])->get()->toArray();
        /* 判断密码 */
        if(md5($data['password']) == $info[0]['password'])
        {
        	/* 登录成功 存Session */
			Session::put('user', $info[0]['phone']);
			$result = ['errCode'=>1,'msg'=>'登录成功'];
        	echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
        else
        {
        	/* 密码错误 */
        	$result = ['errCode'=>2,'msg'=>'密码输入错误'];
        	echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
	}
}