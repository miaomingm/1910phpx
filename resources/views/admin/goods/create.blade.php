<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 2020年中国最大电商城--商品管理</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>品牌管理<a style="float:right;" href="{{url('/goods')}}" class="btn btn-success">列表</a></hr></h2><hr/></center>
	<!-- @if($errors->any())
	<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
	<li>{{ $error}}</li>
	@endforeach
	</ul>
	</div>
	@endif -->
<form action="{{url('/goods/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_name" id="firstname" 
				   placeholder="请输入品牌名称">
			<b style="color:red">{{$errors->first('goods_name')}}</b>
		</div>
    </div>
    
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_number"  id="lastname" 
				   placeholder="请输入商品货号">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-3">
		<select class="form-control" name="cate_id">
				<option value="0">请选择父级分类</option>
				@foreach($category as $v)
				<option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-3">
		<select class="form-control" name="brand_id">
				<option value="0">请选择...</option>
				@foreach($brand as $v)
				<option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
				@endforeach
				<b style="color:red">{{$errors->first('brand_id')}}</b>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_price"  id="lastname" 
				   placeholder="请输入商品价格">
				   <b style="color:red">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_num"  id="lastname" 
				   placeholder="请输入商品库存">
				   <b style="color:red">{{$errors->first('goods_num')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_show" value="1" checked>显示
			<input type="radio"  name="is_show" value="2" >不显示
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">首页是否幻灯片显示</label>
		<div class="col-sm-8">
            <input type="radio" name="is_slide" value="1">是
            <input type="radio" name="is_slide" value="2" checked>否
		</div>
  </div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_new" value="1" checked>是
			<input type="radio"  name="is_new" value="2" >不是
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_best" value="1" checked>是
			<input type="radio"  name="is_show" value="2" >不是
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="goods_img" id="lastname" 
				   placeholder="请输入商品主图">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" multiple="multiple" class="form-control" name="goods_imgs[]" id="lastname" 
				   placeholder="请输入商品相册">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="goods_desc" id="lastname" 
				   placeholder="请输入品牌描述"></textarea>
		</div>
    </div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>