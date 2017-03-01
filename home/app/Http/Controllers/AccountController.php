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
            $bank = DB::table('bank')->where('bank_id',$binding->bank)->first();
            $result['code'] = 1;
            $result['error'] = 'OK';
            $result['data'] = ['bank_name'=>$bank->bank_name,'bind_id'=>$binding->bind_id,'card_num'=>substr($binding->card_num,-4)];
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

    //微博分享
    public function invite()
    {
//        $user_id = md5(session('user_id'));
//        $url = "";
    }
}
