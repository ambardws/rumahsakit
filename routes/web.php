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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('dokter', 'DokterController');
Route::get('/dokter/{kd_dokter}/detail', 'DokterController@show');

Route::resource('pasien', 'PasienController');
Route::get('/pasien/{kd_pasien}/detail', 'PasienController@show');

Route::resource('kamar', 'KamarController');

Route::resource('registrasi', 'RegistrasiController');
