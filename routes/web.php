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
    return redirect('kendaraan');
})->middleware('auth');

Route::get('index', function () {
    return view('index');
});

// Route::get('starter', function () {
//     return view('starter');
// });

Route::get('admin/users/create','UserController@showprodi')->middleware('auth','admin');
Route::get('admin/perpanjangan', 'TransactionController@perpanjanganlist')->middleware('auth','admin');
Route::get('admin/users','UserController@showuser')->middleware('auth','admin','admin');
Route::get('admin/users/{npm}/edit','UserController@edit')->middleware('auth','admin');
Route::put('admin/users/{npm}','UserController@update')->middleware('auth','admin');
Route::get('admin/kendaraan','kendaraan@showadmin')->name('admin/kendaraan')->middleware('auth','admin');
Route::post('admin/users','UserController@store')->middleware('auth','admin');
Route::put('admin/perpanjangan/{id}/konfirmasi','TransactionController@confpaid')->middleware('auth','admin');
Route::post('admin/kendaraan/tambah','kendaraan@admstoretambah')->middleware('auth');
Route::delete('admin/kendaraan/{nopol}/del','kendaraan@admhapus')->middleware('auth','admin');



Route::get('kendaraan','kendaraan@showkendaraan')->name('kendaraan')->middleware('auth');
Route::post('kendaraan/tambah','kendaraan@storetambah')->middleware('auth');
Route::delete('kendaraan/{nopol}/del','kendaraan@hapus')->middleware('auth');
Route::get('pembayaran/baru','TransactionController@show')->middleware('auth');
Route::post('pembayaran/baru','TransactionController@tambah')->middleware('auth');

Route::get('pembayaran/konfirmasi','TransactionController@showlist')->middleware('auth');
Route::get('pembayaran/{id}/konfirmasi','TransactionController@createconf')->middleware('auth');
Route::delete('pembayaran/{id}/konfirmasi/hapus','TransactionController@delconf')->middleware('auth');
Route::post('pembayaran/{id}/konfirmasi','TransactionController@storeconf')->middleware('auth');
Route::put('users/{npm}','UserController@updateuser')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/deploy', 'Server@deploy');