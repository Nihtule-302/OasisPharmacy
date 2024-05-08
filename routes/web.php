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

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart')->middleware('auth');
Route::get('/buy/{id}', [App\Http\Controllers\CartController::class, 'buy'])->name('buy')->middleware('auth');
Route::get('/removeFromCart/{id}', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('remove-from-cart')->middleware('auth');

//route remove from cart Here
Route::post('/addToCart/{id}', [App\Http\Controllers\ViewProductsController::class, 'addToCart'])->name('add-to-cart');



Route::get('/addProducts', [App\Http\Controllers\ModifyProductsController::class, 'viewAddProduct'])->name('add-products')->middleware('auth');
Route::get('/modifyProducts', [App\Http\Controllers\ModifyProductsController::class, 'viewModifyProduct'])->name('modify-products')->middleware('auth');
Route::post('/saveProduct', [App\Http\Controllers\ModifyProductsController::class, 'store'])->name('save-product')->middleware('auth');
Route::get('/deleteProduct/{id}', [App\Http\Controllers\ModifyProductsController::class, 'destroy'])->name('delete-product')->middleware('auth');
Route::get('/editProduct/{id}', [App\Http\Controllers\ModifyProductsController::class, 'edit'])->name('edit-product')->middleware('auth');
Route::post('/updateProduct/{id}', [App\Http\Controllers\ModifyProductsController::class, 'update'])->name('update-product')->middleware('auth');

Route::get('/viewProducts', [App\Http\Controllers\ViewProductsController::class, 'index'])->name('view-products');

Route::get('/viewOrders', [App\Http\Controllers\OrderController::class, 'index'])->name('viewOrders')->middleware('auth');
