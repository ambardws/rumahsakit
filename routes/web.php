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
Route::get('google', 'Auth\GoogleController@redirectToGoogle');
Route::get('callback/google', 'Auth\GoogleController@handleGoogleCallback');

Route::resource('dokter', 'DokterController');
Route::get('/dokter/{kd_dokter}/detail', 'DokterController@show');


Route::resource('pasien', 'PasienController');
Route::get('/pasien/{kd_pasien}/detail', 'PasienController@show');

Route::resource('kamar', 'KamarController');

Route::resource('tambahregistrasi', 'TambahRegistrasiController');

Route::resource('registrasi', 'RegistrasiController');
Route::get('/registrasi/{kd_reg}/detail', 'RegistrasiController@show');


Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

Route::post('dependent-dropdown', 'DependentDropdownController@store')
    ->name('dependent-dropdown.store');
