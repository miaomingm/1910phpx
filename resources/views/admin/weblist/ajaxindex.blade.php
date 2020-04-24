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