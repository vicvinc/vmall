<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>vMall登陆</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.png" mce_href="favicon.png" type="image/png">
    <link rel="shortcut icon" href="favicon.ico" mce_href="favicon.ico" type=”image/x-icon”>
    <link href="{{asset('css/normalize.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/icheck/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/signin.css')}}" rel="stylesheet">
</head>

<body class="bg-light text-center">
    <div class="animated fadeInDown">
        @yield('content')
    </div>

    <script src="{{asset('js/admin/global/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/admin/global/bootstrap.js')}}"></script>
    <script src="{{asset('js/admin/global/icheck.min.js')}}"></script>

    @yield('script')

</body>

</html>
