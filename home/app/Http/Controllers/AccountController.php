<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class AccountController extends Controller
{
    //
    public function index(Request $request){

        $user_id = 1;//模拟用户id
        $user = DB::table('user')->select('username','money')->where('user_id',$user_id)->first();

        $action = $request->input('a','');

        if(!empty($action)){
            $prior = $_SERVER['HTTP_REFERER'];
        }else{
            $prior = '';
        }

        return view('account.index',['user'=>$user,'action'=>$action,'prior'=>$prior]);
    }


    public function datum(){
//        echo "<a href='/account?a=recharge'>首页</a>";die;
        return view('account.datum');
    }

    /**
     * 获取总资产信息
     * @return result['code'=>状态码,'error'=>提示信息,'data'=>['earnings'=>用户总收益,'balance'=>用户余额]];
     */
    public function getProperty(){

        $result = ['code'=>0,'error'=>'']; //返回信息

        $user_id = 1;//模拟用户id

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
        $user_id = 1;//模拟用户id

        $data = DB::table('money_trend')->select('money','time','status')->where('user_id',$user_id)->orderBy('time','desc')->skip(0)->take(10)->get();
        exit(json_encode($data));
    }

    /**
     *  验证是否绑定银行卡或返回绑定信息
     */
    public function getIsBinding(){

        $result = ['code'=>0,'error'=>'']; //返回信息
        $user_id = 2;//模拟用户id

        $binding = DB::table('binding')->where('user_id',$user_id)->first();
        if($binding){
            $bank = DB::table('bank')->where('bank_id',$binding->bank)->first();
            $result['code'] = 1;
            $result['error'] = 'OK';
            $result['data'] = ['bank_name'=>$bank->bank_name,'bind_id'=>$binding->bind_id,'card_num'=>substr($binding->card_num,-4)];
        }else{
            $result['error'] = '未绑定银行卡';
        }
        exit(json_encode($result));
    }

    /**
     * 充值
     * @param Request $request
     */
    public function recharge(Request $request){

        $result = ['code'=>0,'error'=>'']; //返回信息
        $user_id = 1;//模拟用户id

        $recharge_val = $request->input('recharge_val');
        $bind_id = $request->input('bind_id');

        if(!empty($bind_id) && is_numeric($recharge_val)){
            $re = DB::table('user')->where('user_id',$user_id)->increment('money',$recharge_val);
            $res = DB::table('money_trend')->insert(['user_id'=>$user_id,'time'=>time(),'money'=>$recharge_val,'status'=>1]);
            $result['code'] = 1;
            $result['error'] = 'OK';
        }else{
            $result['error'] = '充值失败';
        }
        exit(json_encode($result));
    }

    public function binding(Request $request){

        $result = ['code'=>0,'error'=>'']; //返回信息
        $user_id = 1;//模拟用户id

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
