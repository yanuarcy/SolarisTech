<?php

namespace App\Http\Controllers;

use App\Models\Methodpay;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function index() {
        $Tittle = 'Solaris -Tech';

        return view('Payment.index', compact('Tittle'));
    }

    public function Pay() {
        $Tittle = 'Solaris -Tech';

        return view('Payment.UploadProof', compact('Tittle'));
    }

    function generateRandomOrderCode($length = 8)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }

    // public function Proof(Request $request) {
    //     $Tittle = 'Solaris -Tech';

    //     return redirect()->intended('/Payment/UploadProof')->with('payment_method', $request->payment_method);
    // }

    public function showForm()
    {
        return view('form');
    }

    public function processPayment(Request $request)
    {
        // if (empty($cart)) {
        //     // Tambahkan pesan kesalahan ke dalam session
        //     return redirect()->back()->with('error', 'Keranjang belanja Anda kosong. Silakan tambahkan produk sebelum melakukan pembayaran.');
        // }

        // Proses penyimpanan data yang dikirimkan dari form
        // Misalnya simpan ke database
        $user = Auth::user();
        $orderCode = $this->generateRandomOrderCode();
        $paymentMethod = $request->payment_method;

        // Buat catatan pesanan baru
        $order = Order::create([
            // 'order_id' => $orderCode,
            'user_id' => $user->id,
            // 'nm_member' => $user->name,
            'total_harga' => 0, // Akan diperbarui nanti
        ]);

        $total = 0;
        $cart = [];

        if (auth()->check()) {
            $cart = Cache::get('cart_' . auth()->user()->id, []);
        } else {
            $cart = Cache::get('cart', []);
        }

        foreach ($cart as $id => $details) {
            $subharga = $details['hg_produk'] * $details['quantity'];
            $total += $subharga;

            // Buat catatan detail pesanan untuk setiap item dalam keranjang
            $orderDetail = $order->orderDetails()->create([
                'order_id' => $order->id,
                'product_id' => $id,
                'nm_member' => $user->name,
                'nm_barang' => $details['nm_produk'],
                'jml_barang' => $details['quantity'],
                'total_harga' => $subharga,
            ]);

            // Perbarui stok pada tabel Products
            $product = Product::find($id);
            if ($product) {
                $product->stok -= $details['quantity'];
                $product->save();
            }
        }

        $methodPay = Methodpay::where('metode_pembayaran', $paymentMethod)->first();
        if (!$methodPay) {
            // Tangani kasus jika methodPay tidak ditemukan (misalnya, kembali ke halaman sebelumnya dengan pesan kesalahan)
            return redirect()->back()->with('error', 'Metode pembayaran tidak valid.');
        }

        $transaksi = Transaksi::create([
            'order_id' => $order->id,
            'methodpay_id' => $methodPay->id,
            'kode_pemesanan' => $orderCode,
            'email' => $request->input('email'),
            'nm_member' => Auth::user()->name,
            'telephone' => $request->input('telephone'),
            'alamat_pengiriman' => $request->input('AlamatPengiriman'),
            'jml_transaksi' => $total,
            'metode_pembayaran' => $paymentMethod,
            'status_bayar' => 'belum bayar', // Akan diperbarui saat upload foto
            'photo' => null, // Nilai awal photo adalah NULL
        ]);

        // Perbarui total_harga pada catatan pesanan
        $order->update(['total_harga' => $total]);

        if (auth()->check()) {
            Cache::forget('cart_' . auth()->user()->id);
        } else {
            Cache::forget('cart');
        }

        // Alihkan ke halaman berikutnya dengan data yang diperlukan
        return redirect()->route('showPaymentInfo')->with('payment_method', $paymentMethod)->with('orderCode', $orderCode);

        // Redirect ke halaman selanjutnya dengan membawa data yang dipilih
        // return redirect()->route('showPaymentInfo')->with('payment_method', $request->payment_method);
    }

    public function showPaymentInfo(Request $request)
    {
        $Tittle = 'Solaris -Tech';

        // Ambil data dari session (data yang dikirim dari halaman sebelumnya)
        $paymentMethod = session('payment_method');
        $orderCode = session('orderCode');


        // Kode ini harus disesuaikan dengan cara Anda menyimpan data no rekening di database
        $accountNumber = $this->getAccountNumberByPaymentMethod($paymentMethod);

        // if ($request->hasFile('photo')) {
        //     $transaksiId = session('transaksi_id');
        //     $transaksi = Transaksi::find($transaksiId);

        //     if ($transaksi) {
        //         $transaksi->status_bayar = 'sukses';
        //         $transaksi->save();
        //     }
        // }

        return view('Payment.UploadProof', compact('paymentMethod', 'accountNumber', 'Tittle', 'orderCode'));
    }

    public function processPaymentProof(Request $request)
    {

        $message = [
            'required' => ':Attribute Mohon untuk diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'kd_pemesanan' => 'required',
            'PaymentProof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil kode pemesanan dari input form
        $kodePemesanan = $request->kd_pemesanan;

        if ($request->hasFile('PaymentProof')) {
            $image = $request->file('PaymentProof');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'Paymentproof_' . Str::random(10) . '.' . $extension;
            $image->move(resource_path('images/BuktiBayar'), $imageName);
            // $image->storeAs('images', $imageName, 'resources');
            // $image->move(public_path('resources/images'), $imageName);
        } else {
            $imageName = null;
        }

        // Cari transaksi berdasarkan kode pemesanan
        $transaksi = Transaksi::where('kode_pemesanan', $kodePemesanan)->first();


        // Simpan file gambar yang diupload ke penyimpanan
        // $imagePath = $request->file('PaymentProof')->store('uploads', 'public');

        // Update kolom status_bayar menjadi 'sukses' dan simpan path gambar di kolom bukti_pembayaran
        $transaksi->status_bayar = 'sukses';
        $transaksi->photo = $imageName;
        $transaksi->save();

        return redirect()->route('Home')->with('success', 'Bukti pembayaran berhasil diunggah. Pembayaran Anda telah diverifikasi.');
    }

    // Metode ini harus disesuaikan dengan cara Anda mengambil data no rekening dari database
    private function getAccountNumberByPaymentMethod($paymentMethod)
    {
        // Contoh implementasi sederhana, Anda harus menggantinya dengan logika sesuai database Anda
        switch ($paymentMethod) {
            case 'BCA':
                return '0182400261';
            case 'BNI':
                return '0123456789';
            case 'ShopeePay':
                return '082257508081';
            case 'DANA':
                return '081336377045';
            default:
                return 'No account number available';
        }
    }
}