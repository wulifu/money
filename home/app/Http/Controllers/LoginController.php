<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use DB,Input,Redirect,url,Validator,Request;
use App\User;
use Symfony\Component\HttpFoundation\Session\Session;
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
          session(['user'=>$info[0]['phone']]);
          session(['user_id'=>$info[0]['user_id']]);
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

   /* 安全退出 */
   public function signout()
   {
      session()->forget('user_id');
      session()->forget('user');
      echo session('user');
   }
}