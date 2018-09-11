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
use App\Http\Middleware\CheckLogState;

Route::get('/', function() {
    return view('pages.welcome');
})->name('welcome');

Route::get('/index', 'IndexController@index')->name('index');
Route::get('/cart', 'IndexController@cart')->name('cart');
Route::get('/login', 'IndexController@login')->name('login');
Route::get('/logout', 'IndexController@logout')->name('logout')->middleware(CheckLogState::class);

Route::post('/cart', 'IndexController@cart')->name('checkout');
Route::post('/login', 'IndexController@login')->name('doLogin');

Route::get('/products', 'ProductsController@products')->name('products')->middleware(CheckLogState::class);
Route::get('/product', 'ProductsController@product')->name('product')->middleware(CheckLogState::class);

Route::post('/product', 'ProductsController@product')->name('save');

Route::get('/orders', 'OrdersController@orders')->name('orders')->middleware(CheckLogState::class);
Route::get('/order', 'OrdersController@order')->name('order')->middleware(CheckLogState::class);
