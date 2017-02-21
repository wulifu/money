<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
class Common
{
	public function handle($request, Closure $next)
	{
		$phone = session('user');
		if(empty($phone) || !isset($phone))
		{
			return redirect('register');
		}
		return $next($request);
	}
}