@extends('layouts.dashbord')

@section('content')
    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">
        @include('_common.nav.content_head')
        @yield('card_body')
    </main>
@endsection
