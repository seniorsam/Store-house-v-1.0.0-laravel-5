<?php namespace storeHouse\Http\Middleware;

use Closure;
use Auth;

class admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// if the user not admin
		if(Auth::user()->sthrule_id != 1){
			abort('404');
		}
		return $next($request);
	}

}
