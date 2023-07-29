@php

    $RouteSaatIni = Route::currentRouteName();

@endphp

@if ($RouteSaatIni == 'Transaksi')
    <div class="d-flex justify-content-center">
        <a href="" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
        @if ($Transaksi->status_bayar == 'Menunggu Konfirmasi')
            <a href="{{ route('updateStatus', ['id' => $Transaksi->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="fas fa-check"></i></a>
        @endif
    </div>
@else
    <div class="d-flex justify-content-center">
        <a href="" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
        <a href="" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>

        <div>
            <form action="{{ route('Product.destroy', ['Product' => $products->id]) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete" data-name="{{ $products->nm_produk }}"><i class="bi-trash"></i></button>
            </form>
        </div>
    </div>
@endif
