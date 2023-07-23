@php
    $RouteSaatIni = Route::currentRouteName();
@endphp

@extends('Template.template')

@vite('resources/sass/Admin/Dashboard.scss')
@section('Content')
    <main>
        {{-- <h1 class="visually-hidden">Sidebars examples</h1> --}}

        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-4">SOLARISTECH</span>
            </a>

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mt-5">
                    <a href="{{ route('Dashboard') }}" class="nav-link text-white @if ($RouteSaatIni == 'Dashboard')
                        active
                    @endif" aria-current="page">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                        <i class="bi bi-speedometer2"></i>    Dashboard
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                        <i class="bi bi-person-circle"></i>    Member
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="{{ route('Product.index')}}" class="nav-link text-white @if ($RouteSaatIni == 'Product.index')
                        active
                    @endif">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                        <i class="bi bi-grid"></i>    Products
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                        <i class="bi bi-bookmarks-fill"></i>    Category
                    </a>
                </li>
                <hr>


                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                        <i class="bi bi-table"></i>    Order
                    </a>
                </li>
                <hr>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                        <i class="bi bi-ui-checks"></i> Order Details
                    </a>
                </li>

            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New Account</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                </ul>
            </div>
        </div>

        <div class="b-example-divider"></div>
        <div class="content">
            @yield('contentdashboard')
        </div>
    </main>

@endsection
