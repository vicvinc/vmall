@extends('layouts.content')

@section('card_body')
    <h4>
        <a href="{{url('admin/product/category/create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-btn fa-plus"></i>新增
        </a>
    </h4>
    <div class="table-responsive">
        @include('_common.table.category', ['data' => $categories])
    </div>
    <nav class="text-center">
        {!! $categories->links() !!}
    </nav>
@endsection

@section('script')
    <script src="{{asset('js/admin/product/categoryIndex.js')}}"></script>
@endsection