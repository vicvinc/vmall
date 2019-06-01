<table class="table table-hover">
    <thead>
        <tr>
            <th>图片</th>
            <th>跳转连接</th>
            <th>标题</th>
            <th>排序</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($banners->items()))
        @foreach($banners->items() as $banner)
            <tr>
                <td>
                    <img class="banner-img-url" alt="轮播图" src="{{$banner->thumbnail}}"/>
                </td>
                <td>
                    {{$banner->link}}
                </td>
                <td>
                    {{$banner->title}}
                </td>
                <td>
                    {{$banner->sequence}}
                </td>
                <td>
                    {{$banner->status}}
                </td>
                <td>
                    <a
                        title="修改"
                        class="btn btn-info edit-btn"
                        href="{{url('admin/shop/banner/'.$banner->uid.'/edit')}}"
                    >
                        修改
                    </a>
                    <form
                        action="{{url('admin/shop/banner/'.$banner->uid)}}"
                        method="post"
                        class="del-form"
                    >
                        <input type="hidden" name="_method" value="DELETE">
                        {{csrf_field()}}
                        <button title="删除" type="submit" class="btn btn-danger del-btn">
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
                    <p>还没有配置轮播数据，快去新增首页轮播图吧</p>
                </div>
            </td>
        <tr>
    @endif
    </tbody>
</table>
