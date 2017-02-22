<?php
namespace App\Http\Controllers;
use DB,Input,Redirect,url,Validator,Request;
use App\Http\Requests;
use App\User;
use App\Binding;
use Symfony\Component\HttpFoundation\Session\Session;

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
            $user->pay_pwd ='123456';
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
     * 用户忘记密码
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


    /**
     * 用户完善实名认证
     * @return [type] [description]
     */
    public function shiming()
    {
        $data = Request::input();
        /* 验证数据合法性 */
        $data1 = preg_match("/^[\x4e00-\x9fa5]+$/",$data['username']); //账户名
        $data2 = preg_match("/^\d{15}(\d{2}[A-Za-z0-9])?$/",$data['idcard']);
        // echo $data2;
        if($data1==0 && $data2==1)
        {
            /* 验证成功 */
            $phone = session('user');
            $res = DB::table('user')->where('phone',$phone)->update(['username'=>$data['username'],'idcard'=>$data['idcard']]);
            if($res)
            {
                $result = ['errCode'=>'1','msg'=>'完善成功'];
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $result = ['errCode'=>'2','msg'=>'操作失败'];
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
        }
        else
        {
            $result = ['errCode'=>'3','msg'=>'数据不合法'];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 用户修改密码
     * @return [type] [description]
     */
    public function editpwd()
    {
        $data = Request::input();
        /* 验证数据合法性 */
        $data1 = preg_match("/[0-9A-Za-z]{6,16}/", $data['pri_password']);
        $data2 = preg_match("/[0-9A-Za-z]{6,16}/", $data['password']);
        $data3 = preg_match("/[0-9A-Za-z]{6,16}/", $data['con_password']);
        if($data1&&$data2&&$data3)
        {
            /* 验证原密码 */
            $phone = session('user');
            $res = DB::table('user')->where('phone',$phone)->get();
            $resu = json_encode($res);
            $res = json_decode($resu,true);
            if($res[0]['password'] == md5($data['pri_password']))
            {
                /* 判断原密码跟新密码是否一致 */
                if($res[0]['password'] == md5($data['password']))
                {
                    $result = ['errCode'=>2,'msg'=>'新密码与原始密码一致'];
                    echo json_encode($result,JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    /* 判断两次密码是输入一致 */
                    if($data['password'] == $data['con_password'])
                    {
                        /* 修改 */
                        $re = DB::table('user')->where('phone',$phone)->update(['password'=>md5($data['password'])]);
                        if($re)
                        {
                            $result = ['errCode'=>1,'msg'=>'操作成功'];
                            echo json_encode($result,JSON_UNESCAPED_UNICODE);
                        }
                        else
                        {
                            $result = ['errCode'=>6,'msg'=>'操作失败'];
                            echo json_encode($result,JSON_UNESCAPED_UNICODE);
                        }
                    }
                    else
                    {
                        $result = ['errCode'=>5,'msg'=>'新密码输入不一致'];
                        echo json_encode($result,JSON_UNESCAPED_UNICODE);
                    }
                }
                
            }
            else
            {
                $result = ['errCode'=>4,'msg'=>'原始密码错误'];
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
     * 用户修改支付密码
     * @return [type] [description]
     */
    public function editpay()
    {
        $data = Request::input();
        /* 验证数据合法性 */
        $data1 = preg_match("/[0-9A-Za-z]{6,16}/", $data['pri_paypwd']);
        $data2 = preg_match("/[0-9A-Za-z]{6,16}/", $data['paypwd']);
        $data3 = preg_match("/[0-9A-Za-z]{6,16}/", $data['con_paypwd']);
        if($data1&&$data2&&$data3)
        {
            /*验证原始支付密码*/
            $phone = session('user');
            $res = DB::table('user')->where('phone',$phone)->get();
            $resu = json_encode($res);
            $res = json_decode($resu,true);
            if($res[0]['pay_pwd'] == md5($data['pri_paypwd']))
            {
                /* 判断原始密码是否新密码一致 */
                if($res[0]['pay_pwd'] == md5($data['paypwd']))
                {
                    $result = ['errCode'=>3,'msg'=>'新密码与原始密码一致'];
                    echo json_encode($result,JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    /* 判断两次密码是否一致 */
                    if($data['paypwd'] == $data['con_paypwd'])
                    {
                        /* 修改 */
                        $re = DB::table('user')->where('phone',$phone)->update(['pay_pwd'=>md5($data['con_paypwd'])]);
                        if($re)
                        {
                            $result = ['errCode'=>1,'msg'=>'操作成功'];
                            echo json_encode($result,JSON_UNESCAPED_UNICODE);
                        }
                        else
                        {
                            $result = ['errCode'=>6,'msg'=>'操作失败'];
                            echo json_encode($result,JSON_UNESCAPED_UNICODE);
                        }
                    }
                    else
                    {
                        $result = ['errCode'=>3,'msg'=>'新密码输入不一致'];
                        echo json_encode($result,JSON_UNESCAPED_UNICODE);
                    }
                }
            }
            else
            {
                $result = ['errCode'=>3,'msg'=>'原密码错误'];
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
     * 用户绑卡
     * @return [type] [description]
     */
    public function bankcard()
    {
        $data = Request::input();
        $data1 = preg_match("/([0-9]){18,19}/", $data['card_num']);
        if($data1)
        {
            /* 入库操作 */
            $binding = new Binding();
            $binding->user_id = session('user_id');;
            $binding->card_num=$data['card_num'];
            $binding->bank=$data['bank'];
            $res = $binding->save();
            if($res)
            {
                $result = ['errCode'=>1,'msg'=>'操作成功'];
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $result = ['errCode'=>3,'msg'=>'操作失败'];
                echo json_encode($result,JSON_UNESCAPED_UNICODE);
            }

        }
        else
        {
            $result = ['errCode'=>2,'msg'=>'数据不合法'];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }

    }
}