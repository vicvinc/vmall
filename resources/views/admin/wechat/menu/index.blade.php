@extends('layouts.content')

@section('card_body')
    <h3>
        <a href="{{url('admin/wechat/menu/create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-btn fa-plus"></i> 新增菜单
        </a>
        <button id="push-menu-btn" class="btn btn-sm btn-success" type="button">
            <i class="fa fa-btn fa-send"></i> 生成菜单
        </button>
        <form id="push-menu-form" class="__hide__" method="post" action="{{url('admin/wechat/pushMenu')}}">
            {{csrf_field()}}
        </form>
    </h3>
    @include('_common.table.wechat_menu', ['menus' => $menus])
@endsection

@section('script')
    <script src="{{asset('js/admin/wechat/menuIndex.js')}}"></script>
@endsection
