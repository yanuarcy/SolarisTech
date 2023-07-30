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
                                <button class="btn btn-danger btn-sm cart_remove"><i class="bi bi-trash3 text-white"></i></button>
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
                    <h5>MEMBER DETAIL</h5>
                    <p>Member ID : {{ Auth::user()->id }} </p>
                    <p>Nama Member : {{ Auth::user()->name }} </p>
                    <p>Total Items : {{ $TotalItem }} </p>
                    <button class="btn btn-dark">CONTINUE SHOPPING</button>
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
                    <form action="{{ route('Payment') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark Checkout">CHECKOUT</button>
                    </form>
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

    </script>

@endpush
