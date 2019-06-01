@extends('layouts.auth')

@section('content')
    <div class="jumbotron" style="width: 400px">
        <h4 class="display-4">注册</h4>
            <p class="lead">
                对不起，注册暂未开放
                <i class="fa fa-fw fa-shield"></i>
            </p>
        <hr class="my-4">
        <p>如有其他问题请联系管理员。</p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="/login" role="button">返回登陆</a>
        </p>
    </div>
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
