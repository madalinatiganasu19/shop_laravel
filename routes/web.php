<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('pages.welcome');
})->name('welcome');

Route::get('/index', 'IndexController@index')->name('index');
Route::get('/cart', 'IndexController@cart')->name('cart');
Route::post('/cart', 'IndexController@cart')->name('checkout');
Route::get('/login', 'IndexController@login')->name('login');
Route::post('/login', 'IndexController@login')->name('doLogin');

Route::get('/products', 'ProductsController@products')->name('products');
Route::get('/product', 'ProductsController@product')->name('product');

Route::get('/logout', function() {
    session()->flush();
    return redirect()->route('index');
})->name('logout');
