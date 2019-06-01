<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>vMall后台管理</title>
    <link href="{{asset('css/normalize.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashbord.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/iconfont.css')}}" rel="stylesheet">
</head>

  <body>
    @include('notice.index')
    @include('_common.nav.headbar')
    <div class="container-fluid">
        @include('_common.nav.sidebar')
        <div class="row">
            @yield('content')
        </div>
    </div>
    {{--  <div class="footer">
        <div class="pull-right">
            <strong>Copyright</strong>&copy; 2016-2018
        </div>
    </div>  --}}
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="{{asset('js/admin/global/jquery-slim.js')}}"></script>
    <script src="{{asset('js/admin/global/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/admin/global/popper.js')}}"></script>
    <script src="{{asset('js/admin/global/bootstrap.js')}}"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <script>
        window._TOKEN_ = {_token: '{{csrf_token()}}'};
        window._PUT_ = {_method: 'PUT'};
        window._DELETE_ = {_method: 'DELETE'};
    </script>
    
    @yield('script')

  </body>
</html>
