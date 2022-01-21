<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIAP</title>
    <meta name="csrf-token" content="{{ Session::token() }}">
    <style type="text/css">
        .error{
			color: red;
		}
        .bayangan{
            -webkit-box-shadow: 0px 4px 8px 0px rgba(0,0,0,0.54);
            -moz-box-shadow: 0px 4px 8px 0px rgba(0,0,0,0.54);
            box-shadow: 0px 4px 8px 0px rgba(0,0,0,0.54);
        }
    </style>
    @yield('css')
</head>
<body class="no-skin pos-rel" data-spy="scroll" data-target="#menu">
    @yield('content')
    @yield('script')
</body>
</html>