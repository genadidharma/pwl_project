<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\TransaksiBarangController;
use App\Http\Controllers\TransaksiObatController;
use App\Models\TransaksiBarang;
use App\Models\TransaksiObat;

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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'level:admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('pegawai')->group(function () {
        Route::resource('dokter', DokterController::class);
        Route::resource('kasir', KasirController::class);
    });

    Route::prefix('barang-barang')->group(function () {
        Route::resource('kategori-barang', KategoriBarangController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('stok', StokController::class);
    });

    Route::resource('pemeriksaan', PemeriksaanController::class, ['as'=>'admin']);
});

Route::group(['prefix' => 'dokter', 'middleware' => ['auth', 'level:dokter']], function () {
    Route::resource('pemeriksaan', PemeriksaanController::class, ['as'=>'dokter']);
});

Route::group(['prefix' => 'kasir', 'middleware' => ['auth', 'level:kasir']], function () {
    Route::prefix('transaksi')->group(function(){
        Route::resource('barang', TransaksiBarangController::class, ['as'=>'transaksi']);
        Route::resource('obat', TransaksiObatController::class, ['as'=>'transaksi']);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
