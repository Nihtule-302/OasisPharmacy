<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('home');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');

Route::get('/modifyProducts', [App\Http\Controllers\ModifyProductsController::class, 'index'])->name('modify-products');
Route::post('/saveProduct', [App\Http\Controllers\ModifyProductsController::class, 'store'])->name('save-product');
Route::post('/deleteProduct', [App\Http\Controllers\ModifyProductsController::class, 'destroy'])->name('delete-product');

Route::get('/viewProducts', [App\Http\Controllers\ViewProductsController::class, 'index'])->name('view-products');
