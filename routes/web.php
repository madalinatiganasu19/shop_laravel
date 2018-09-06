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

Route::get('/welcome', function(){
    return view('pages.welcome');
})->name('welcome');

Route::get('/', 'IndexController@index')->name('/');
Route::get('/cart', 'IndexController@cart')->name('cart');
Route::get('/login', 'IndexController@login')->name('login');
