@extends('Template.template')

@vite('resources/sass/Payment/index.scss')

@section('Content')
    <div class="container Box">
        <div class="row justify-content-center">

            <div class="col-md-5">
                <div class="headerLeft">
                    <a class="h4" href="{{ route('cart') }}">
                        <i class="bi bi-arrow-left"></i> SolarisTech
                    </a>
                    {{-- <p>Kode pesanan acak Anda adalah: <span id="order-code">{{ $orderCode }}</span></p> --}}
                </div>
                <div class="mainLeft mt-5">
                    @php
                        $total = 0;
                        $cart = [];
                        // $cart = Cache::get('cart_' . auth()->user()->id, []);

                        if (auth()->check()) {
                            $cart = Cache::get('cart_' . auth()->user()->id, []);
                        } else {
                            $cart = Cache::get('cart', []);
                        }

                        foreach ($cart as $id => $details) {
                            $subharga = $details['hg_produk'] * $details['quantity'];
                            $total += $subharga;
                        }

                    @endphp
                    <h4>Pay {{ Auth::user()->name }}</h4>
                    <h1>Rp {{ number_format($total, 0, ',', '.') }}</h1>

                    @if(!empty($cart))
                        @foreach($cart as $id => $details)
                            @php
                                $harga = $details['hg_produk'];
                                $subharga = $details['hg_produk'] * $details['quantity'];
                            @endphp
                            <div class="row mt-4">
                                <div class="col-md-2">
                                    <div class="">
                                        <img src="{{ Vite::asset('resources/images') }}/{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h5 style="display: inline-block; margin-right: 10px; margin-left: 10px;">{{ $details['nm_produk'] }}</h5>
                                    <h5 style="margin-left: 10px;">Rp {{ number_format($harga, 0, ',', '.') }}</h5>
                                </div>
                                <div class="col-md-3">
                                    <h5 style="display: inline-block;" class="text-md-end">Rp {{ number_format($subharga, 0, ',', '.') }}</h5>
                                    <h5 class="text-md-end mt-3">x{{ $details['quantity'] }}</h5>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="row mt-5">
                        <div class="col">
                            <h5>Subtotal</h5>
                        </div>
                        <div class="col">
                            <h5 class="text-md-end">Rp {{ number_format($total, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-1">

            </div>

            <div class="col-md-4">
                <div class="headerRight">
                    <h4>Contact Information</h4>
                </div>
                <div class="mainRight mt-4">
                    <form action="{{ route('processPayment') }}" method="POST">
                        @csrf
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control w-75" type="email" value="{{ Auth::user()->email }}" name="email" placeholder="Email">

                        <label class="form-label mt-4" for="telephone">Telephone</label>
                        <input class="form-control w-75" type="text" value="{{ Auth::user()->telepone }}" name="telephone" placeholder="Telephone">

                        <label class="form-label mt-4" for="Alamat">Alamat Pengiriman</label>
                        <textarea class="form-control w-75" placeholder="{{ Auth::user()->alamat }}" name="Alamat" id="Alamat" cols="30" rows="5"></textarea>

                        <h5 class="mt-4">Payment Method</h5>
                        <select class="form-select w-75" name="payment_method" id="payment_method">
                            <option value="" disabled selected>Metode Pembayaran</option>
                            <option value="BCA">BCA</option>
                            <option value="BNI">BNI</option>
                            <option value="ShopeePay">ShopeePay</option>
                            <option value="DANA">DANA</option>
                        </select>
                        <div id="bca_account_details" class="account-details" style="display: none;">
                            <span id="account_number"></span>
                        </div>

                        <input type="submit" value="Bayar" class="btn btn-primary w-75 mt-5">
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script>

    const accountNumbers = {
        BCA: "No Rekening : 0182400261",
        BNI: "No Rekening : 21522689256",
        DANA: "No Rekening : 082257508081",
        ShopeePay: "No Rekening : 081336377045",
    };
    // Event listener ketika opsi "BCA" dipilih
    document.getElementById("payment_method").addEventListener("change", function () {
        var bcaAccountDetails = document.getElementById("bca_account_details");
        var accountNumberSpan = document.getElementById("account_number");
        if (accountNumbers[this.value]) {
            bcaAccountDetails.classList.add("w-75");
            bcaAccountDetails.style.border = "1px solid #ccc";
            bcaAccountDetails.style.borderTop = "none";
            bcaAccountDetails.style.backgroundColor = "#f9f9f9";
            bcaAccountDetails.style.display = "block";
            bcaAccountDetails.style.padding = "10px";
            accountNumberSpan.textContent = accountNumbers[this.value];
        }

        else {
            bcaAccountDetails.style.display = "none";
        }
    });
</script>


@endpush
