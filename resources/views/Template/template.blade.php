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

    <title>{{ $Tittle }}</title>
    {{-- <title></title> --}}
    @vite('resources/sass/app.scss')
    {{-- @vite('resources/sass/nav.scss') --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
</head>
<body class="
    @if ( $RouteSaatIni == 'CustProfile' ) BgCustProfile

    @elseif ( $RouteSaatIni == 'AboutUs' ) BgAboutUs

    @elseif ( $RouteSaatIni == 'HistoryOrder' ) BgCustProfile

    @endif
">

    {{-- @include('Layouts.nav') --}}
    <div id="app">

        @yield('Content')
        @include('sweetalert::alert')
        @stack('scripts')

    </div>

    @vite('resources/js/app.js')
</body>
</html>
