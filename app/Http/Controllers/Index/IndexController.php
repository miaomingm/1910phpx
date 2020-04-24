<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){

        // Redis::del('slide');
        $slide = Redis::get('slide');
        //dump($slide);die;
        // $slide = Cache::get('slide');
        // dump($slide);
        if(!$slide){
            //echo  "DB==";
            //首页幻灯片
            $slide=Goods::getIndexSlide();
            
            // Cache::put('slide',$slide,60);
            $slide = serialize($slide);
            Redis::setex('slide',60,$slide);
            //$aa=Redis::incr($slide);
        }
        //print_r($aa);
         $slide = unserialize($slide);
        
       
        return view("index.index",['slide'=>$slide]);
    }
}
