<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//闭包路由
Route::get('/aa', function () {
    return '这是一个闭包路由';
});
//控制器方法路由
//返回试图
//Route::get('/index','IndexController@index');
Route::view('/index','index',['name'=>'小红']);
//举例post方式请求
Route::get('/user/add','IndexController@index');
Route::post('/user/doadd','IndexController@doadd')->name('doadd');

//必填参数
// Route::get('/goods/{id}', function ($id) {
//     return $id;
// });
Route::get('/goods/{id}','IndexController@good')->where('id','\d+');
Route::get('/goods/{id}/{name}','IndexController@goods')->where(['id'=>'\d+','name'=>'[a-zA-Z\x{4e00}-\x{9fa5}]{3,6}']);

// //可选参数
// Route::get('/show/{id?}',function($id=0){
//     return $id;
// });

Route::get('/show/{id?}','IndexController@show');
//混合参数
Route::get('/detail/{id}/{name?}','IndexController@detail');

Route::domain('admin.laravel.com')->group(function(){


    //品牌管理
    Route::prefix('/brand')->middleware('auth')->group(function(){
        // Route::get('/','Admin\BrandController@index');//列表展示
        //支持多种方式
        // Route::match(['get','post'],'/','Admin\BrandController@index');//列表展示
        Route::any('/','Admin\BrandController@index');//列表展示
        Route::get('create','Admin\BrandController@create');//添加
        Route::post('store','Admin\BrandController@store');//执行添加
        Route::get('edit/{id}','Admin\BrandController@edit');//编辑展示
        Route::post('update/{id}','Admin\BrandController@update');
        Route::get('destroy/{id}','Admin\BrandController@destroy');//编辑展示
    });
    //分类管理
    Route::prefix('/category')->middleware('auth')->group(function(){
        Route::get('/','Admin\CategoryController@index');//列表展示
        Route::get('create','Admin\CategoryController@create');//添加
        Route::post('store','Admin\CategoryController@store');//执行添加
        Route::get('edit/{id}','Admin\CategoryController@edit');//编辑展示
        Route::post('update/{id}','Admin\CategoryController@update');//编辑执行
        Route::get('destroy/{id}','Admin\CategoryController@destroy');//编辑展示
    });
    // Route::prefix('/goods')->middleware('islogin')->group(function(){
        Route::prefix('/goods')->middleware('auth')->group(function(){
        Route::get('/','Admin\GoodsController@index');//列表展示
        Route::get('create','Admin\GoodsController@create');//添加
        Route::post('store','Admin\GoodsController@store');//执行添加
        Route::get('edit/{id}','Admin\GoodsController@edit');//编辑展示
        Route::post('update/{id}','Admin\GoodsController@update');//编辑执行
        Route::get('destroy/{id}','Admin\GoodsController@destroy');//编辑展示
    });
    //管理员管理
    Route::prefix('/admin')->middleware('auth')->group(function(){
        Route::get('/','Admin\AdminController@index');//列表展示
        Route::get('create','Admin\AdminController@create');//添加
        Route::post('store','Admin\AdminController@store');//执行添加
        Route::get('edit/{id}','Admin\AdminController@edit');//编辑展示
        Route::post('update/{id}','Admin\AdminController@update');//编辑执行
        Route::get('destroy/{id}','Admin\AdminController@destroy');//编辑展示
    });
    //友情链接管理
    Route::prefix('/weblist')->middleware('auth')->group(function(){
        Route::get('/','Admin\WeblistController@index');//列表展示
        Route::get('create','Admin\WeblistController@create');//添加
        Route::post('store','Admin\WeblistController@store');//执行添加
        Route::get('edit/{id}','Admin\WeblistController@edit');//编辑展示
        Route::post('update/{id}','Admin\WeblistController@update');//编辑执行
        Route::get('destroy/{id}','Admin\WeblistController@destroy');//编辑展示
    });
    //新闻
    Route::prefix('/xinwen')->group(function(){
        Route::get('/','Admin\XinwenController@index');//列表展示
        Route::get('create','Admin\XinwenController@create');//添加
    });
    //登录
    Route::view('/login','admin.login');
    Route::post('/logindo','Admin\LoginController@logindo');

    //cookie应用
    Route::get('/setcookie','IndexController@setcookie');
    Route::get('/getcookie','IndexController@getcookie');


    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});
Route::domain('www.laravel.com')->group(function(){
    //前台
    Route::get('/','Index\IndexController@index')->name('shop.index');
    Route::get('/login','Index\LoginController@login');
    Route::get('/reg','Index\LoginController@reg');
    Route:: post('/login/regDo','Index\LoginController@regDo');
    Route:: post('/login/loginDo','Index\LoginController@loginDo');
    Route::get('/prolist','Index\ProlistController@prolist');
    
    Route::get('/pay','Index\PayController@pay');
    Route::get('/cartlist','Index\CartController@cartlist')->name('shop.cartlist');
    //发送手机号
    Route::post('/sendSms','Index\LoginController@sendSms');
    //发送邮箱
    Route::get('/sendEmail','Index\LoginController@sendEmail');
    
    Route::get('/goods/index/{id}','Index\GoodsController@index')->name('shop.goods');
    Route::get('/addcar','Index\GoodsController@addcar');
    Route::get('/test','Index\LoginController@test');
    Route::post('/address','Index\AddressController@address');
});