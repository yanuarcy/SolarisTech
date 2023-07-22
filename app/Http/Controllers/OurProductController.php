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

    public function addToCart($id) {
        $product = Product::find($id);

        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartKey = 'cart_' . $userId;
            $cart = Cache::get($cartKey, []);
        } else {
            $cart = Cache::get('cart', []);
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nm_produk" => $product->nm_produk,
                "photo" => $product->photo,
                "hg_produk" => $product->hg_produk,
                "quantity" => 1
            ];
        }

        if (auth()->check()) {
            Cache::put($cartKey, $cart);
        } else {
            Cache::put('cart', $cart);
        }



        return redirect()->route('GetProduk');
    }
}
