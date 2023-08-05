<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Tittle = 'SolarisTech - Kategori';
        confirmDelete();

        return view('Admin.Kategori.KategoriDisplay', compact('Tittle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Tittle = 'Solaris - Tech';

        return view('Admin.Kategori.CreateKategori', compact('Tittle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.'
        ];

        $validator = Validator::make($request->all(), [
            'nm_kategori' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $Kategori = New Kategori;
        $Kategori->nm_kategori = $request->nm_kategori;
        $Kategori->save();

        Alert::success('Created Successfully', 'New Category Data Successfully.');

        return redirect()->route('Kategori.index');
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
        $Tittle = 'Solaris - Tech';

        $Kategoris = Kategori::find($id);

        return view('Admin.Kategori.EditKategori', compact('Tittle', 'Kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.'
        ];

        $validator = Validator::make($request->all(), [
            'nm_kategori' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }

        $Kategori = Kategori::find($id);
        $Kategori->nm_kategori = $request->nm_kategori; //
        $Kategori->save();

        Alert::success('Changed Successfully', 'Kategori Data Changed Successfully.');

        return redirect()->route('Kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Kategori = Kategori::find($id);
        $Kategori->delete();

        // Alert::success('Deleted Successfully', 'Product Data Deleted Successfully.');
        toast('Category Data Deleted Successfully','success');

        return redirect()->route('Kategori.index');
    }

    public function getData(Request $request)
    {
        $Kategoris = Kategori::all();


        if ($request->ajax()) {
            return datatables()->of($Kategoris)
                ->addIndexColumn()
                ->addColumn('actions', function($Kategoris) {
                    return view('Layouts.actions', compact('Kategoris'));
                })
                ->toJson();
        }
    }
}
