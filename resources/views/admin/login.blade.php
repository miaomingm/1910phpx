<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 2020年中国最大电商城--微商城后台登录</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<h2 align="center">微商城后台登录</h2>
    <b style="color:red">{{session('msg')}}</b>
<form action="{{url('/logindo')}}" method="post" class="form-horizontal" role="form">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
		<label for="firstname" class="col-sm-4 control-label">用户</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				   placeholder="请输入用户名称">
			
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">密码</label>
		<div class="col-sm-4">
			<input type="password" class="form-control" name="admin_pwd" id="lastname" 
				   placeholder="请输入密码">
				   
		</div>
    </div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-6">
		<div class="checkbox">
			<label>
			<input type="checkbox" name="isrember">七天免登录
			</label>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-6">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html>