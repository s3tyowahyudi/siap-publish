<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIAP</title>
    <meta name="csrf-token" content="{{ Session::token() }}">
    @yield('css')
</head>
<body class="no-skin pos-rel" data-spy="scroll" data-target="#menu">
    @yield('content')
    @yield('script')
</body>
</html>