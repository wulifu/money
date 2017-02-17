<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
header("content-type:text/html;charset=utf-8");
class ProjectController extends Controller
{
    public function index(){
        $res=DB::table('finance_project')->select('fin_id','pro_name','yield','money','term')->paginate(4);
        $sum=$res->lastPage();
        return view('project.index',['res'=>$res,'sum'=>$sum]);
    }

    //投资项目介绍
    public function details(){
        $fin_id=\Request::get('fin_id');
        $res=DB::table('finance_project')->where('fin_id','=',$fin_id)->get();
        $array=DB::table('finance_detailed')->where('fin_id','=',$fin_id)->get();
        $phones=array();
        $money=0;
        foreach($array as $key=>$val){
            $money+=$val->money;
            $arr=DB::table('user')->where('user_id','=',$val->user_id)->select('phone')->get();
            $arr=json_encode($arr);
            $arr=json_decode($arr,true);
            $phone=$arr[0]['phone'];
            $phones[$key]=substr($phone,0,3)."****".substr($phone,-4);
        }
        return view('project.details',['res'=>$res,'array'=>$array,'phone'=>$phones,'money'=>$money]);
    }
}
