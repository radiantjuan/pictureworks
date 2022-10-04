<!DOCTYPE HTML>
<html>
<head>
    @include('page-title')
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="{{asset('css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/noscript.css')}}"/>
</head>
<body class="is-preload">
<div id="wrapper">
    @include('navigation')
    @yield('content')
    @include('footer')
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
