<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Painel administrativo') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.vendor.css') }}" rel="stylesheet">
    @yield('styles')
    @toastr_css
</head>
<body>
    <div id="app">
        @yield('body-content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="{{ asset('js/admin.vendor.js') }}" defer></script>
    @yield('scripts')
    @jquery
    @toastr_js
    @toastr_render
</body>
</html>
