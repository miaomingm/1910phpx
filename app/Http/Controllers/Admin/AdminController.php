<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Admin;
use Validator;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin= Admin::orderBy('admin_id','desc')->get();
        return view('admin.admin.index',['admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //排除接受
        $post = request()->except(['_token']);
        $validator = Validator::make($post,[
            'admin_name'=>'required|unique:admin|max:50|min:2',
            'admin_tel'=>'required',
            'admin_email'=>'required',
            'admin_pwd'=>'required',
            'admin_pwds'=>'required',
            ],[
                'admin_name.required'=>'管理员名称必填',
                'admin_name.unique'=>'管理员名称已存在',
                'admin_name.max'=>'管理员名称最大18位',
                'admin_tel.required'=>'手机号必填',
                'admin_email.required'=>'邮箱必填',
                'admin_pwd.required'=>'密码必填',
                'admin_pwds.required'=>'管理员密码必须与密码一样',
         ]);
         if($validator->fails()){
             return redirect('admin/create')->withErrors($validator) ->withInput();
         }
        $post['admin_time']=time();
        $post['admin_pwd'] =encrypt($post['admin_pwd']);
        unset($post['admin_pwds']);
        $res = Admin::insert($post);
        if($res){
            return redirect('/admin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // dd($id);
         $admin  = Admin::find($id);
         return view('admin.admin.edit',['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = request()->except(['_token']);
         
        $res = DB::table('admin')->where('admin_id',$id)->update($post);
        if($res!==false){
            return redirect('/admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('admin')->where('admin_id',$id)->delete();
        if($res){
            return redirect('/admin');
        }
    }
}
