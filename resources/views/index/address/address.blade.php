@extends("layouts.shop")
     @section("title",'收货地址添加')
     @section('content')
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/address/store')}}" method="post" class="form-horizontal" role="form">
     @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="address_name" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" name="address_detail" placeholder="详细地址" /></div>
       <div class="lrList">
        <select name="province">
         <option>省份/直辖市</option>
        </select>
       </div>
       <div class="lrList">
        <select name="city">
         <option>区县</option>
        </select>
       </div>
       <div class="lrList">
        <select name="area">
         <option>详细地址</option>
        </select>
       </div>
       <div class="lrList"><input type="text" name="address_tel" placeholder="手机" /></div>
       <div class="lrList2"><input type="text" name="is_default" placeholder="设为默认地址" /> <button>设为默认</button></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="保存" />
      </div>
     </form><!--reg-login/-->
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl class="ftnavCur">
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    @endsection