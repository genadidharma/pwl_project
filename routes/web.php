<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriBarang;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\StokController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('pegawai')->group(function () {
        Route::resource('dokter', DokterController::class);
        Route::resource('kasir', KasirController::class);
    });

    Route::prefix('barang-barang')->group(function () {
        Route::resource('kategori-barang', KategoriBarangController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('stok', StokController::class);
    });

});
