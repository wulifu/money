<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Symfony\Component\HttpFoundation\Session\Session;
header("content-type:text/html;charset=utf-8");
class ProjectController extends Controller
{
    //投资项目列表
    public function index(){
        $res=DB::table('finance_project')->select('fin_id','pro_name','yield','money','term')->paginate(4);
        $sum=$res->lastPage();
        return view('project.index',['res'=>$res,'sum'=>$sum]);
    }

    //投资项目介绍
    public function details(){
        //获取用户登录信息  session
        $phone=  session('user');
        $last=DB::table('user')->where('phone','=',$phone)->select('money','user_id')->get();
        if(empty($last)){
            $money_last=0;
        }else{
            $last=json_encode($last);
            $last=json_decode($last,true);
            $money_last=round($last[0]['money'],2);
            $user_id=$last[0]['user_id'];
        }
        $fin_id=\Request::get('fin_id');
        $res=DB::table('finance_project')->where('fin_id','=',$fin_id)->get();
        $array=DB::table('finance_detailed')->where('fin_id','=',$fin_id)->orderBy('time', 'desc')->get();
        $phones=array();
        $money=0;
        foreach($array as $key=>$val){
            $money+=$val->money;
            $arr=DB::table('user')->where('user_id','=',$val->user_id)->select('phone','money')->get();
            $arr=json_encode($arr);
            $arr=json_decode($arr,true);
            $phone=$arr[0]['phone'];
            $phones[$key]=substr($phone,0,3)."****".substr($phone,-4);
        }
        return view('project.details',['res'=>$res,'array'=>$array,'phone'=>$phones,'money'=>$money,'last_money'=>$money_last,'user_id'=>$user_id]);
    }


    //项目金融投资  支付页面
    public function payment(){
        $data=\Request::all();
        //修改支付后 用户的剩余金额
        DB::table('user')->where('user_id','=',$data['user_id'])->update(['money'=>$data['new_money']]);
        //添加投资历史清单
        $re= DB::table('finance_detailed')->insert(['user_id'=>$data['user_id'],'fin_id'=>$data['fin_id'],'money'=>$data['money'],'time'=>time()]);
        DB::table('money_trend')->insert(['user_id'=>$data['user_id'],'money'=>$data['money'],'time'=>time(),'status'=>3]);
        //返回状态码
        $msg=array();
        if($re){
            $msg['code']=1;
            $msg['msg']="投资成功";
        }else{
            $msg['code']=0;
            $msg['msg']="投资失败";
        }
        exit(json_encode($msg));
    }
}
