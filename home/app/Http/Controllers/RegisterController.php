<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
use App\Http\Requests;
use DB,Input,Redirect,url,Validator,Request;
use App\User;
class RegisterController extends Controller
{
    /**
     * 页面一
     * @return [type] [description]
     */
    public function index(){
        return view('register.register');
    }


    /**
     * 页面二
     * @return [type] [description]
     */
    public function register()
    {
    	/* 接收第一个页面过来的手机号码 */
    	$list['tell'] = Request::get('tell');
    	if(!isset($list['tell']))
    	{
    		$list['tell'] = '';
    	}

        /* 查询是否新用户注册 */
        $user = new User();
        $info = $user->where('phone','=',$list['tell'])->get()->toArray();
        if($info)
        {
            return view('register.checklogin',$list);
        }
        else
        {
            return view('register.register2',$list);
        }
    }


    /**
     * 用户注册
     */
    public function add()
    {
        $data =  Request::input();

        /* 验证数据合法性 */
        $length = preg_match("/^\d{11}$/", $data['tell']); //账户名
        $password = preg_match("/^[\w-\.]{6,12}$/", $data['password']); //密码
        /* 验证码待开发*/
        $data1 = 'mobile='.$data['tell'].'&code='.$data['code'];
        $url = 'https://api.netease.im/sms/verifycode.action';
        $re = $this->sendcode($data1,$url);
        $res = json_decode($re,true);
        if($res['code']!=200)
        {
            $result = ['errCode'=>4,'msg'=>'验证码错误'];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        }

        if($length && $password)
        {
            /* 入库操作 */
            $user = new User();
            $user->phone=$data['tell'];
            $user->password=md5($data['password']);
            $user->time=time();
            $res = $user->save(); 
            if($res)
            {
                $result = ['errCode'=>1,'msg'=>'操作成功'];
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $result = ['errCode'=>2,'msg'=>'服务器错误,注册失败'];
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
        }
        else
        {
            $result = ['errCode'=>3,'msg'=>'数据不合法']; 
            echo json_encode($result,JSON_UNESCAPED_UNICODE);  
        }
    }

    /**
     * 发送验证码
     * @return [type] [description]
     */
    public function checkcode()
    {
    	/* 接收手机号码 */
    	$tell =  Request::get('tell');
        /* 处理参数 */
        $data = 'mobile='.$tell.'&templateid=3054081';
        $url = 'https://api.netease.im/sms/sendcode.action';
    	/* 发送短信 */
        $this->sendcode($data,$url);
    }


    /* Curl发送短信 */
    public function sendcode($data,$url)
    {
        $data = $data;
        $curlobj = curl_init(); //初始化
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYHOST, FALSE);
        //获取URL地址
        $url = $url;
        curl_setopt($curlobj,CURLOPT_URL,$url);
        //启用时会将头文件的信息作为数据流输出
        curl_setopt($curlobj,CURLOPT_HEADER,0);
        //不直接输出
        curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,1);
        //在HTTP请求中包含一个"User-Agent: "头的字符串
        curl_setopt($curlobj,CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        //指定POST方式传值
        curl_setopt($curlobj,CURLOPT_POST,1);
        curl_setopt($curlobj,CURLOPT_POSTFIELDS,$data);
        $time = time();
        $sum = SHA1('54cea74bc42b'.'1234'.$time);
        //设置 HTTP 头字段的数组
        curl_setopt($curlobj,CURLOPT_HTTPHEADER,
                    array('Content-Type:application/x-www-form-urlencoded;charset=utf-8',   
                          'AppKey:b968dea4143ded88f9c58c6115fcb01a',
                          'Nonce:1234',
                          'CurTime:'.$time,
                          'CheckSum:'.$sum,
                          'Content-length:'.strlen($data)
                          ));
        $str = curl_exec($curlobj); //执行
        curl_close($curlobj); //执行完毕释放curl
        return $str;
    }


    /**
     * 用户找回密码
     * @return [type] [description]
     */
    public function backpassword()
    {
        /* 接收手机号 */
        $list['tell'] = Request::get('tell');
        if(!isset($list['tell']))
        {
            $list['tell'] = '';
        }
        //返回找回密码页面
        return view('register.backpwd',$list);
    }


    /**
     * 用户修改密码
     * @return [type] [description]
     */
    public function updatepwd()
    {
        $data =  Request::input();
        /* 验证数据合法性 */
        $length = preg_match("/^\d{11}$/", $data['tell']); //账户名
        $password = preg_match("/^[\w-\.]{6,12}$/", $data['password']); //密码
        /* 验证码待开发*/
        $data1 = 'mobile='.$data['tell'].'&code='.$data['code'];
        $url = 'https://api.netease.im/sms/verifycode.action';
        $re = $this->sendcode($data1,$url);
        $res = json_decode($re,true);
        if($res['code']!=200)
        {
            $result = ['errCode'=>4,'msg'=>'验证码错误'];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        }

        if($length && $password)
        {
            /* 修改密码操作 */
            $res = DB::table('user')->where('phone',$data['tell'])->update(['password'=>md5($data['password'])]);
            if($res)
            {
                $result = ['errCode'=>1,'msg'=>'修改成功'];
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $result = ['errCode'=>2,'msg'=>'服务器错误,修改失败'];
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
        }
        else
        {
            $result = ['errCode'=>3,'msg'=>'数据不合法']; 
            echo json_encode($result,JSON_UNESCAPED_UNICODE);  
        }
    }

}