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
    return view('welcome');
});

// Route::get('/dashboard', 'AdminController@dashboard');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pendaftaran', 'PendaftaranController@index')->name('pendaftaran');

Route::resource('dataDokter', 'DokterController');
Route::resource('dataPasien', 'PasienController');
Route::resource('dataKamar', 'KamarController');
Route::resource('dataRegistrasi', 'RegistrasiController');


// Route::get('ajaxDokter', ['ajaxDokter' => 'DokterController@index', 'as' => 'ajaxDokter.index']);

// Route::get('/master', function () {
//     return view('layouts.master');
// });

// Route::get('/{any}', function () {
//     return view('layouts.vue');
// })->where('any', '.*');
