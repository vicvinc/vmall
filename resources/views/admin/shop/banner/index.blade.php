@extends('layouts.content')

@section('card_body')
    <a href="{{url('admin/shop/banner/create')}}" class="btn btn-sm btn-primary">
        <i class="fa fa-btn fa-plus"></i>新增
    </a>
    @include('_common.table.carousel', ['banners' => $banners])
    <nav class="text-center">
        {!! $banners->links() !!}
    </nav>
@endsection
