<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $Tittle = 'SolarisTech';

        $products = Product::all();
        foreach ($products as $produk) {
            $produk->hg_produk = 'Rp. ' . number_format($produk->hg_produk, 0, ',', '.');
        }

        return view('app.index', compact('Tittle', 'products'));
    }
}
