@extends('layouts.content')

@section('card_body')
    @include('_common.table.follower', ['data' => $data])
    <nav class="text-center">
        {!! $data->links() !!}
    </nav>
@endsection
