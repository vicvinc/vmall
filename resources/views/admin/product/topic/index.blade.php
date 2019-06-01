@extends('layouts.content')

@section('card_body')
    <h4>
        <a href="{{url('admin/product/topic/create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-btn fa-plus"></i>新增
        </a>
    </h4>
    <div class="table-resonsive"> 
        @include('_common.table.topics', ['data' => $topics])
    </div>
    <nav class="text-center">
        {!! $topics->links() !!}
    </nav>
@endsection
