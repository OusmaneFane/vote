<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userInfo = DB::table('admins')
      ->where('id', $request->session()->get('PasseUser'))
      ->first();
        // dd($userInfo->user_type == 'Administrator');
        if(!empty($userInfo) && $userInfo->user_type == 'Administrator'){
            return $next($request);
            } else {
                abort(401);
           }
    }
}
