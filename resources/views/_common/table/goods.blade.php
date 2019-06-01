<table class="table table-hover">
    <thead>
        <tr>
            <th>图片</th>
            <th>名称</th>
            <th>价格</th>
            <th>库存</th>
            <th>已售</th>
            <th>状态</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($data->items()))
            @foreach($data->items() as $goods)
                <tr>
                    <td>
                        <img class="commodity-img-url" src="{{$goods->thumbnail}}">
                    </td>
                    <td>{{$goods->name}}</td>
                    <td>{{$goods->price}}¥</td>
                    <td>{{$goods->stock}}</td>
                    <td>{{$goods->sales}}</td>
                    <td>{{$goods->status}}</td>
                    <td>{{$goods->sequence}}</td>
                    <td>
                        <a 
                            href="{{url('admin/product/goods/'.$goods->uid.'/edit')}}"
                            class="btn btn-sm btn-info edit-btn"
                            title="修改"
                        >
                            修改
                        </a>
                        <form 
                            action="{{url('admin/product/goods/'.$goods->uid)}}"
                            class="del-form"
                            method="post"
                        >
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button
                                class="btn btn-sm btn-danger del-btn"
                                type="submit" 
                            >
                                删除
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">
                    <div class="no-record">
                        <i class="icon icon-inbox"></i>
                        <p>暂无商品信息</p>
                    </div>
                </td>
            <tr>
        @endif
    </tbody>
</table>
