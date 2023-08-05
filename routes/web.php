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
Route::get('/AboutUs', [HomeController::class, 'aboutUs'])->name('AboutUs');
Route::get('/CustProfile', [ProfileCust::class, 'CustProfile'])->name('CustProfile')->middleware('auth', 'cekrole:user');
Route::get('/CustProfile/HistoryOrder', [ProfileCust::class, 'HistoryOrder'])->name('HistoryOrder')->middleware('auth', 'cekrole:user');
Route::get('/Dashboard/AdminProfile', [ProfileCust::class, 'AdminProfile'])->name('AdminProfile')->middleware('auth', 'cekrole:admin');
Route::get('/Dashboard//AdminProfile/HistoryOrder', [ProfileCust::class, 'HistoryOrderAdmin'])->name('HistoryOrderAdmin')->middleware('auth', 'cekrole:admin');

route::fallback(function () {
    return view('app.404');
});



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
Route::get('/Dashboard/Transaksi/exportExcel', [OrderController::class, 'TransaksiexportExcel'])->name('Transaksi.exportExcel');
Route::get('/Dashboard/Transaksi/exportPDF', [OrderController::class, 'TransaksiexportPdf'])->name('Transaksi.exportPdf');


Auth::routes();
Route::post('/login', [LoginController::class, 'authenticate']);


Route::prefix('/Produk')->group(function () {
    Route::get('/', [OurProductController::class, 'index'])->name('GetProduk');
    Route::get('/{kategori}', [OurProductController::class, 'getKategori'])->name('GetKategori');
    Route::get('/DetailProduk/{id}', [OurProductController::class, 'DetailProduk'])->name('DetailProduk');
});

Route::middleware(['auth'])->group(function () {
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
    Route::get('/uploadProof/{id}', [PaymentController::class, 'Pay'])->name('Pay');
    Route::get('/form', [PaymentController::class, 'showForm'])->name('showPaymentForm');
    Route::post('/proccess', [PaymentController::class, 'processPayment'])->name('processPayment');
    Route::get('/UploadProof', [PaymentController::class, 'showPaymentInfo'])->name('showPaymentInfo');
    Route::post('/UploadProof/process', [PaymentController::class, 'processPaymentProof'])->name('processUploadProof');
});

