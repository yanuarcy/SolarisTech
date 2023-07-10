@extends('Template.template')

@vite('resources/sass/app.scss')
@vite('resources/sass/Layouts/nav.scss')
@vite('resources/sass/Layouts/footer.scss')

@section('Content')
    @include('Layouts.nav')

    @include('Layouts.footer')

@endsection
