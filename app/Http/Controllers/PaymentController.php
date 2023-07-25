<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        $Tittle = 'Solaris -Tech';

        return view('Payment.index', compact('Tittle'));
    }
}
