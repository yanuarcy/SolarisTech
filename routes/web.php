<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OurProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileCust;


Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/AboutUs', [HomeController::class, 'aboutUs'])->name('AboutUs');


Route::fallback(function () {
    return view('app.404');
});


Auth::routes();
Route::post('/login', [LoginController::class, 'authenticate']);


Route::middleware(['auth', 'cekrole:user'])->prefix('/CustProfile')->group(function () {
    Route::get('/', [ProfileCust::class, 'CustProfile'])->name('CustProfile');
    Route::get('/HistoryOrder', [ProfileCust::class, 'HistoryOrder'])->name('HistoryOrder');
});


Route::middleware(['auth', 'cekrole:admin'])->prefix('/Dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('Dashboard');
    Route::resource('/Member', MemberController::class);
    Route::resource('/Kategori', KategoriController::class);
    Route::resource('/Product', ProductController::class);
    Route::get('/Order', [OrderController::class, 'Order'])->name('Order');
    Route::get('/OrderDetails', [OrderController::class, 'OrderDetails'])->name('OrderDetails');

    Route::prefix('/AdminProfile')->group(function () {
        Route::get('/', [ProfileCust::class, 'AdminProfile'])->name('AdminProfile');
        Route::get('/HistoryOrder', [ProfileCust::class, 'HistoryOrderAdmin'])->name('HistoryOrderAdmin');
    });


    Route::prefix('/Transaksi')->group(function () {
        Route::get('/', [OrderController::class, 'Transaksi'])->name('Transaksi');
        Route::get('/updateStatus/{id}', [PaymentController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/exportExcel', [OrderController::class, 'TransaksiexportExcel'])->name('Transaksi.exportExcel');
        Route::get('/exportPDF', [OrderController::class, 'TransaksiexportPdf'])->name('Transaksi.exportPdf');
    });

});


Route::prefix('/Produk')->group(function () {
    Route::get('/', [OurProductController::class, 'index'])->name('GetProduk');
    Route::get('/{kategori}', [OurProductController::class, 'getKategori'])->name('GetKategori');
    Route::get('/DetailProduk/{id}', [OurProductController::class, 'DetailProduk'])->name('DetailProduk');
});


Route::middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::get('getMember', [MemberController::class, 'getData'])->name('Member.getData');
    Route::get('getProduct', [ProductController::class, 'getData'])->name('Product.getData');
    Route::get('getKategori', [KategoriController::class, 'getData'])->name('Kategori.getData');
    Route::get('getOrder', [OrderController::class, 'getDataOrder'])->name('Order.getData');
});


Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [OurProductController::class, 'addToCart'])->name('addTo-Cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');


Route::middleware('auth')->prefix('/Payment')->group(function () {
    Route::post('/', [PaymentController::class, 'index'])->name('Payment');
    Route::get('/form', [PaymentController::class, 'showForm'])->name('showPaymentForm');
    Route::post('/proccess', [PaymentController::class, 'processPayment'])->name('processPayment');

    Route::prefix('UploadProof')->group(function () {
        Route::get('/', [PaymentController::class, 'showPaymentInfo'])->name('showPaymentInfo');
        Route::get('/{id}', [PaymentController::class, 'Pay'])->name('Pay');
        Route::post('/process', [PaymentController::class, 'processPaymentProof'])->name('processUploadProof');
    });

});

