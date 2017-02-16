<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class AccountController extends Controller
{
    //
    public function index(){

        $user_id = 1;//模拟用户id
        $user = DB::table('user')->select('username','money')->where('user_id',$user_id)->first();

        return view('account.index',['user'=>$user]);
    }


    public function datum(){
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

        $data = DB::table('money_trend')->select('money','time','status')->where('user_id',$user_id)->skip(0)->take(10)->get();
        exit(json_encode($data));
    }

    public function getIsBinding(){

        $result = ['code'=>0,'error'=>'']; //返回信息
        $user_id = 1;//模拟用户id

        $binding = DB::table('binding')->where('user_id',$user_id)->first();
        if($binding){
            $bank = DB::table('bank')->where('bank_id',$binding->bank)->first();
            $result['code'] = 1;
            $result['error'] = 'OK';
            $result['data'] = ['bank_name'=>$bank->bank_name,'card_num'=>substr($binding->card_num,-4)];
        }else{
            $result['error'] = '未绑定银行卡';
        }
        exit(json_encode($result));
    }
}
