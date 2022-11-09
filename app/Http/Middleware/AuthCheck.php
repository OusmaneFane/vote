<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthCheck
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
       
        if(!session()->has('PasseUser')){
            return redirect('/')->with('fail', 'Vous n\'êtes pas connecté !');
        }
       
       
        if($request->session()->has('PasseUser' && (url('posts/form') == $request->url() ||
        url('posts/inscrit') == $request->url() ) ) ){
           return back()->with('fail', 'Vous ne pouvez plus accéder à cette page');
        }

        return $next($request);
    }
}
