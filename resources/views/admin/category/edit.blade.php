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
<center><h2>分类管理<a style="float:right;" href="{{url('/category')}}" class="btn btn-success">列表</a></hr></h2><hr/></center>
<form action="{{url('/category/update/'.$category->cate_id)}}" method="post" class="form-horizontal" role="form">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$category->cate_name}}" name="cate_name" id="firstname" 
				   placeholder="请输入商品分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control"  name="cate_desc"  id="lastname" 
				   placeholder="请输入分类描述">{{$category->cate_desc}}</textarea>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否导航栏展示</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$category->is_show_nav}}" name="is_show_nav" id="lastname" 
				   placeholder="请输入导航栏展示">
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