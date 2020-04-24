<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 2020年中国最大电商城--友情链接管理</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>品牌管理<a style="float:right;" href="{{url('/weblist')}}" class="btn btn-success">列表</a></hr></h2><hr/></center>
	<!-- @if($errors->any())
	<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
	<li>{{ $error}}</li>
	@endforeach
	</ul>
	</div>
	@endif -->
<form action="{{url('/weblist/update/'.$weblist->web_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$weblist->web_name}}" name="web_name" id="firstname" 
				   placeholder="请输入网站名称">
			<b style="color:red">{{$errors->first('')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control"value="{{$weblist->web_url}}" name="web_url"  id="lastname" 
				   placeholder="请输入网站网址">
				   <b style="color:red">{{$errors->first('')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">连接类型</label>
		<div class="col-sm-10">
			<input type="radio"  name="web_link" checked >LOGO链接
			<input type="radio"  name="web_link">文字链接
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">图片logo</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="web_img" id="lastname" 
				   placeholder="请输入logo">
                   @if($weblist->web_img)<img src="{{env('UPLOADS_URL')}}{{$weblist->web_img}}" width=50>@endif
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站联系人</label>
		<div class="col-sm-10">
			<input type="text" class="form-control"  value="{{$weblist->web_tel}}" name="web_tel"  id="lastname" 
				   placeholder="请输入网站联系人">
				   <b style="color:red">{{$errors->first('')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="web_desc" id="lastname" 
				   placeholder="请输入网站描述">{{$weblist->web_desc}}</textarea>
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
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>