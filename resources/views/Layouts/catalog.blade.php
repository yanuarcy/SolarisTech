<div id="Catalog" class="container Catalog" style="padding-top: 10%; margin-bottom: 5%; margin-top: -4%">
    <div class="JudulCatalog">
        <h1 class="text-center text-white mb-5">Catalog Product</h1>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide mb-5 w-75" data-touch="true" data-interval="true" data-ride="carousel">
        @php
            $randomProducts = App\Models\Product::inRandomOrder()->take(4)->get();
        @endphp
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            @foreach ($products as $product)
                {{-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li> --}}
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($randomProducts as $index => $product)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-interval="3000">
                    <img src="{{ Vite::asset('resources/images/' . $product->photo) }}" class="d-block w-100" alt="{{ $product->nm_produk }}">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>




    <div class="row justify-content-center">
        @php
            $randomProducts = App\Models\Product::inRandomOrder()->take(6)->get();
        @endphp
        @foreach ($randomProducts as $product )
            <div class="card">
                @if ($product->photo)
                    <img src="{{ Vite::asset('resources/images/' . $product->photo) }}" class="card-img-top" alt="{{ $product->nm_produk }}">
                @else
                    Gambar tidak tersedia
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nm_produk }}</h5>
                    <p class="card-text">Rp {{ number_format($product->hg_produk, 0, ',', '.') }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('DetailProduk', ['id' => $product->id]) }}" class="btn btn-warning"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('addTo-Cart', $product->id) }}" class="btn btn-primary addToCartBtn">
                        <i class="bi bi-cart3"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
