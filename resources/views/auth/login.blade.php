@extends('layouts.auth')

@section('content')
    @include('_common.form.login')
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green'
            });
        });
    </script>
@endsection
