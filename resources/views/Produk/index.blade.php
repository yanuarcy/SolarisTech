@extends('Template.template')

@vite([

    'resources/sass/Produk/index.scss',
    'resources/sass/Produk/dropdown.scss',
    'resources/sass/Layouts/nav.scss',
    'resources/js/Produk/DropdownKategori.js',
    'resources/sass/Layouts/footer.scss'
])

@section('Content')
    @include('Layouts.nav')

    <div class="container">
        <div class="row SelectBox">
            <form action="">
                <div class="select-menu">
                    <div class="select-btn">
                        <span class="sBtn-text" data-value="All">Select your option</span>
                    </div>

                    <ul class="options" id="option-list">
                        <li class="option">
                            <option data-value="All" class="option-text">All</option>
                        </li>
                        @foreach ($Kategoris as $kategori)
                            <li class="option">
                                <option class="option-text" data-value="{{ $kategori->id }}"
                                    {{ old('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nm_kategori }}
                                </option>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            @foreach ($products as $product)
                <div class="card">
                    @if ($product->photo)
                        {{-- <img src="resources/images/VGA3.jpg" alt=""> --}}
                        <img src="{{ Vite::asset('resources/images/' . $product->photo) }}" class="card-img-top"
                            alt="{{ $product->nm_produk }}">
                    @else
                        Gambar tidak tersedia
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nm_produk }}</h5>
                        <p class="card-text">{{ $product->hg_produk }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('DetailProduk', ['id' => $product->id]) }}" class="btn btn-warning"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('addTo-Cart', $product->id) }}" class="btn btn-primary addToCartBtn">
                            <i class="bi bi-cart3"></i>
                        </a>
                        {{-- <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-cart3"></i></button>
                        </form> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('Layouts.footer')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addToCartBtns = document.querySelectorAll('.addToCartBtn');

            addToCartBtns.forEach(btn => {
                btn.addEventListener('click', function (event) {
                    event.preventDefault();
                    const productId = this.getAttribute('href').split('/').pop();

                    // Tampilkan SweetAlert untuk konfirmasi
                    Swal.fire({
                        icon: 'info',
                        title: 'Tambah ke Keranjang',
                        text: 'Apakah Anda yakin ingin menambahkan produk ini ke dalam keranjang?',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, tambahkan',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Lanjutkan ke halaman penambahan ke keranjang (misal: addToCart function)
                            window.location.href = "/add-to-cart/" + productId;
                        }
                    });
                });
            });
        });
    </script>
@endpush
