<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Tittle = 'SolarisTech - Product';

        $products = Product::all();
        foreach ($products as $produk) {
            $produk->hg_produk = 'Rp. ' . number_format($produk->hg_produk, 0, ',', '.');
        }

        return view('Admin.Stuff.ProdukDisplay', ['Tittle' => $Tittle, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Tittle = 'SolarisTech - CreateProduct';

        $Kategoris = Kategori::all();

        return view('Admin.Stuff.CreateProduk', compact('Tittle', 'Kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'nama_produk' => 'required',
        //     'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // tambahkan validasi file gambar
        // ]);

        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka',
            'image' => 'Pilih :attribute dengan format jpeg,png,jpg.'
        ];

        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'stok' => 'required|numeric',
            'desc_produk' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }

        // Upload gambar ke direktori resources/images
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName= $image->getClientOriginalName();
            // $imageName = 'Product' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(resource_path('images'), $imageName);
            // $image->storeAs('images', $imageName, 'resources');
            // $image->move(public_path('resources/images'), $imageName);
        } else {
            $imageName = null;
        }

        $MemberID = 1;
        $hargaProduk = str_replace(['Rp', '.', ' '], '', $request->harga_produk);

        // Mengubah string menjadi integer
        $HargaProduk = (int)$hargaProduk;
        // $hargaProduk = preg_replace('/[^0-9]/', '', $request->harga_produk);

        // // Mengubah string menjadi integer
        // $HargaProduk = (int)$hargaProduk;

        // Menghapus karakter non-angka dari harga_produk
        // $hargaProduk = str_replace('Rp', '', $request->harga_produk);
        // $HargaProduk = str_replace('.', '', $hargaProduk);

        // Mengubah string menjadi integer
        // $HargaProduk = intval($hargaProduk);
        // Simpan data produk ke database
        $product = New Product;
        $product->kategori_id = $request->kategori;
        $product->user_id = $MemberID;
        $product->nm_produk = $request->nama_produk;
        $product->hg_produk = $HargaProduk;
        $product->stok = $request->stok;
        $product->desc_produk = $request->desc_produk;
        $product->photo = $imageName;
        $product->save();


        return redirect()->route('Product.index')->with('success', 'Produk berhasil ditambahkan.');
        // return redirect('/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
