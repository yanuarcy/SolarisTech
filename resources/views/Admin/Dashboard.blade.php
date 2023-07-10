@extends('Template.template')

@section('Content')
    <h1>Haii ini {{ $Tittle }}</h1>
    <a href="" class="h1">Produk</a>

    @guest
    @else
        <h1>
            <i class="bi bi-person-fill">{{ Auth::user()->name }}</i>
        </h1>
        <li class="nav-item">
            <a class="nav-link aktif" href="{{ route('Admin.create') }}">
                New Account
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link aktif" href="{{ route('Home') }}">
                Home
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
            style="color: red;"
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Log Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    @endguest

    @include('Layouts.footer')
@endsection
