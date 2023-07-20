<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileCust extends Controller
{
    public function index() {
        $Tittle = 'Solaris -Tech';

        return view('app.ProfileCust', compact('Tittle'));
    }
}
