<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/DateTimePicker.css') }}">

    <title>@yield('title')</title>

</head>
<body>
    
    @yield('menu')
    @yield('body')
   
    <script src="{{ asset('js/app.js') }}"></script>

    @hasSection('javascript')
        <script src="{{ asset('js/task.js') }}"></script>
    @endif
    

</body>
</html>