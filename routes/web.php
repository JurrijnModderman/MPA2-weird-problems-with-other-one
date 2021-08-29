<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductsController;

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

// Route::get('/', 'App\Http\Controllers\ProductsController@index')->name('product');
// Route::get('/cart/{id}', 'ProductsController@addToCart')
// ->name('product.addToCart');\
Route::get('/', [ProductsController::class, 'index'])->name('product.index');
Route::get('/cart{id}', [ProductsController::class, 'addToCart'])->name('addToCart');
Route::get('/reduce{id}', [ProductsController::class, 'reduceByOne'])->name('reduceByOne');
Route::get('/remove{id}', [ProductsController::class, 'getRemoveItem'])->name('remove');
Route::get('/cart', [ProductsController::class, 'getCart'])->name('product.cart');
Route::get('/shopping-cart', [ProductsController::class, 'getCart'])->name('product.shoppingCart');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', function () {
    return view('auth.login')->name('login');
});
Route::get('/register', function () {
    return view('auth.register')->name('register');
});

// require __DIR__ . '/auth.php';

