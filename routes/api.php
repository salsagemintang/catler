<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'logincontroller@register');
Route::post('login', 'logincontroller@login');
Route::get('user', 'logincontroller@getAuthenticatedUser')->middleware('jwt.verify');


//pemesanan
Route::post('/simpan_pemesanan','pemesanancontroller@store')->middleware('jwt.verify');
Route::put('/ubah_pemesanan/{id}','pemesanancontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_pemesanan/{id}','pemesanancontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_pemesanan','pemesanancontroller@tampil_pemesanan')->middleware('jwt.verify');

//pelanggan
Route::post('/simpan_pelanggan','pelanggancontroller@store')->middleware('jwt.verify');
Route::put('/ubah_pelanggan/{id}','pelanggancontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_pelanggan/{id}','pelanggancontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_pelanggan','pelanggancontroller@tampil_pelanggan')->middleware('jwt.verify');

//penitipan
Route::post('/simpan_penitipan','penitipancontroller@store')->middleware('jwt.verify');
Route::put('/ubah_penitipan/{id}','penitipancontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_penitipan/{id}','penitipancontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_penitipan','penitipancontroller@tampil_penitipan')->middleware('jwt.verify');

//detail_transaksi
Route::post('/simpan_detail','detail_transaksicontroller@store')->middleware('jwt.verify');
Route::put('/ubah_detail/{id}','detail_transaksicontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_detail/{id}','detail_transaksicontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_detail','detail_transaksicontroller@tampil_detail')->middleware('jwt.verify');

//transaksi
Route::post('/simpan_transaksi','transaksicontroller@store')->middleware('jwt.verify');
Route::put('/ubah_transaksi/{id}','transaksicontroller@update')->middleware('jwt.verify');
Route::delete('/hapus_transaksi/{id}','transaksicontroller@destroy')->middleware('jwt.verify');
Route::get('/tampil_transaksi','transaksicontroller@tampil_transaksi')->middleware('jwt.verify');