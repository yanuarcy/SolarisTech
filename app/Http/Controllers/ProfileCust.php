<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileCust extends Controller
{
    public function CustProfile() {
        $Tittle = 'Solaris -Tech';

        return view('app.ProfileCust', compact('Tittle'));

    }

    public function AdminProfile() {
        $Tittle = 'Solaris -Tech';

        return view('Admin.AdminProfile', compact('Tittle'));

    }
}
