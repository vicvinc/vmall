<table class="table table-hover">
    <thead>
        <tr>
            <th>图片</th>
            <th>名称</th>
            <th>排序</th>
            <th>类型</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($categories->items()))
            @foreach($categories->items() as $category)
                <tr>
                    <td>
                        <img class="category-img-url" src="{{$category->thumbnail}}"/>
                    </td>
                    <td>
                        {{$category->title}}
                    </td>

                    <td>
                        {{$category->sequence}}
                    </td>
                    <td>
                        {{$category->type}}
                    </td>
                    <td>
                        <a
                            href="{{url('admin/product/category/'.$category->uid.'/edit')}}"
                            class="btn btn-info edit-btn"
                            title="修改"
                        >
                            修改
                        </a>
                        <form
                            class="del-form"
                            action="{{url('admin/product/category/'.$category->uid)}}"
                            method="post"
                        >
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
                        <p>暂无分类数据</p>
                    </div>
                </td>
            <tr>
        @endif
    </tbody>
</table>
