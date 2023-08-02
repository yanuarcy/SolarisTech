@extends('Template.template')



@vite('resources/sass/app.scss')
@vite('resources/sass/app/index.scss')
@vite('resources/sass/Layouts/nav.scss')
@vite('resources/sass/Layouts/footer.scss')
@vite('resources/sass/Layouts/catalog.scss')
@vite('resources/sass/Layouts/contact.scss')



@section('Content')


    @include('Layouts.nav')


    <div class="Jumbotron jumbotron-fluid" id="section-home">
        <div class="container text-center">
            <div class="komponen">
                <h2 class="display-4"><span>Find</span> and <span>Get</span><br> What You Need</h2>
                <a href="#Catalog" class="btn button">Get Product</a>
            </div>
        </div>
    </div>


    <div class="container" style="z-index: 1">
        <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">

                    <div class="col-lg d-flex">
                        <img src="{{ Vite::asset('resources/images/employee.png') }}" alt="employee" class="float-left">
                        <div class="blokk d-block">
                            <h4>24 Hours</h4>
                            <p>Web ini dibuka selama 24 jam untuk melayani Customer</p>
                        </div>
                    </div>

                    <div class="col-lg d-flex">
                        <img src="{{ Vite::asset('resources/images/Quality.png') }}" style="width: 50%;" alt="hires" class="float-left">
                        <div class="blokk d-block">
                            <h4>High-Quality</h4>
                            <p>Produk yang kami tawarkan sudah Best Quality</p>
                        </div>
                    </div>

                    <div class="col-lg d-flex">
                        <img src="{{ Vite::asset('resources/images/Warranty.png') }}" style="width: 30%;" alt="security" class="float-left">
                        <div class="blokk d-block">
                            <h4>Guaranteed</h4>
                            <p>Belanja di toko kami mendapatkan Garansi selama 2 Tahun</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="main">
        @include('Layouts.catalog')
        @include('Layouts.contact')
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
