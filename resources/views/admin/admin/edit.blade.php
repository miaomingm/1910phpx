<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 2020年中国最大电商城--管理员管理</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>管理员管理<a style="float:right;" href="{{url('/admin')}}" class="btn btn-success">列表</a></hr></h2><hr/></center>
<form action="{{url('/admin/update/'.$admin->admin_id)}}" method="post" class="form-horizontal" role="form">
@csrf
<!-- {{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}"> -->
<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$admin->admin_name}}" name="admin_name" id="firstname" 
				   placeholder="请输入管理员名称">
			<b style="color:red">{{$errors->first('')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$admin->admin_tel}}" name="admin_tel"  id="lastname" 
				   placeholder="请输入手机号">
				   <b style="color:red">{{$errors->first('')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$admin->admin_email}}" name="admin_email" id="lastname" 
				   placeholder="请输入邮箱">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$admin->admin_pwd}}" name="admin_pwd" id="lastname" 
				   placeholder="请输入密码">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">确认密码</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$admin->admin_pwds}}" name="admin_pwds" id="lastname" 
				   placeholder="请输入密码">
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