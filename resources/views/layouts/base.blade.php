<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    @yield('title')
            <!-- Fonts -->
    <link rel="stylesheet" href="{{URL::to('css/font-awesome.min.css')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{URL::to('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/pnotify.custom.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/jquery.dataTables.min.css')}}">
    @yield('style')
    <script src="{{URL::to('js/jquery.min.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::to('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('js/pnotify.custom.min.js')}}"></script>
    @yield('script')
</head>
<body>
@include('includes.header')
<div class="container">
    @yield('content')
</div>
</body>
</html>