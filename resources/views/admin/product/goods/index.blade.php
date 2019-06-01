@extends('layouts.content')

@section('card_body')
    <h4>
        <a href="{{url('admin/product/goods/create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-btn fa-plus"></i>新增
        </a>
        <a href="{{url('admin/product/goods')}}" class="btn btn-sm btn-success">全部商品</a>
    </h4>
    <div class="row tree-container">
        {{--  category list  --}}
        <div class="col-md-2 col-sm-2 col-xs-12">
            @if(!empty($categories))
                <ul class="navbar-nav navbar-sidenav" id="cateList">
                    @foreach($categories as $cate)
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                            <a
                                class="nav-link nav-link-collapse collapsed"
                                data-toggle="collapse"
                                href="#{{ $cate->title }}"
                                data-parent="#cateList"
                            >
                                <i class="fa fa-fw fa-file"></i>
                                <span class="nav-link-text">
                                    {{ $cate->title }}
                                </span>
                            </a>
                            @if($cate->children)
                                <ul class="sidenav-second-level collapse" id="{{ $cate->title }}">
                                    @foreach($cate->children as $child)
                                        <li class="list-group-item">
                                            <a
                                                href="javascript:void(0);"
                                                class="cate-item"
                                                data-cate="{{ $child->uid }}"
                                            >
                                                <i class="fa fa-fw fa-plus"></i>
                                                {{ $child->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <ul class="navbar-nav navbar-sidenav">
                    <li class="nav-item">
                        暂无分类数据
                    </li>
                </ul>
            @endif
        </div>
        {{--  goods list  --}}
        <div id="goods-list" class="col-md-10 col-sm-10 col-xs-12 table-responsive">
            @include('_common.table.goods', ['data' => $data])
            <nav class="text-center">
                {!! $data->links() !!}
            </nav>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/admin/product/commodityIndex.js')}}"></script>
@endsection
