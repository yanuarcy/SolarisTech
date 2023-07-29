<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function Order() {
        $Tittle = 'SolarisTech - Order';

        return view('Admin.Order.OrderDisplay', compact('Tittle'));
    }
    
    public function OrderDetails() {
        $Tittle = 'SolarisTech - OrderDetails';
        
        $OrderDetails = Orderdetails::all();
        foreach ($OrderDetails as $DetailOrder) {
            $DetailOrder->total_harga = 'Rp. ' . number_format($DetailOrder->total_harga, 0, ',', '.');
            // $DetailOrder->created_at = $DetailOrder->created_at->format('Y-m-d');
            Carbon::parse($DetailOrder->created_at)->format('Y-m-d');
        }
        
        return view('Admin.OrderDetails.OrderDetailsDisplay', compact('Tittle', 'OrderDetails'));
        
    }

    public function Transaksi() {
        $Tittle = 'SolarisTech - Transaksi';

        $Transaksis = Transaksi::all();
        foreach ($Transaksis as $Transaksi) {
            $Transaksi->jml_transaksi = 'Rp. ' . number_format($Transaksi->jml_transaksi, 0, ',', '.');
            // $Transaksi->created_at = $Transaksi->created_at->format('Y-m-d');
            // Carbon::parse($Transaksi->created_at)->format('Y-m-d');
        }

        return view('Admin.Transaksi.TransaksiDisplay', compact('Tittle', 'Transaksis'));
    }

    public function getDataOrder(Request $request)
    {
        $Orders = Order::with('user');


        if ($request->ajax()) {
            return datatables()->of($Orders)
                ->addIndexColumn()
                ->addColumn('actions', function($products) {
                    return view('Layouts.actions', compact('products'));
                })
                ->editColumn('total_harga', function ($Orders) {
                    return 'Rp. ' . number_format($Orders->total_harga, 0, ',', '.');
                })
                ->addColumn('created_at', function ($Orders) {
                    return $Orders->created_at->format('Y-m-d'); // Ubah format sesuai yang Anda inginkan
                })
                ->toJson();
        }
    }

    public function getDataTransaksi(Request $request)
    {
        $Transaksi = Transaksi::all();

        if ($request->ajax()) {
            return datatables()->of($Transaksi)
                ->addIndexColumn()
                ->addColumn('created_at', function ($Transaksi) {
                    return $Transaksi->created_at->format('Y-m-d'); // Ubah format sesuai yang Anda inginkan
                })
                ->toJson();
        }
    }
}
