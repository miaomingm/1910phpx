<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Xinwen;
use Illuminate\Support\Facades\Cache;
class XinwenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Cache::get('slide');
       // dump($slide);
        if(!$slide){
            //echo  "DB==";
            //首页幻灯片
            // $slide=Goods::getIndexSlide();
            //dd($slide);
            Cache::put('slide',$slide,60);
        }
        $x_name = request()->x_name;
        $where=[];
        if($x_name){
            $where[] =['x_name','like',"%$x_name%"];
        }
        $pageSize = config('app.pageSize');
        $xinwen= Xinwen::orderBy('x_id','desc')->where($where)->paginate(2);
        if(request()->ajax()){
            return view('admin.xinwen.ajaxindex',['xinwen'=>$xinwen,'x_name'=>$brand]);
        }
        return view('admin.xinwen.index',['xinwen'=>$xinwen,'x_name'=>$x_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.xinwen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
