@extends('Template.template')

@vite('resources/sass/Payment/upload.scss')
@section('Content')
    <div class="container" style="padding: 5%">
        <div class="row justify-content-center">
            <div class="card w-75" style="padding: 5%">
                <div class="row Header">
                    <a class="h4" href="{{ route('Home') }}">
                        <i class="bi bi-arrow-left"></i> SolarisTech
                    </a>
                </div>
                <div class="row">
                    <div class="col">
                        <h1 class="">Payment Info</h1>
                        <p>Kode pesanan Anda adalah: <span id="order-code">{{ $orderCode }}</span></p>
                        <p>Nama : {{ Auth::user()->name }}</p>
                        <p>Telepone : {{ Auth::user()->telepone }}</p>
                        <p>Alamat : {{ Auth::user()->alamat }}</p>
                        <p>Metode Pembayaran: {{ $paymentMethod }}</p>
                        <p>No Rekening: {{ $accountNumber }}</p>
                    </div>
                    <div class="col">
                        <h2>
                            <form action="{{ route('processUploadProof') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="kd_pemesanan" class="form-label">Kode Pemesanan</label>
                                <input class="form-control w-75 @error('kd_pemesanan') is-invalid @enderror" type="text" name="kd_pemesanan" placeholder="Kode Pemesanan">
                                @error('kd_pemesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <h6 class="text-danger">*Kode Pemesanan dapat dilihat di bagian MyProfile</h6>

                                <label for="PaymentProof" class="form-label mt-3">Upload Bukti Bayar</label>
                                <input type="file" class="form-control w-75" name="PaymentProof" id="PaymentProof">
                                <input type="submit" value="Kirim" class="btn btn-primary w-75 mt-5">
                            </form>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
