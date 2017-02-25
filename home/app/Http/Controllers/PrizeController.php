<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use App\Prize;

use Symfony\Component\HttpFoundation\Session\Session;
class PrizeController extends Controller
{
	/**
	 * 抽奖页面
	 * @return [type] [description]
	 */
	public function index()
	{
		/* 查询是否允许参与 */
		$user_id = session('user_id');
		$res = DB::table('user')->select('username','money')->where('user_id',$user_id)->first();
		$a = json_encode($res);
		$res = json_decode($a,true);
		if(isset($res['username']) && isset($res['money']) && $res['money'] >5000)
		{
			/* 查询最新开奖时间 */
			$user = new Prize();
	        $result = $user->where('user_id',$user_id)->get()->toArray();
	        $time = [];
	        foreach ($result as $key => $value) {
	        	$time[] = $value['time'];
	        }
	        sort($time);
	        $last_time = array_pop($time);
	        $now_time = time();
	        $poor = $now_time-$last_time;   

			if($poor>60*60*24)
	        {
				return view('prize.index');
			}
			else{
				return redirect('/');
			}

		}
		else
		{
			return redirect('/');
		}
	}


	public function prizeadd(Request $request)
	{
		$user_id = session('user_id');
    	$item = $request->input('item');
		$prize = '';
		switch ($item) {
			case '1':
				$prize = 888;
				break;
			case '2':
				$prize = 388;
				break;
			case '3':
				$prize = 188;
				break;
			case '4':
				$prize = 88;
				break;
			case '5':
				$prize = 8;
				break;
		}

		/* 修改用户余额 */
		$info = DB::table('user')->where('user_id',$user_id)->first();
		$money = $info['money'] + $prize;
		$re = DB::table('user')->where('user_id',$user_id)->increment('money',$money);
		/* 入中奖纪录表 */
		$prize = new Prize();
		$prize->user_id=$user_id;
		$prize->prize_size=$prize;
		$prize->time=time();
		$prize->save();
	}


}