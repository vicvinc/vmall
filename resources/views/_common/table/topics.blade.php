<table class="table table-hover">
    <thead>
        <tr>
            <th>图片</th>
            <th>标题</th>
            <th>排序</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($topics->items()))
            @foreach($topics->items() as $topic)
                <tr>
                    <td>
                        <img class="topic-img-url" src="{{$topic->thumbnail}}"/>
                    </td>
                    <td>
                        {{$topic->title}}
                    </td>
                    <td>
                        {{$topic->sequence}}
                    </td>
                    <td>
                        {{$topic->status}}
                    </td>
                    <td>
                        <a 
                            class="btn btn-info edit-btn"
                            href="{{url('admin/product/topic/'.$topic->uid.'/edit')}}"
                            title="修改"
                        >
                            修改
                        </a>
                        <form action="{{url('admin/product/topic/'.$topic->uid)}}" method="post" class="del-form">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button title="删除" type="submit" class="btn btn-danger del-btn">删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">
                    <div class="no-record">
                        <i class="icon icon-inbox"></i>
                        <p>暂无专题数据</p>
                    </div>
                </td>
            <tr>
        @endif
    </tbody>
</table>