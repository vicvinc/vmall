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
        @if(!empty($plates->items()))
            @foreach($plates->items() as $plate)
                <tr>
                    <td>
                        <img class="plate-img-url" src="{{$plate->thumbnail}}"/>
                    </td>
                    <td>
                        {{$plate->title}}
                    </td>
                    <td>
                        {{$plate->sequence}}
                    </td>
                    <td>
                        {{$plate->status}}
                    </td>
                    <td>
                        <a
                            href="{{url('admin/product/plate/'.$plate->uid.'/edit')}}"
                            class="btn btn-info edit-btn"
                            title="修改"
                        >
                            修改
                        </a>
                        <form
                            class="del-form"
                            action="{{url('admin/product/plate/'.$plate->uid)}}"
                            method="post"
                        >
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger del-btn">删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">
                    <div class="no-record">
                        <i class="icon icon-inbox"></i>
                        <p>暂无板块信息</p>
                    </div>
                </td>
            <tr>
        @endif
    </tbody>
</table>
