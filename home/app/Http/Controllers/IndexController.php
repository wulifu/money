<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;  

class IndexController extends Controller
{
    public function index(){
    	$pros = DB::table('finance_project')->paginate(4);
        return view('index.index', ['pros' => $pros]);
    }
   
}
