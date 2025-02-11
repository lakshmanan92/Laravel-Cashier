<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product-list', [App\Http\Controllers\ProductController::class, 'productList'])->name('product.list');
Route::get('/product-detail/{id}', [App\Http\Controllers\ProductController::class, 'productDetail'])->name('product.detail');
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'pay'])->name('pay');
Route::get('/payment-success', [App\Http\Controllers\PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/handle-incomplete-payment', [App\Http\Controllers\PaymentController::class, 'handleIncompletePayment'])->name('handleIncompletePayment');

