<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $Tittle = 'SolarisTech - Dashboard';

        return view('Admin.Dashboard.DashboardDisplay', compact('Tittle'));
    }
}
