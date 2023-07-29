<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCust extends Controller
{
    public function CustProfile() {
        $Tittle = 'Solaris - Tech';

        return view('app.ProfileCust', compact('Tittle'));

    }

    public function HistoryOrder() {
        $Tittle = 'Solaris - Tech';

        $email = Auth::user()->email;

        $Transaksis = Transaksi::where('email', $email)->orderBy('created_at', 'desc')->get();
        foreach ($Transaksis as $Transaksi) {
            $Transaksi->jml_transaksi = 'Rp. ' . number_format($Transaksi->jml_transaksi, 0, ',', '.');
        }
        $groupedTransaksis = $Transaksis->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('Y-m-d');
        });

        return view('app.HistoryOrder', compact('Tittle', 'groupedTransaksis'));
    }

    public function HistoryOrderAdmin() {
        $Tittle = 'Solaris - Tech';

        $email = Auth::user()->email;

        $Transaksis = Transaksi::where('email', $email)->orderBy('created_at', 'desc')->get();
        foreach ($Transaksis as $Transaksi) {
            $Transaksi->jml_transaksi = 'Rp. ' . number_format($Transaksi->jml_transaksi, 0, ',', '.');
        }
        $groupedTransaksis = $Transaksis->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('Y-m-d');
        });

        return view('Admin.HistoryOrderAdmin', compact('Tittle', 'groupedTransaksis'));
    }

    public function AdminProfile() {
        $Tittle = 'Solaris -Tech';

        return view('Admin.AdminProfile', compact('Tittle'));

    }
}
