@extends('Template.template')

@vite('resources/js/Cart/index.js')
@vite('resources/sass/Cart/index.scss')
@section('Content')

    <section id="blog-home" class="container mt-5">
        <h2 class="font-weight-bold pt-5">Shopping Cart</h2>
        <hr>
    </section>

    <section id="cart-container" class="container my-5">
        <table style="width: 100%">
            <thead>
                <tr>
                    {{-- <td></td> --}}
                    <td>Images</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                    $cart = [];
                    // $cart = Cache::get('cart_' . auth()->user()->id, []);

                    if (auth()->check()) {
                        $cart = Cache::get('cart_' . auth()->user()->id, []);
                    } else {
                        $cart = Cache::get('cart', []);
                    }
                @endphp
                @if (!empty($cart))
                    @foreach ($cart as $id => $details )
                        @php $total += $details['hg_produk'] * $details['quantity'] @endphp
                        <tr data-id="{{ $id }}">
                            {{-- <td>
                                <input type="checkbox" class="product-checkout" value="{{ $id }}"> <!-- Checkbox untuk memilih produk -->
                            </td> --}}
                            <td>
                                <div class="hidden-xs"><img src="{{ Vite::asset('resources/images') }}/{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                            </td>
                            <td>
                                <h5>{{ $details['nm_produk'] }}</h5>
                            </td>
                            @php
                                $harga = $details['hg_produk']
                            @endphp
                            <td>
                                <h5>Rp {{ number_format($harga, 0, ',', '.') }}</h5>
                            </td>
                            <td>
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control mx-auto w-25 quantity cart_update" min="1" />
                            </td>
                            @php
                                $subharga = $details['hg_produk'] * $details['quantity']
                            @endphp
                            <td>
                                <h5>Rp {{ number_format($subharga, 0, ',', '.') }}</h5>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm cart_remove" data-name="{{ $details['nm_produk'] }}"><i class="bi bi-trash3 text-white"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </section>

    <section id="cart-bottom" class="container">
        <div class="row">
            <div class="coupon col-lg-6 col-md-6 col-12 mb-4">
                <div>
                    @php
                        $TotalItem = 0;

                        foreach ($cart as $product) {
                            $TotalItem += $product['quantity'];
                        }

                    @endphp
                    @guest
                        <h5>MEMBER DETAIL</h5>
                        <p>Member ID : Unknown </p>
                        <p>Nama Member : Unknown </p>
                        <p>Total Items : {{ $TotalItem }} </p>
                    @else
                        <h5>MEMBER DETAIL</h5>
                        <p>Member ID : {{ Auth::user()->id }} </p>
                        <p>Nama Member : {{ Auth::user()->name }} </p>
                        <p>Total Items : {{ $TotalItem }} </p>
                    @endguest
                    {{-- <form action="{{ route('GetProduk') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark">CONTINUE SHOPPING</button>
                    </form> --}}
                    <a href="{{ route('GetProduk') }}" class="btn btn-dark">CONTINUE SHOPPING</a>
                </div>
            </div>

            <div class="total col-lg-6 col-md-6 col-12">
                <div>
                    <h5>CART TOTAL</h5>
                    <div class="d-flex justify-content-between">
                        <h6>Subtotal</h6>
                        <p>Rp {{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                    <hr class="second-hr">
                    <div class="d-flex justify-content-between">
                        <h6>Total</h6>
                        <p>Rp {{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                    {{-- <form action="{{ route('Payment') }}" method="POST">
                        @csrf
                    </form> --}}
                    <form id="checkoutForm" action="{{ route('Payment') }}" method="post">
                        @csrf <!-- Pastikan Anda menggunakan Laravel untuk menambahkan token CSRF -->
                        <input type="hidden" name="selectedProducts" id="selectedProductsInput">
                    </form>
                    <button type="submit" class="btn btn-dark Checkout" id="btnCheckout" form="checkoutForm">CHECKOUT</button>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script type="text/javascript">

        $(".cart_update").change(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update_cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                window.location.reload();
                }
            });
        });

        $(".cart_remove").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            // Menggunakan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, jalankan AJAX untuk menghapus item
                    $.ajax({
                        url: '{{ route('remove_from_cart') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function (response) {
                            // Tampilkan SweetAlert untuk memberitahu pengguna bahwa item telah dihapus
                            Swal.fire(
                                'Deleted!',
                                'The item has been removed.',
                                'success'
                            ).then(() => {
                                // Muat ulang halaman setelah SweetAlert ditutup
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });

        function checkIfUserLoggedIn() {
            return {{ auth()->check() ? 'true' : 'false' }};
            return true; // Gantikan dengan metode pengecekan login Anda di sini.
        }

        document.addEventListener('DOMContentLoaded', function () {
            const btnCheckout = document.getElementById('btnCheckout');

            btnCheckout.addEventListener('click', function (event) {
                if (!checkIfUserLoggedIn()) {
                    event.preventDefault();
                    // Tampilkan SweetAlert info untuk mengingatkan pengguna untuk login terlebih dahulu
                    Swal.fire({
                        icon: 'info',
                        title: 'Harap Login Terlebih Dahulu',
                        text: 'Anda harus login terlebih dahulu sebelum melakukan checkout.',
                        confirmButtonText: 'OK'
                    });
                }
            });

            btnCheckout.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting

                // Check if the cart is empty
                if ({{ $TotalItem }} === 0) {
                    swal.fire("Cart is Empty", "You cannot checkout with an empty cart.", "error");
                    Swal.fire({
                        icon: 'error',
                        title: 'Keranjang anda kosong',
                        text: 'Anda harus belanja terlebih dahulu sebelum melakukan checkout.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('GetProduk') }}";
                        }
                    });
                } else {
                    // If the cart is not empty, submit the form
                    document.getElementById('checkoutForm').submit();
                }
            });
        });

        // document.addEventListener('DOMContentLoaded', function () {
        //     const btnCheckout = document.getElementById('btnCheckout');
        //     const selectedProductsInput = document.getElementById('selectedProductsInput');

        //     btnCheckout.addEventListener('click', function () {
        //         const checkboxes = document.querySelectorAll('.product-checkout');
        //         const selectedProducts = [];

        //         checkboxes.forEach((checkbox) => {
        //             if (checkbox.checked) {
        //                 const productId = checkbox.value;
        //                 selectedProducts.push(productId);
        //             }
        //         });

        //         // Simpan data produk yang dipilih ke input tersembunyi
        //         selectedProductsInput.value = JSON.stringify(selectedProducts);

        //         // Lanjutkan ke halaman pembayaran
        //         document.getElementById('checkoutForm').submit();
        //     });
        // });

    </script>

@endpush
