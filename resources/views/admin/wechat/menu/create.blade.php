@extends('layouts.content')

@section('card_body')

    <form action="{{url('admin/wechat/menu')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label>菜单排序：</label>
            <input
                class="form-control"
                name="sequence"
                type="number"
                placeholder="值越小越靠前显示,默认为0"
                autofocus
            >
        </div>
        <div class="form-group">
            <label>一级菜单：</label>
            <select name="parent_button" class="form-control">
                <option value="0" selected>无</option>
                @if(!empty($parent_menu))
                    @foreach($parent_menu as $menu)
                        <option value="{{$menu->uid}}">
                            {{$menu->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label>菜单名称：</label>
            <input name="name" type="text" class="form-control" placeholder="菜单名称必填" required>
        </div>
        <div class="form-group">
            <label>菜单类型：</label>
            <select name="type" class="form-control" id="menu-type-select">
                <option value="view">跳转视图</option>
                <option value="click">点击推事件</option>
                <option value="none" selected>无事件的一级菜单</option>
            </select>
        </div>
        <div class="form-group __hide__" id="menu-url">
            <label>关联链接：</label>
            <input name="url" type="text" class="form-control" placeholder="跳转视图菜单必填">
        </div>
        <div class="form-group __hide__" id="menu-key">
            <label>关联关键词：</label>
            <input name="key" type="text" class="form-control" placeholder="点击推时间菜单必填">
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
            
@endsection

@section('script')
    <script src="{{asset('js/admin/wechat/menuCreate.js')}}"></script>
@endsection
