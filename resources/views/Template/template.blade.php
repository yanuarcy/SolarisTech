@php
    $RouteSaatIni = Route::currentRouteName();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    {{-- <meta charset="utf-8"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <title></title> --}}
    @vite('resources/sass/app.scss')
    {{-- @vite('resources/sass/nav.scss') --}}
</head>
<body class="@if ($RouteSaatIni == 'CustProfile')
BgCustProfile
@endif">

    {{-- @include('Layouts.nav') --}}
    <div id="app">
        @yield('Content')
    </div>

    @vite('resources/js/app.js')
</body>
</html>
