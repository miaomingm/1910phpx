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