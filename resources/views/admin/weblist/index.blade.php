<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 一个简单的网页</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
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
        <li><a href="{{url('/goods')}}">商品管理</a></li>
		<li><a href="{{url('/admin')}}">管理员管理</a></li>
		<li class="active"><a href="{{url('/weblist')}}">友情链接</a></li>
      </ul>
    </div>
  </div>
</nav>
<center><h2>品牌管理 <a style="float:right;" href="{{url('/weblist/create')}}" class="btn btn-success">添加</a></hr></h2></center>
<form>
	<input type="text" name="web_name" value="{{$web_name}}" placeholder="请输入网站名称关键字">
	<button>搜索</button>
	</form>
<table class="table table-striped">
	<caption></caption>
	<thead>
		<tr>
			<th>网站id</th>
			<th>网站名称</th>
			<th>网站网址</th>
			<th>链接类型</th>
			<th>图片Logo</th>
			<td>网站联系人</td>
            <td>网站描述</td>
            <td>是否显示</td>
            <td>操作</td>
		</tr>
	</thead>
	<tbody>
	@foreach($weblist as $v)
		<tr web_id="{{$v->web_id}}">
			<td>{{$v->web_id}}</td>
			<td>{{$v->web_name}}</td>
			<td>{{$v->web_url}}</td>
            <td>{{$v->web_link}}</td>
			<td>@if($v->web_img)<img src="{{env('UPLOADS_URL')}}{{$v->web_img}}" width=50>@endif</td>
			<td>{{$v->web_tel}}</td>
            <td>{{$v->web_desc}}</td>
            <td>{{$v->is_show?'√':'×'}}</td>
			<td><a href="{{url('/weblist/edit/'.$v->web_id)}}" class="btn btn-success">
			编辑</a> | <a  href="{{url('/weblist/destroy/'.$v->web_id)}}" class="btn btn-danger del">
			删除</a></td>
		</tr>
		@endforeach
		<tr><td colspan="9">{{$weblist->appends(['web_name'=>$web_name])->links()}}</td></tr>
	</tbody>
</table>

<script>
    //加载页面
    $(document).ready(function(){
        //增加点击事件
        $(".del").click(function(){
            //获取删除按钮
            var _this=$(this);
            //console.log(_this)
            //获取祖先级节点 parents
            var id=_this.parents("tr").attr("web_id");
            if(window.confirm('是否确认删除')){
           location.href="{:url('weblist/destroy')}?web_id="+web_id;
            }
        })
        //无刷新分页
		// $('.page-item a').click(function(){
			 $(document).on('click','.page-item a',function(){
			var url = $(this).attr('href');
			//第一中
			// $.get(url,function(result){
			// 	$('tbody').html(result);
			// });
			//第二中
			$.ajaxSetup({ 
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} 
			});
			$.get(url,function(result){
				$('tbody').html(result);
			})
			return false;
		})
        })
        
        </script>
</body>
</html>