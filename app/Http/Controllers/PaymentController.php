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

        // $selectedProducts = json_decode($request->input('selectedProducts'));

        // $total = 0;

        // // Lakukan apa pun yang perlu Anda lakukan dengan data produk yang dipilih
        // // Contoh: $selectedProducts akan berisi array ID produk yang dipilih.

        // // Hitung total harga berdasarkan produk yang dipilih
        // foreach ($selectedProducts as $productId) {
        //     $product = Product::find($productId);
        //     $subTotal = $product->hg_produk * $product->quantity;
        //     $total += $subTotal;
        // }

        return view('Payment.index', compact('Tittle'));
    }

    public function Pay($id) {
        $Tittle = 'Solaris -Tech';
        // $email = Auth::user()->email;
        $Transaksis = Transaksi::where('id', $id)->first();
        $paymentMethod = $Transaksis->metode_pembayaran;
        $accountNumber = $this->getAccountNumberByPaymentMethod($paymentMethod);

        return view('Payment.UploadProof', compact('Tittle', 'paymentMethod', 'accountNumber'));
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

        if (empty($cart)) {
            Alert::error('Oops....', 'Keranjang belanja Anda kosong. Silakan tambahkan produk sebelum melakukan pembayaran.');
            return redirect()->back();
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
            // return redirect()->back()->with('error', 'Metode pembayaran tidak valid.');
            Alert::error('Oops....', 'Silahkan pilih Metode Pembayaran');
            return redirect()->back();
            // return redirect()->route('AboutUs');
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



        toast('Order Successfully, Processing Now','success');

        // Alihkan ke halaman berikutnya dengan data yang diperlukan
        return redirect()->route('showPaymentInfo')->with('payment_method', $paymentMethod)->with('orderCode', $orderCode);
    }

    public function showPaymentInfo(Request $request)
    {
        $Tittle = 'Solaris -Tech';

        // Ambil data dari session (data yang dikirim dari halaman sebelumnya)
        $paymentMethod = session('payment_method');
        $orderCode = session('orderCode');


        // Kode ini harus disesuaikan dengan cara Anda menyimpan data no rekening di database
        $accountNumber = $this->getAccountNumberByPaymentMethod($paymentMethod);

        return view('Payment.UploadProof', compact('paymentMethod', 'accountNumber', 'Tittle', 'orderCode'));
    }

    public function processPaymentProof(Request $request)
    {

        $message = [
            'required' => ':Attribute Mohon untuk diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'kd_pemesanan' => 'required',
            'PaymentProof' => 'required',
        ], $message);

        if ($validator->fails()) {
            Alert::error('Oops....', 'Silahkan Isi inputan yang kosong');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil kode pemesanan dari input form
        $kodePemesanan = $request->kd_pemesanan;

        if ($request->hasFile('PaymentProof')) {
            $image = $request->file('PaymentProof');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'Paymentproof_' . Str::random(10) . '.' . $extension;
            $image->move(resource_path('images/BuktiBayar'), $imageName);
        } else {
            $imageName = null;
        }

        // Cari transaksi berdasarkan kode pemesanan
        $transaksi = Transaksi::where('kode_pemesanan', $kodePemesanan)->first();

        if (!$transaksi) {
            Alert::error('Oops....', 'Kode Pemesanan Anda belum terdaftar');
            // return redirect()->back();
        }

        // Update kolom status_bayar menjadi 'sukses' dan simpan path gambar di kolom bukti_pembayaran
        $transaksi->status_bayar = 'Menunggu Konfirmasi';
        $transaksi->photo = $imageName;
        $transaksi->save();

        Alert::success('Success', 'Bukti pembayaran Anda berhasil dikirim!');
        return redirect()->route('Home');
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

    public function updateStatus($id) {
        $transaksi = Transaksi::find($id);
        $transaksi->status_bayar = 'Sukses';
        $transaksi->save();

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
}
