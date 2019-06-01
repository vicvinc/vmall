<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $shopConfig->name }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <meta name="app-mobile-web-app-capable" content="yes">
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $shopConfig->seo_describe }}">
    <meta name="keywords" content="{{ $shopConfig->seo_key_words }}">
    
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/png">
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type=”image/x-icon”>

    <link href="{{asset('css/normalize.css')}}" rel="stylesheet">
    <link href="{{asset('css/mall.css')}}" rel="stylesheet">
    <script>
        window.csrfToken = "<?php echo csrf_token(); ?>";
    </script>
</head>
<body>
<div class="app-root" id="app"></div>

<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config(<?php echo $jsConfig; ?>);
    wx.ready(function() {
        wx.onMenuShareAppMessage({
            title: "{{ $shopConfig->name }}",
            desc: "{{ $shopConfig['seo_describe']}}",
            link: 'http://njht.sc2yun.com/mall',
            imgUrl: '{{ asset('images/logo/logo.jpg') }}',
            type: 'link',
        });
        wx.onMenuShareTimeline({
            title: "{{ $shopConfig->name }}",
            desc: "{{ $shopConfig->seo_describe }}",
            link: 'http://njht.sc2yun.com/mall',
            imgUrl: '{{ asset('images/logo/logo.jpg') }}',
        });
    });
</script>

<script src="{{ asset('js/mall/manifest.js') }}"></script>
<script src="{{ asset('js/mall/vendor.js') }}"></script>
<script src="{{ asset('js/mall/index.js') }}"></script>

</body>
</html>
