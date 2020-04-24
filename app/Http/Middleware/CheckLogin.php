<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session(['adminuser'=>null]);
        //判断用户是否登录
        $adminuser = session('adminuser');
        if(!$adminuser){

            //从cookie内取用户信息 如果有存入session
            $cookie_adminuser = request()->cookie('adminuser');
            // dd($cookie_adminuser);
            if($cookie_adminuser){
                session(['adminuser'=>$cookie_adminuser]);
            }else{
                return redirect('/login');
            }



            return redirect('/login');
        }
        return $next($request);
    }
}
