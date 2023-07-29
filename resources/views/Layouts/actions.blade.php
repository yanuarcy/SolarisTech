@php

    $RouteSaatIni = Route::currentRouteName();

@endphp

@if ($RouteSaatIni == 'Transaksi')
    <div class="d-flex justify-content-center">
        <a href="" class="btn btn-primary btn-sm me-2"><i class="bi bi-search"></i></a>
        @if ($Transaksi->status_bayar == 'Menunggu Konfirmasi')
            <a href="{{ route('updateStatus', ['id' => $Transaksi->id]) }}" class="btn btn-success btn-sm me-2"><i class="fas fa-check"></i></a>
        @endif
    </div>

@elseif ($RouteSaatIni == 'Product.getData')
    <div class="d-flex justify-content-center">

        <div>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm me-2 btn-delete"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm me-2 btn-delete"><i class="bi-pencil-square"></i></button>
            </form>
        </div>

        <div>
            <form action="{{ route('Product.destroy', ['Product' => $products->id]) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm me-2 btn-delete" data-name="{{ $products->nm_produk }}"><i class="bi-trash"></i></button>
            </form>
        </div>
    </div>

@elseif ($RouteSaatIni == 'Kategori.getData')
    <div class="d-flex justify-content-center">

        <div>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm me-2 btn-delete"><i class="bi-pencil-square"></i></button>
            </form>
        </div>

        <div>
            <form action="{{ route('Kategori.destroy', ['Kategori' => $Kategoris->id]) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger  btn-sm me-2 btn-delete" data-name="{{ $Kategoris->nm_kategori }}"><i class="bi-trash"></i></button>
            </form>
        </div>
    </div>

@elseif ($RouteSaatIni == 'Order.getData')
    <div class="text-center">
        <form action="" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning btn-sm me-2 btn-delete">View</button>
        </form>
    </div>
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
