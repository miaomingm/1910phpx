<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use App\Reg;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    public function index($id){
          //访问量
          $count =Redis::setnx('count_'.$id,1)?1:Redis::incr('count_'.$id);
          //dd($count);
        $goods = Goods::find($id);
        return view('index.goods',['goods'=>$goods,'count'=>$count]);
    }

    /**
     * 判断用户是否登录
     * 未登录 跳转到登录页面 登陆后返回次商品详情页
     * 
     * 登录
     *      判断用户是否登录
     *      1.判断商品库存是否大于购买数量 如果小于提示商品库存不足
     *      2.判断购物车内是否有此商品添加记录
     *      有购买数量相加 判断商品库存是否大于购买数量 如果小于 购买数量=最大库存
     * 否则更新购物列表此商品的购买数量
     *      无 添加入库
     * 
     */
    
    //加入购物车
    public function addcar(){
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
        $session=unserialize(session("user"));
        
        $user= $session['reg_id'];
        //dd($user);
        // $user = session("reg_name");
        if(!$user){
             showMsg('00001','未登录');
           //echo json_encode(['code'=>'00001','未登录']);
        }
        $goods = Goods::select('goods_id','goods_name','goods_img','goods_price','goods_num')->find($goods_id);
        
        if( $goods->goods_num < $buy_number){
            showMsg('00002','库存不足');
           // echo json_encode(['code'=>'00002','库存不足']);
        }
        $where=[
            'user_id'=>$user,
            'goods_id'=>$goods_id,
        ];
       $cart= Cart::where($where)->first();
        if($cart){
            //更新购买数量 
            $buy_number = $cart->buy_number+$buy_number;
            //判断库存<购买数量
            if($goods->goods_num<$buy_number){
                $buy_number = $goods->goods_num;
            }           
            //修改购物车表里的购买数量
            $res = Cart::where('cart_id',$cart->cart_id)->update(['buy_number'=>$buy_number]);
        }else{
            //添加购买数量
            $data = [
                'user_id'=>$user,
                'buy_number'=>$buy_number,
                'addtime'=>time(),
            ];
            
            $data = array_merge($data,$goods->toArray());
            // dd($data);
            unset($data['goods_num']);
            $res = Cart::create($data);
        }

            if($res!==false){
                showMsg('00000','成功');
               // echo json_encode(['code'=>'00000','成功']);
        }
    }
}
 