@php
    $RouteSaatIni = Route::currentRouteName();
@endphp

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand text-white" style="font-size: 24px;" href="{{ route('Home') }}"><i class="bi bi-cpu"></i> SolarisTech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link aktif" href="{{ route('GetProduk') }}">
                        Product
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link aktif" href="">
                        About
                    </a>
                </li>
                @guest
                @else
                    @if (auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link aktif" href="{{ route('Dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                    @endif
                @endguest
            </ul>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item Cart" style="margin-left: 600px;">
                    <a class="nav-link" aria-current="page" href=""><i class="bi bi-cart3"></i> Cart
                        <span class="position-absolute translate-middle badge rounded-pill">
                            0
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            @guest
                                <i class="bi bi-person-fill"></i>
                            @else
                                <i class="bi bi-person-fill">{{ Auth::user()->name }}</i>
                            @endguest
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                            @guest

                                @if (Route::has('login'))
                                    @auth
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        style="color: red;"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Log Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('login') }}">Sign In</a>
                                        </li>
                                    @endauth
                                @endif

                                @if (Route::has('register'))
                                    <li>
                                        <a class="dropdown-item" href="{{ route('register') }}">Sign Up</a>
                                    </li>
                                @endif

                            @else

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

                        </ul>
                    </div>
                    {{-- <a class="nav-link @if ($RouteSaatIni == '')
                        BarangLink
                    @endif" href=""><i style="font-size: 22px;" class="bi bi-person-fill"></i></a> --}}
                </li>
            </ul>
        </div>
    </nav>
</div>
