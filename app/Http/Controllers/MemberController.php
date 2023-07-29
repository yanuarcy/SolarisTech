<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Tittle = 'SolarisTech - Member';

        return view('Admin.Member.MemberDisplay', compact('Tittle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Tittle = 'SolarisTech - SignUp';

        return view('Admin.Akun.register', compact('Tittle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':Attribute Mohon untuk diisi.',
            'numeric' => ':Attribute hanya boleh berupa angka',
            'unique' => ':Attribute sudah ada dalam list',
            'min' => ':Attribute minimal harus terdiri dari :min karakter'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:members,email_user',
            'password' => 'required|min:8',
            'telepone' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
        ], $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $User = New User;
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = $request->password;
        $User->telepone = $request->telepone;
        $User->gender = $request->gender;
        $User->alamat = $request->alamat;
        $User->role = 'admin';
        $User->save();

        return redirect()->route('Dashboard');
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

    public function getData(Request $request)
    {
        $Members = User::all();


        if ($request->ajax()) {
            return datatables()->of($Members)
                ->addIndexColumn()
                ->toJson();
        }
    }
}
