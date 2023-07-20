<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OurProductController extends Controller
{
    public function index()
    {
        $Tittle = 'SolarisTech - Product';

        $products = Product::all();
        $Kategoris = Kategori::all();

        foreach ($products as $produk) {
            $produk->hg_produk = 'Rp. ' . number_format($produk->hg_produk, 0, ',', '.');
        }

        return view('Produk.index', compact('Tittle', 'products', 'Kategoris'));
    }

    public function getKategori($kategori)
    {
        if ($kategori === 'All') {
            $Tittle = 'SolarisTech - Product';

            $products = Product::all();
            $Kategoris = Kategori::all();

            return view('Produk.index', compact('products', 'Kategoris', 'Tittle'));
        } else {
            $Tittle = 'SolarisTech - Product';

            $Kategoris = Kategori::all();
            $products = Product::where('kategori_id', $kategori)->get();
        }


        return view('Produk.index', compact('Tittle', 'products', 'Kategoris'));
    }
}
