@php
    $RouteSaatIni = Route::currentRouteName();

    $userId = auth()->check() ? auth()->user()->id : 'guest';
    $cartKey = $userId !== 'guest' ? 'cart_' . $userId : 'cart';
    $cart = Cache::get($cartKey, []);

    if ($userId === 'guest' && empty($cart)) {
        $cart = [];
    }

    $totalProducts = count($cart);
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
                    <a class="nav-link aktif" href="{{ route('AboutUs') }}">
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
                @if ($RouteSaatIni === 'GetProduk' || $RouteSaatIni === 'GetKategori')
                    <form action="" method="post" id="search" style="margin-left: 420px;">
                        <div class="search-box">
                            <input type="text" placeholder="Search By Name..">
                            <i class="bi bi-search"></i>
                        </div>
                    </form>
                @endif

                <li class="nav-item Cart
                    @if ($RouteSaatIni == 'Home') JarakKiriCart

                    @elseif ($RouteSaatIni == 'AboutUs' || $RouteSaatIni == 'DetailProduk') JarakKiriCart

                    @endif
                ">

                    <div class="dropdown">
                        <a data-bs-toggle="dropdown" class="nav-link" aria-current="page" href=""><i class="bi bi-cart3"></i> Cart
                            <span class="position-absolute translate-middle badge rounded-pill">
                                {{-- {{ count(array) session('cart')}} --}}
                                {{ $totalProducts }}
                                {{-- {{ count(session('cart_' . auth()->user()->id, [])) }} --}}
                                {{-- {{ count(Cache::get('cart_' . auth()->user()->id, [])) }} --}}
                                {{-- {{ count(Cache::get('cart_' . auth()->user()->id ?? 'guest', [])) }} --}}
                            </span>
                        </a>

                        {{-- List Dropdown Cart --}}
                        <div class="dropdown-menu">
                            <div class="row total-header-section">
                                @php
                                    $total = 0;
                                    $cart = [];
                                    // $cart = Cache::get('cart_' . auth()->user()->id, []);

                                    if (auth()->check()) {
                                        $cart = Cache::get('cart_' . auth()->user()->id, []); // ini Sudah Login cart_7
                                    } else {
                                        $cart = Cache::get('cart', []); // ini Belum Login cart
                                    }

                                @endphp
                                @foreach($cart as $id => $details)
                                    @php
                                        $total += $details['hg_produk'] * $details['quantity']
                                    @endphp
                                @endforeach
                                @php
                                    $GrandTotal = number_format($total, 0, ',', '.')
                                @endphp
                                <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                    <p class="text-white">Total: <span class="text-info">Rp {{ $GrandTotal }}</span></p>
                                </div>
                            </div>
                            @if(!empty($cart))
                                <div class="cart-detail-scroll">
                                    @foreach($cart as $id => $details)
                                        <div class="row cart-detail">
                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                <img src="{{ Vite::asset('resources/images') }}/{{ $details['photo'] }}" />
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                <p>{{ $details['nm_produk'] }}</p>
                                                @php
                                                    $harga = $details['hg_produk']
                                                @endphp
                                                <span class="price text-info"> Rp {{ number_format($harga, 0, ',', '.') }}</span> <span class="count"> Jumlah : {{ $details['quantity'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                    <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </li>
                @if ($RouteSaatIni !== 'GetProduk' && $RouteSaatIni !== 'GetKategori')


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
                                    @if (auth()->user()->role == 'user')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('CustProfile') }}">My Profile</a>
                                        </li>
                                    @endif

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
                @endif
            </ul>
        </div>
    </nav>
</div>
