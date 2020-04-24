<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 一个简单的网页</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	

    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="{{url('/brand')}}">商品品牌</a></li>
        <li><a href="{{url('/category')}}">商品分类</a></li>
        <li class="active"><a href="{{url('/goods')}}">商品管理</a></li>
		<li><a href="{{url('/admin')}}">管理员管理</a></li>
    <li><a href="{{url('/weblist')}}">友情链接</a></li>
      </ul>
    </div>

    <div class="navbar-header" style="float:right;color:#fff">

        欢迎【】登录
    </div>
  </div>
</nav>
<center><h2>商品管理 <a style="float:right;" href="{{url('/goods/create')}}" class="btn btn-success">添加</a></hr></h2></center>
<form>
  <select name="cate_id">
  <option value="">请选择分类</option>
  @foreach($category as $v)
				<option value="{{$v->cate_id}}" @if(isset($query['cate_id']) && $v->cate_id==$query['cate_id']) selected="selected"@endif>{{$v->cate_name}}</option>
	@endforeach
  </select>
  <select name="brand_id">
  <option value="">请选择品牌</option>
  @foreach($brand as $v)
				<option value="{{$v->brand_id}}" @if(isset($query['brand_id']) && $v->brand_id==$query['brand_id']) selected="selected"@endif>{{$v->brand_name}}</option>
	@endforeach
  </select>
  <input type="text" name="goods_name" value="{{isset($query['goods_name'])}}" placeholder="请输入商品名称">
  <button>搜索</button>
</form>
<table class="table table-striped">
	
	<thead>
		<tr>
			<th>商品id</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>商品分类</th>
      <th>商品品牌</th>
      <th>商品价格</th>
      <th>商品库存</th>
      <th>是否显示</th>
      <th>是否新品</th>
      <th>是否精品</th>
      <th>商品主图</th>
      <th>商品相册</th>
      <th>商品详情</th>
			<td>操作</td>
		</tr>
	</thead>
    @foreach($goods as $v)
	<tbody>
        <tr>
        <td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_number}}</td>
            <td>{{$v->cate_id}}</td>
            <td>{{$v->brand_id}}</td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_num}}</td>
            <td>{{$v->is_show?'√':'×'}}</td>
            <td>{{$v->is_new?'√':'×'}}</td>
            <td>{{$v->is_best?'√':'×'}}</td>
            <td>@if($v->goods_img)<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width=50>@endif</td>
            <td>
            @if(isset($v->goods_imgs))
            @php $imgs = explode('|',$v->goods_imgs);@endphp
            @foreach($imgs as $img)
            <img width="50px" height="50px" src="{{env('UPLOADS_URL')}}{{$img}}">
            @endforeach
            @endif
            </td>
            <td>{{$v->goods_desc}}</td>
			<td><a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-success">
			编辑</a> | <a  href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">
			删除</a></td>
		</tr>
        @endforeach
        <tr><td colspan="14">{{$goods->appends($query)->links()}}</td></tr>
	</tbody>
</table>

</body>
</html>