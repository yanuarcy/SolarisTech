@extends('Template.template')

@vite ('resources/sass/Layouts/nav.scss')
@vite ('resources/sass/Layouts/footer.scss')
@vite ('resources/sass/Produk/DetailProduk.scss')

@section('Content')
    @include('Layouts.nav')
    <section class="About text-white" id="section-about">
        <div class="container">
            <div class="row contentAbout">
                <div class="col gambar">
                    <img style="width: 60%" src="{{ Vite::asset('resources/images/'. $DetailProduct->photo) }}" alt="">
                </div>
                <div class="col textabout">
                    <h2>Detail Product</h2>
                    <hr>
                    <h3>{{ $DetailProduct->nm_produk }}</h3>
                    <h5>Rp {{ number_format($DetailProduct->hg_produk, 0, ',', '.') }}</h5>
                    <h5 class="mt-4">{{ $DetailProduct->desc_produk }}</h5>

                    <a href="{{ route('addTo-Cart', $DetailProduct->id) }}">
                        <button class="btn btn-primary w-25 mt-5">Buy</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @include('Layouts.footer')
@endsection
