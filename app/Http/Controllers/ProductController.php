<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Tittle = 'SolarisTech - Product';
        confirmDelete();
        return view('Admin.Stuff.ProdukDisplay', ['Tittle' => $Tittle]);
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

        Alert::success('Created Successfully', 'New Product Data Successfully.');

        return redirect()->route('Product.index')->with('success', 'Produk berhasil ditambahkan.');
        // return redirect('/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Tittle = 'Solaris - Tech';

        $products = Product::find($id);
        $Kategoris = Kategori::all();

        return view('Admin.Stuff.EditProduk', compact('Tittle', 'products', 'Kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'kategori' => 'required',
            'stok' => 'required|numeric',
            'harga_produk' => 'required|numeric',
            'desc_produk' => 'required',
            'gambar' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }

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

        $hargaProduk = str_replace(['Rp', '.', ' '], '', $request->harga_produk);

        $products = Product::find($id);
        $products->nm_produk = $request->nama_produk;
        $products->kategori_id = $request->kategori;
        $products->stok = $request->stok;
        $products->hg_produk = $hargaProduk;
        $products->desc_produk = $request->desc_produk;
        $products->photo = $imageName;
        $products->save();

        Alert::success('Changed Successfully', 'Product Data Changed Successfully.');

        return redirect()->route('Product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::find($id);
        $products->delete();

        // Alert::success('Deleted Successfully', 'Product Data Deleted Successfully.');
        toast('Product Data Deleted Successfully','success');

        return redirect()->route('Product.index');
    }

    public function getData(Request $request)
    {
        $products = Product::with('kategori', 'user');


        if ($request->ajax()) {
            return datatables()->of($products)
                ->addIndexColumn()
                ->addColumn('actions', function($products) {
                    return view('Layouts.actions', compact('products'));
                })
                ->editColumn('hg_produk', function ($product) {
                    return 'Rp. ' . number_format($product->hg_produk, 0, ',', '.');
                })
                ->toJson();
        }
    }
}
