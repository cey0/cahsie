<?php

use App\Http\Controllers\KasirController;
use App\Http\Controllers\receipt;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/verify', [LoginController::class, 'verify'])->name('login.verify');

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard', [DashboardController::class, 'kasir'])->name('dashboard.kasir');

//barang
Route::resource('barang', BarangController::class);
//user
Route::resource('user', UserController::class);
//kasir
Route::resource('kasir', KasirController::class);
Route::resource('transaksi', TransaksiController::class);
//sturk
Route::get('/receipt', [receipt::class, 'receipt'])->name('receipt');
Route::get('/transaksi/generate-pdf', 'TransaksiController@generatePDF')->name('transaksi.generatePDF');

