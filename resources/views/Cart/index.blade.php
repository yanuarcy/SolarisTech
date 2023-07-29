@extends('Template.template')

@vite('resources/js/Cart/index.js')
@section('Content')

    <div class="container">
        <div class="row">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%" class="text-center">Subtotal</th>
                        <th style="width:10%"></th>
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
                            <a href="{{ route('Payment') }}" class="btn btn-success" >Checkout <i class="fa fa-arrow-right"></i></a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection

@push('scripts')
    <script type="text/javascript">
        // function handlePaymentClick(event) {
        //     // Cek apakah pengguna sudah login atau belum
        //     @auth
        //         // Jika pengguna sudah login, biarkan aksi href berjalan seperti biasa
        //     @else
        //         // Jika pengguna belum login, tampilkan SweetAlert dan hentikan aksi href
        //         event.preventDefault();
        //         Swal.fire({
        //             icon: 'info',
        //             title: 'Harap Login Terlebih Dahulu',
        //             text: 'Anda harus login sebelum melanjutkan ke halaman pembayaran.',
        //         });
        //     @endauth
        // }

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
