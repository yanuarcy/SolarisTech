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
                    @if(!empty($cart))
                        @foreach($cart as $id => $details)
                            @php $total += $details['hg_produk'] * $details['quantity'] @endphp
                            <tr data-id="{{ $id }}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img src="{{ Vite::asset('resources/images') }}/{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                                        <div class="col-sm-9">
                                            <h4 class="nomargin">{{ $details['nm_produk'] }}</h4>
                                        </div>
                                    </div>
                                </td>
                                @php
                                    $harga = $details['hg_produk']
                                @endphp
                                <td data-th="Price">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                                <td data-th="Quantity">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                                </td>
                                @php
                                    $subharga = $details['hg_produk'] * $details['quantity']
                                @endphp
                                <td data-th="Subtotal" class="text-center">Rp {{ number_format($subharga, 0, ',', '.') }}</td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i> Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right"><h3><strong>Total : Rp {{ number_format($total, 0, ',', '.') }}</strong></h3></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right">
                            <a href="{{ route('GetProduk') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
                            <a href="{{ route('Payment') }}" class="btn btn-success" onclick="handlePaymentClick(event)">Checkout <i class="fa fa-arrow-right"></i></a>
                        </td>
                    </tr>
                </tfoot>
            </table>
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

            if(confirm("Do you really want to remove?")) {
                $.ajax({
                    url: '{{ route('remove_from_cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
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
