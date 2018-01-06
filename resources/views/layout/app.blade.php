<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Customs Declaration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('ico/76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('ico/120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('ico/152.png') }}">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bundle.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/light.css') }}">
    <script src="{{ URL::asset('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ URL::asset('js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</head>

<body class="fixed-header linux desktop pace-done menu-unpinned menu-pin">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    
        <div class="page-container">
            <!--<div class="header">
                <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu" data-toggle="sidebar"></a>
                <div class="">
                    <div class="brand inline">
                        <a href="{{ url('/customs/welcome') }}"><img src="{{ URL::asset('img/logo.png') }}" alt="logo" data-src="{{ URL::asset('img/logo.png') }}" data-src-retina="{{ URL::asset('img/logo_2x.png') }}" width="78"
                            height="22"></a>
                    </div>
                </div>
            </div>!-->
            <div class="page-content-wrapper ">
                <div class="content" style="padding-left: 0px !important;">
                    @yield('content')
                </div>
            </div>
        </div>
    
    <script src="{{ URL::asset('js/vendors.min.js') }}"></script>
    <script src="{{ URL::asset('js/custom.min.js') }}"></script>
</body>

</html>