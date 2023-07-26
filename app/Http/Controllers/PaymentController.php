<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Proses penyimpanan data yang dikirimkan dari form
        // Misalnya simpan ke database

        // Redirect ke halaman selanjutnya dengan membawa data yang dipilih
        return redirect()->route('showPaymentInfo')->with('payment_method', $request->payment_method);
    }

    public function showPaymentInfo()
    {
        $Tittle = 'Solaris -Tech';

        // Ambil data dari session (data yang dikirim dari halaman sebelumnya)
        $paymentMethod = session('payment_method');
        $orderCode = $this->generateRandomOrderCode();


        // Kode ini harus disesuaikan dengan cara Anda menyimpan data no rekening di database
        $accountNumber = $this->getAccountNumberByPaymentMethod($paymentMethod);

        return view('Payment.UploadProof', compact('paymentMethod', 'accountNumber', 'Tittle', 'orderCode'));
    }

    // Metode ini harus disesuaikan dengan cara Anda mengambil data no rekening dari database
    private function getAccountNumberByPaymentMethod($paymentMethod)
    {
        // Contoh implementasi sederhana, Anda harus menggantinya dengan logika sesuai database Anda
        switch ($paymentMethod) {
            case 'BCA':
                return '1234-5678-9012';
            case 'BRI':
                return '9876-5432-1098';
            case 'BNI':
                return '2468-1357-8024';
            case 'ShopeePay':
                return 'shopeepay@example.com';
            case 'DANA':
                return 'dana@example.com';
            default:
                return 'No account number available';
        }
    }
}
