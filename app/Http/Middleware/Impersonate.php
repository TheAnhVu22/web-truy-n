<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Session;
class Impersonate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // chuyển quyền nhanh
        // kiểm tra session impersonate có không
        if(Session()->has('impersonate')){
           // session('impersonate') : lưu id của người dùng được click
            // xử lý chuyển hướng 
            Auth::onceUsingId(session('impersonate'));
        }
        return $next($request);
    }
}
