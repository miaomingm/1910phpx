<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Goods;
use App\Category;
use App\Brand;
use Validator;
use Illuminate\Validation\Rule;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_name = request()->goods_name;
        $where=[];
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $cate_id = request()->cate_id;
        if($cate_id){
            $where[]=['goods.cate_id',$cate_id];
        }
        $brand_id = request()->brand_id;
        if($brand_id){
            $where[]=['goods.brand_id',$brand_id];
        }
        //商品分类
        $category =Category::all();
        $category = createTree($category);
        //品牌
        $brand = Brand::all();
        // DB::connection()->enabieQueryLog();
        $pageSize = config("app.PageSize");
        $goods=  Goods::select("goods.*","category.cate_name","brand.brand_name")
                    ->leftjoin("category","goods.cate_id","=","category.cate_id")
                    ->leftjoin("brand","goods.brand_id","=","brand.brand_id")
                    ->where($where)
                    ->paginate($pageSize);
                // $logs = DB::getQueryLog();
                // dump($logs);
                    $query = request()->all();
                    
                // dump($query);
                    return view('admin.goods.index',['goods'=>$goods,'category'=>$category,'brand'=>$brand,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =Category::all();
        $category = createTree($category);
        $brand = Brand::all();
        return view('admin.goods.create',['category'=>$category,'brand'=>$brand]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //排除接受
        $post = request()->except(['_token']);
        $validator = Validator::make($post,[
            'goods_name'=>'required|unique:goods|max:50|min:2',
            'cate_id'=>'required',
            'brand_id'=>'required',
            'goods_num'=>'required',
            'goods_price'=>'required',
            ],[
                'goods_name.required'=>'商品名称必填',
                'goods_name.unique'=>'商品名称已存在',
                'goods_name.max'=>'品牌名称在2位到50位之间',
                'goods_name.min'=>'品牌名称在2位到50位之间',
                'cate_id.required'=>'商品分类必填',
                'brand_id.required'=>'商品品牌必填',
                'goods_num.required'=>'商品库存必填',
                'goods_price.required'=>'商品单价必填',
         ]);
         if($validator->fails()){
             return redirect('goods/create')->withErrors($validator) ->withInput();
         }
        //文件上传主图
        if($request->hasFile('goods_img')){
            $post['goods_img'] =upload('goods_img');
        }
        //上传商品相册
        if(isset($post['goods_imgs'])){
            $imgs = MoreUpload('goods_imgs');
            
            $post['goods_imgs'] = implode('|',$imgs);
        }
        
        $res = Goods::insert($post);
        if($res){
            return redirect('/goods');
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
        $goods  = Goods::find($id);
        return view('admin.goods.edit',['goods'=>$goods]);
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
        $validator = Validator::make($post,[
            'goods_name'=>'required|unique:goods|max:50|min:2',
            'cate_id'=>'required',
            'brand_id'=>'required',
            'goods_num'=>'required',
            'goods_price'=>'required',
            ],[
                'goods_name.required'=>'商品名称必填',
                'goods_name.unique'=>'商品名称已存在',
                'goods_name.max'=>'品牌名称在2位到50位之间',
                'goods_name.min'=>'品牌名称在2位到50位之间',
                'cate_id.required'=>'商品分类必填',
                'brand_id.required'=>'商品品牌必填',
                'goods_num.required'=>'商品库存必填',
                'goods_price.required'=>'商品单价必填',
         ]);
         if($validator->fails()){
             return redirect('goods/create')->withErrors($validator) ->withInput();
         }
           //dd(123);
           if($request->hasFile('goods_img')){
            $post['goods_img'] =$this->upload('goods_img');
        }
        $res = DB::table('goods')->where('goods_id',$id)->update($post);
        if($res!==false){
            return redirect('/goods');
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
         //删除图片
         $goods_img = DB::table('goods')->where('goods_id',$id)->value('goods_img');

         if($goods_img){
             unlink(storage_path('app/'.$goods_img));
         }
 
         $res = DB::table('goods')->where('goods_id',$id)->delete();
         if($res){
             return redirect('/goods');
         }
    }
}
