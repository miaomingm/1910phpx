<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function logindo(Request $request){
        $admin = $request->except('_token');
        $adminuser = Admin::where('admin_name',$admin['admin_name'])->first();
        
        if(decrypt($adminuser->admin_pwd)!=$admin['admin_pwd']){
            return redirect('/login')->with('msg','用户名或密码不对');
        }

        //七天免登录
        if($admin['isrember']){
            //存入cookie
            Cookie::queue('adminuser',$adminuser,24*60*7);
        }
        session(['adminuser'=>$adminuser]);
        return redirect('/goods');
    }

    
}
