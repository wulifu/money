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
        $user = DB::table('user')->select('username','money')->where('user_id',$user_id)->first();

        //用户总收益
        $earnings = DB::table('money_trend')->select('money')->where(['user_id'=>$user_id,'status'=>2])->sum('money');

        $action = $request->input('a','');

        if(!empty($action)){
            $prior = $_SERVER['HTTP_REFERER'];
        }else{
            $prior = '';
        }

        return view('account.index',['user'=>$user,'action'=>$action,'prior'=>$prior,'earnings'=>$earnings]);
    }


    /**
     * 用户个人中心
     * @return [type] [description]
     */
    public function datum(){
        $user_id = session('user_id');
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

        $result['code'] = 1;
        $result['error'] = 'ok';
        $result['data'] = ['earnings'=>$earnings,'balance'=>$balance->money];
        exit(json_encode($result));
    }

    /**
     * 获取我的账单
     */
    public function getBill(){
        $user_id = session('user_id');//模拟用户id

        $data = DB::table('money_trend')->select('money','time','status')->where('user_id',$user_id)->orderBy('time','desc')->skip(0)->take(10)->get();

        foreach($data as $key => $val){
            $data[$key]->time = date('Y-m-d H:i:s',$val->time);
        }
//        var_dump($data);die;
        exit(json_encode($data));
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
}
