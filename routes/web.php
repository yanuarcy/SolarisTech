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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/CustProfile', [ProfileCust::class, 'CustProfile'])->name('CustProfile')->middleware('auth', 'cekrole:user');
Route::get('/CustProfile/HistoryOrder', [ProfileCust::class, 'HistoryOrder'])->name('HistoryOrder')->middleware('auth', 'cekrole:user');
Route::get('/Dashboard/AdminProfile', [ProfileCust::class, 'AdminProfile'])->name('AdminProfile')->middleware('auth', 'cekrole:admin');
Route::get('/Dashboard//AdminProfile/HistoryOrder', [ProfileCust::class, 'HistoryOrderAdmin'])->name('HistoryOrderAdmin')->middleware('auth', 'cekrole:admin');

route::fallback(function () {
    return view('app.404');
});

Route::get('/About', function () {
    return view('app.about');
})->name('AboutUs');

Route::group(['middleware' => ['auth', 'cekrole:admin']], function () {
    Route::get('Dashboard', [DashboardController::class, 'index'])->name('Dashboard');
});

Route::resource('/Dashboard/Member', MemberController::class);
Route::resource('/Dashboard/Kategori', KategoriController::class);
Route::resource('/Dashboard/Product', ProductController::class);
Route::get('/Dashboard/Order', [OrderController::class, 'Order'])->name('Order');
Route::get('/Dashboard/OrderDetails', [OrderController::class, 'OrderDetails'])->name('OrderDetails');
Route::get('/Dashboard/Transaksi', [OrderController::class, 'Transaksi'])->name('Transaksi');
Route::get('/Dashboard/Transaksi/updateStatus/{id}', [PaymentController::class, 'updateStatus'])->name('updateStatus')->middleware('auth', 'cekrole:admin');


Auth::routes();
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/Produk', [OurProductController::class, 'index'])->name('GetProduk');
Route::get('/Produk/{kategori}', [OurProductController::class, 'getKategori'])->name('GetKategori');

Route::get('getMember', [MemberController::class, 'getData'])->name('Member.getData');
Route::get('getProduct', [ProductController::class, 'getData'])->name('Product.getData');
Route::get('getKategori', [KategoriController::class, 'getData'])->name('Kategori.getData');
Route::get('getOrder', [OrderController::class, 'getDataOrder'])->name('Order.getData');
Route::get('getTransaksi', [OrderController::class, 'getData'])->name('Transaksi.getData');

Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [OurProductController::class, 'addToCart'])->name('addTo-Cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');

Route::get('/Payment', [PaymentController::class, 'index'])->name('Payment')->middleware('auth');
Route::get('/Payment/uploadProof/{id}', [PaymentController::class, 'Pay'])->name('Pay')->middleware('auth');
Route::get('/Payment/form', [PaymentController::class, 'showForm'])->name('showPaymentForm')->middleware('auth');
Route::post('/Payment/process', [PaymentController::class, 'processPayment'])->name('processPayment')->middleware('auth');
Route::get('/Payment/UploadProof', [PaymentController::class, 'showPaymentInfo'])->name('showPaymentInfo')->middleware('auth');
Route::post('/Payment/UploadProof/process', [PaymentController::class, 'processPaymentProof'])->name('processUploadProof')->middleware('auth');


