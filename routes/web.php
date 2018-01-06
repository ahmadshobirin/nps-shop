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

Route::get('/', function () {
    return view('auth.login-admin');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

    Route::resource('admin/customer','CustomerController');

    Route::resource('admin/kategori-produk','KategoriProdukController');

    Route::resource('admin/produk','ProdukController');

});
