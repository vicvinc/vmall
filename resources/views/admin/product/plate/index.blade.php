@extends('layouts.content')

@section('card_body')
    <h4>
        <a href="{{url('admin/product/plate/create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-btn fa-plus"></i>新增
        </a>
    </h4>
    <div class="table-responsive">
        @include('_common.table.plate', ['data' => $plates])
    </div>
    <nav class="text-center">
        {!! $plates->links() !!}
    </nav>
@endsection
