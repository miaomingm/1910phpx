<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Weblist;
use Validator;
use Illuminate\Validation\Rule;
class WeblistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $web_name = request()->web_name;
        $where=[];
        if($web_name){
            $where[] =['web_name','like',"%$web_name%"];
        }
        $pageSize = config('app.pageSize');
        $weblist= Weblist::orderBy('web_id','desc')->where($where)->paginate($pageSize);
        if(request()->ajax()){
            return view('admin.weblist.ajaxindex',['weblist'=>$weblist,'web_name'=>$weblist]);
        }
        
        return view('admin.weblist.index',['weblist'=>$weblist,'web_name'=>$web_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weblist.create');
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
            'web_name'=>'required|unique:weblist|max:50|min:2',
            'web_url'=>'required',
            'web_url' => array('regex:/(http?|ftp?):\/\/(www)\.([^\.\/]+)\.(com|cn)?/i'),
            ],[
                'web_name.required'=>'网站名称必填',
                'web_name.unique'=>'网站名称已存在',
                'web_url.unique'=>'网站网站不能为空',
                'web_url.regex' => '链接格式不正确,正确格式为http://www.***.com或者http://www.***.cn',
         ]);
         if($validator->fails()){
             return redirect('weblist/create')->withErrors($validator) ->withInput();
         }
        //文件上传
        if($request->hasFile('web_img')){
            $post['web_img'] =$this->upload('web_img');
        }
        $res = Weblist::insert($post);
        if($res){
            return redirect('/weblist');
        }
    }
    //文件上传
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            //接受文件上传
            $file = request()->$filename;
            //实现上传
            $path = $file->store('uploads');
            return $path;
        }
        exit('上传文件出错');
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
        $weblist = DB::table('weblist')->where('web_id',$id)->first();
        return view('admin.weblist.edit',['weblist'=>$weblist]);
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
        $post = $request->except('_token');

        if($request->hasFile('web_img')){
            $post['web_img'] =$this->upload('web_img');
        }
        $res = DB::table('weblist')->where('web_img',$id)->update($post);
        if($res!==false){
            return redirect('/weblist');
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
        $res = DB::table('weblist')->where('web_id',$id)->delete();
        if($res){
            return redirect('/weblist');
        }
    
    }
}
