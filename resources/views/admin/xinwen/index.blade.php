<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<form>
	<input type="text" name="x_name" value="{{$x_name}}" placeholder="请输入名称关键字">
	<button>搜索</button>
	</form>
<body>
        <table >
            <tr>
                <td>新闻id</td>
                <td>新闻名称</td>
                <td>价格</td>
                <td>描述</td>
                <td>库存</td>
                <td>操作</td>
            </tr>
            @foreach($xinwen as $v)
            <tr>
                <td>{{$v->x_id}}</td>
                <td>{{$v->x_name}}</td>
                <td>{{$v->x_price}}</td>
                <td>{{$v->x_desc}}</td>
                <td>{{$v->x_num}}</td>
                <td><a href="{{url('/xinwen/edit/'.$v->x_id)}}" class="btn btn-success">
			编辑</a> | <a  href="{{url('/xinwen/destroy/'.$v->x_id)}}" class="btn btn-danger">
			删除</a></td>
            </tr>
            @endforeach
            <tr><td colspan="6">{{$xinwen->appends(['x_name'=>$x_name])->links()}}</td></tr>
        </table>
    </form>
</body>
</html>
<script>
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
			$.post(url,function(result){
				$('tbody').html(result);
			})
			return false;
		})