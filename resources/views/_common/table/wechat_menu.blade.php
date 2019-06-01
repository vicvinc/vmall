<table class="table table-hover">
    <thead>
        <tr>
            <th class="text-left">菜单名称</th>
            <th>类型</th>
            <th>关联关键词</th>
            <th class="text-left limit-width">关联链接</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($menus))
            @foreach($menus as $menu)
                <tr>
                    <td class="text-left">
                        {{$menu->name}}
                    </td>
                    <td>
                        @if($menu->type == '跳转链接')
                            跳转链接
                        @elseif($menu->type == '点击事件')
                            点击事件
                        @else
                            一级菜单
                        @endif
                    </td>
                    <td>{{$menu->key}}</td>
                    <td title="{{$menu->url}}" class="limit-width text-left fn-text-overflow">
                        {{$menu->url}}
                    </td>
                    <td>{{$menu->sequence}}</td>
                    <td>
                        <a
                            href="{{url('admin/wechat/menu/'.$menu->uid.'/edit')}}"
                            class="btn btn-info edit-btn"
                        >
                            修改
                        </a>
                        <form
                            class="del-form"
                            action="{{url('admin/wechat/menu/'.$menu->uid)}}"
                            method="post"
                        >
                        
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}

                            <button 
                                title="若为一级菜单，将会同时删除所属全部二级菜单" 
                                type="submit"
                                class="btn btn-danger del-btn"
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
                        <p>暂无配置的菜单信息</p>
                    </div>
                </td>
            <tr>
        @endif
    </tbody>
</table>