<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Symfony\Component\HttpFoundation\Session\Session;
class AccountController extends Controller
{
    //
    public function index(Request $request){

        $user_id = session('user_id');//模拟用户id
        $user = DB::table('user')->where('user_id',$user_id)->first();
        $p_msg = DB::table('user')->where('p_id',$user_id)->get();
        $str = 0;
        $user->new_money = 0;
        if(date('Y-m-d',$user->time)==date('Y-m-d',time()))
        {
            $user->new_money = 10;
        }
        if($p_msg)
        {
            foreach($p_msg as $key => $value)
            {
                if(date('Y-m-d',$value->time)==date('Y-m-d',time()))
                {
                    $str = $str+1;
                }
            }
            $user->new_money = $str * 10;
        }

//        print_r($user);die;

        //用户总收益
        $earnings = DB::table('money_trend')->select('money')->where(['user_id'=>$user_id,'status'=>2])->sum('money');
        $today_earnings_re = DB::table('money_trend')->select('money')->where(['user_id'=>$user_id,'status'=>2])->where('time','>',time()-21*60)->orderBy('m_id','desc')->first();

        if(!empty($today_earnings_re)){
            $today_earnings = $today_earnings_re->money;
        }else{
            $today_earnings = 0;
        }


        $action = $request->input('a','');

        if(!empty($action)){
            $prior = $_SERVER['HTTP_REFERER'];
        }else{
            $prior = '';
        }

        return view('account.index',['user'=>$user,'action'=>$action,'prior'=>$prior,'earnings'=>$earnings,'today_earnings'=>$today_earnings]);
    }


    /**
     * 用户个人中心
     * @return [type] [description]
     */
    public function datum(){
        $user_id = session('user_id');
        // echo $user_id;
        // die;
        /* 查询用户信息 */
        $re = DB::table('user')->where('user_id',$user_id)->first();
        /* 查询用户绑卡信息 */
        $res = DB::table('binding')->where('user_id',$user_id)->get();
        return view('account.datum',['info'=>$re,'show'=>$res]);
    }

    /**
     * 获取总资产信息
     * @return result['code'=>状态码,'error'=>提示信息,'data'=>['earnings'=>用户总收益,'balance'=>用户余额]];
     */
    public function getProperty(){

        $result = ['code'=>0,'error'=>'']; //返回信息

        $user_id = session('user_id');//模拟用户id

        //用户余额
        $balance = DB::table('user')->select('money')->where('user_id',$user_id)->first();

        //用户总收益
        $earnings = DB::table('money_trend')->select('money')->where(['user_id'=>$user_id,'status'=>2])->sum('money');

        //用户投资金额
        $project_money = DB::table('finance_detailed')->join('finance_project','finance_detailed.fin_id','=','finance_project.fin_id')->select('finance_detailed.money')->where(['finance_detailed.user_id'=>$user_id,'finance_project.status'=>1])->sum('finance_detailed.money');

        //理财总收益
        $project_earnings = DB::table('finance_detailed')->join('finance_project','finance_detailed.fin_id','=','finance_project.fin_id')->select('finance_detailed.profit')->where(['finance_detailed.user_id'=>$user_id,'finance_project.status'=>0])->sum('finance_detailed.profit');

        $result['code'] = 1;
        $result['error'] = 'ok';
        $result['data'] = ['earnings'=>$earnings,'balance'=>$balance->money,'project_money'=>$project_money,'project_earnings'=>$project_earnings];
        exit(json_encode($result));
    }

    /**
     * 获取我的账单
     */
    public function getBill(Request $request){
        $user_id = session('user_id');//模拟用户id
        $skip = $request->input('skip',0);
        $result = ['code'=>0,'error'=>''];

        $data = DB::table('money_trend')->select('money','time','status')->where('user_id',$user_id)->orderBy('time','desc')->skip($skip)->take(10)->get();
        if($data){
            foreach($data as $key => $val){
                $data[$key]->time = date('Y-m-d H:i:s',$val->time+8*60*60);
                $result['code'] = 1;
                $result['data'] = $data;
            }
        }else{
            if($skip == 0){
                $result['code'] = 0;
                $result['error'] = '查询失败';
            }else{
                $result['code'] = 2;
                $result['error'] = '没有更多数据了';
            }

        }

        exit(json_encode($result));
    }

    /**
     *  验证是否绑定银行卡或返回绑定信息
     * @return ['code'=>0:未绑定银行卡,1:可充值,2:未实名认证,'error'=>'错误信息','data'=>'用户信息']
     */
    public function getIsBinding(){

        $result = ['code'=>0,'error'=>'']; //返回信息
        $user_id = session('user_id');//用户id

        $binding = DB::table('binding')->where('user_id',$user_id)->first();
        if($binding){
            $bank = DB::table('bank')->get();
            $bank = json_decode(json_encode($bank),true);
            $result['code'] = 1;
            $result['error'] = 'OK';
//            $result['data'] = ['bank_name'=>$bank->bank_name,'bind_id'=>$binding->bind_id,'card_num'=>substr($binding->card_num,-4)];
            $result['data']= $bank;
            $result['card_num']= substr($binding->card_num,-4);
            $result['bind_id']=$binding->bind_id;
        }else{
            $user_re = DB::table('user')->select('idcard','username')->where('user_id',$user_id)->first();
            if(empty($user_re->username) || empty($user_re->idcard)){
                $result['code'] = 2;
                $result['error'] = '请先前去个人中心实名认证';
            }else{
                $result['error'] = '未绑定银行卡';
                $result['data'] = ['username'=>$user_re->username,'idcard'=>substr($user_re->idcard,0,6).'******'.substr($user_re->idcard,-4)];
            }
        }
//        print_r($result);
        exit(json_encode($result));
    }

    /**
     * 充值
     * @param Request $request
     */
    public function recharge(Request $request){

        $result = ['code'=>0,'error'=>'']; //返回信息
        $user_id = session('user_id');//模拟用户id

        $recharge_val = $request->input('recharge_val');
        $bind_id = $request->input('bind_id');

        if(!empty($bind_id) && is_numeric($recharge_val)){
            $re = DB::table('user')->where('user_id',$user_id)->increment('money',$recharge_val);
            $res = DB::table('money_trend')->insert(['user_id'=>$user_id,'time'=>time(),'money'=>$recharge_val,'status'=>0]);
            $result['code'] = 1;
            $result['error'] = 'OK';
        }else{
            $result['error'] = '充值失败';
        }
        exit(json_encode($result));
    }

    /**
     * 提现
     * @param Request $request
     */
    public function fetch(Request $request){
        $result = ['code'=>0,'error'=>'']; //返回信息
        $user_id = session('user_id');//模拟用户id

        $fetch_val = $request->input('fetch_val');
        //$bind_id = $request->input('bind_id');

        if(is_numeric($fetch_val)){
            $userr_money = DB::table('user')->select('money')->where('user_id',$user_id)->first();
            if($userr_money->money >= $fetch_val){
                $re = DB::table('user')->where('user_id',$user_id)->decrement('money',$fetch_val);
                $res = DB::table('withdrawals')->insert(['user_id'=>$user_id,'time'=>time(),'money'=>$fetch_val]);
                $result['code'] = 1;
                $result['error'] = 'OK';
            }else{
                $result['error'] = '余额不足';
            }

        }else{
            $result['error'] = '充值失败';
        }
        exit(json_encode($result));
    }

    /**
     * 绑定银行卡
     * @param Request $request
     */
    public function binding(Request $request){

        $result = ['code'=>0,'error'=>'']; //返回信息
        $user_id = session('user_id');//模拟用户id

        $card_num = $request->input('card_num');
        $phone = $request->input('phone');
        $auth_code = $request->input('auth_code');

        $re = DB::table('binding')->insert(['user_id'=>$user_id,'card_num'=>$card_num,'bank'=>1]);
        if($re){
            $result['code'] = 1;
        }else{
            $result['error'] = '操作失败，请重试';
        }

        exit(json_encode($result));
    }

    /**
     * 我的投资项目
     * @param Request $request
     */
    public function myProject(Request $request){
        $type = $request->input('type','');  // 请求类型
        $user_id = session('user_id');  //用户id
        $result = ['code'=>0,'error'=>''];  //返回信息
//        echo $type;die;
        if(empty($type)){
            $fin_idList = DB::table('finance_detailed')->distinct()->lists('fin_id');
            $project_list = DB::table('finance_project')->select('fin_id','pro_name','yield','term','money')->where('status',1)->whereIn('fin_id',$fin_idList)->get();
            foreach($project_list as $key => $val){
                $project_list[$key]->money_sum = DB::table('finance_detailed')->select('money')->where(['user_id'=>$user_id,'fin_id'=>$val->fin_id])->sum('money');
            }
        }else{
            $fin_idList = DB::table('finance_detailed')->distinct()->lists('fin_id');
            $project_list = DB::table('finance_project')->select('fin_id','pro_name','yield','term','money')->where('status',0)->whereIn('fin_id',$fin_idList)->get();
            foreach($project_list as $key => $val){
                $project_list[$key]->money_sum = DB::table('finance_detailed')->select('money')->where(['user_id'=>$user_id,'fin_id'=>$val->fin_id])->sum('money');
                $project_list[$key]->profit_sum = DB::table('finance_detailed')->select('profit')->where(['user_id'=>$user_id,'fin_id'=>$val->fin_id])->sum('profit');
            }
        }
        $result['code'] = 1;
        $result['error'] = 'ok';
        $result['data'] = $project_list;

        exit(json_encode($result));
    }

    //支付宝付款
    public function Alipay(Request $request)
    {
        $user_id = session('user_id');//模拟用户id

        $recharge_val = $request->input('recharge_val');
        $bind_id = $request->input('bind_id');
        $bank_id = $request->input('bank_id');
        $sn = 'EC'.rand(1,9999).'cz';

        //合作身份者id，以2088开头的16位纯数字
        $alipay_config['partner']		= '2088121321528708';
        //收款支付宝账号
        $alipay_config['seller_email']	= 'itbing@sina.cn';
        //安全检验码，以数字和字母组成的32位字符
        $alipay_config['key']			= '1cvr0ix35iyy7qbkgs3gwymeiqlgromm';
        //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        //签名方式 不需修改
        $alipay_config['sign_type']    = strtoupper('MD5');
        //字符编码格式 目前支持 gbk 或 utf-8
        //$alipay_config['input_charset']= strtolower('utf-8');
        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        //$alipay_config['cacert']    = getcwd().'\\cacert.pem';
        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        $alipay_config['transport']    = 'http';
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => $alipay_config['partner'], // 合作身份者id
            "seller_email" => $alipay_config['seller_email'], // 收款支付宝账号
            "payment_type"	=> $bank_id, // 支付类型
            "notify_url"	=> "http://localhost/res.php", // 服务器异步通知页面路径
            "return_url"	=> "http://www.licai.com/pay_nize", // 页面跳转同步通知页面路径
            "out_trade_no"	=> $sn, // 商户网站订单系统中唯一订单号
            "subject"	=> "充值", // 订单名称
            "total_fee"	=> $recharge_val, // 付款金额
            "body"	=> "1409phpB", // 订单描述 可选
            "show_url"	=> "", // 商品展示地址 可选
            "anti_phishing_key"	=> "", // 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
            "exter_invoke_ip"	=> "", // 客户端的IP地址
            "_input_charset"	=> 'utf-8', // 字符编码格式
        );

        // 去除值为空的参数
        foreach ($parameter as $k => $v) {
            if (empty($v)) {
                unset($parameter[$k]);
            }
        }
        // 参数排序
        ksort($parameter);
        reset($parameter);

        // 拼接获得sign
        $str = "";
        foreach ($parameter as $k => $v) {
            if (empty($str)) {
                $str .= $k . "=" . $v;
            } else {
                $str .= "&" . $k . "=" . $v;
            }
        }
        $parameter['sign'] = md5($str . $alipay_config['key']);	// 签名
        $parameter['sign_type'] = $alipay_config['sign_type'];
        $html = "https://mapi.alipay.com/gateway.do?".$str.'&sign='.$parameter['sign'].'&sign_type='.$parameter['sign_type'];

        return  $html;

    }

    //支付宝同步返回
    public function pay_synchronize(Request $request)
    {
        $user_id = session('user_id');//模拟用户id

        $data = $request->input();
        if(isset($data['trade_status'])=='TRADE_SUCCESS')
        {

            $re = DB::table('user')->where('user_id',$user_id)->increment('money',$data['total_fee']);
            $res = DB::table('money_trend')->insert(['user_id'=>$user_id,'time'=>time(),'money'=>$data['total_fee'],'status'=>0]);
            if($re && $res)
            {
                echo "<script>alert('充值成功');location.href='account'</script>";
            }else
            {
                echo "<script>alert('充值失败');location.href='account'</script>";
            }
        }
    }


}
