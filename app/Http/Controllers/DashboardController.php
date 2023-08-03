<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $Tittle = 'SolarisTech - Dashboard';

        $MemberCount = 0;
        $UserCount = 0;
        $AdminCount = 0;
        $Members = User::all();
        foreach($Members as $Member) {
            if ($Member->role == 'user') {
                $UserCount++;
            }
            if ($Member->role == 'admin') {
                $AdminCount++;
            }
            $MemberCount++;
        }

        $ProductCount = 0;
        $Products = Product::all();
        foreach ($Products as $Product) {
            $ProductCount++;
        }

        $KategoriCount = 0;
        $Kategoris = Kategori::all();
        foreach ($Kategoris as $Kategori) {
            $KategoriCount++;
        }

        // $OrderCount = 0;
        // $Orders = Order::all();
        // foreach ($Orders as $Order) {
        //     $OrderCount++;
        // }

        $TotalRevenue = 0;
        $TotalSales = 0;
        $Transaksis = Transaksi::all();
        foreach ($Transaksis as $Transaksi) {
            if($Transaksi->status_bayar == 'Sukses' || $Transaksi->status_bayar == 'sukses' ) {
                $TotalRevenue += $Transaksi->jml_transaksi;
            }
            $TotalSales++;
        }


        return view('Admin.Dashboard.DashboardDisplay', compact(
                                                                'Tittle',
                                                                'MemberCount',
                                                                'UserCount',
                                                                'AdminCount',
                                                                'ProductCount',
                                                                'KategoriCount',
                                                                'TotalRevenue',
                                                                'TotalSales',
                                                                'Transaksis'
                                                                ));
    }
}
