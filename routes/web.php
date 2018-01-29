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

    Route::get('admin/transaksi','TransaksiController@index')->name('transaksi.index');

    Route::get('admin/transaksi/create','TransaksiController@create')->name('transaksi.create');

    Route::post('admin/transaksi','TransaksiController@store')->name('transaksi.store');

    Route::get('admin/transaksi/{id}','TransaksiController@show')->name('transaksi.detail');

    Route::get('admin/transaksi/{id}/edit','TransaksiController@edit')->name('transaksi.edit');

    Route::patch('admin/transaksi/{id}','TransaksiController@update')->name('transaksi.update');

    Route::get('admin/transaksi/{id}/delete','TransaksiController@destroy')->name('transaksi.destroy');

    //ajax-transaction
    Route::get('transaksi/get-customer/{id}','TransaksiController@getCustomer');

    Route::get('transaksi/get-produk-by-kategori/{id}','TransaksiController@getProduk');

    Route::post('admin/transaksi/get-produk','TransaksiController@getDetailProduk');

    //report
    Route::get('transaksi/report','ReportController@transaksiController');
    


});
