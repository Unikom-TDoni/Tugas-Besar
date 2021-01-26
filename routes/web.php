<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\HomepageController;

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
    return view('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('admin', [AdminController::class, 'index'])->name('dashboard');

Route::get('admin/cabang', [AdminController::class, 'cabang'])->name('cabang');
Route::post('admin/cabang/get-kota-by-provinsi', [AdminController::class, 'getKota'])->name('cabang.getkota');
Route::post('admin/cabang/data', [AdminController::class, 'getDataCabang'])->name('cabang.data');
Route::post('admin/cabang/save', [AdminController::class, 'saveCabang'])->name('cabang.save');
Route::post('admin/cabang/delete', [AdminController::class, 'hapusCabang'])->name('cabang.delete');
Route::post('admin/cabang/aktivasi', [AdminController::class, 'ubahAktivasiCabang'])->name('cabang.aktivasi');

Route::get('admin/kendaraan', [AdminController::class, 'kendaraan'])->name('kendaraan');
Route::post('admin/kendaraan/data', [AdminController::class, 'getDataKendaraan'])->name('kendaraan.data');
Route::post('admin/kendaraan/save', [AdminController::class, 'saveKendaraan'])->name('kendaraan.save');
Route::post('admin/kendaraan/delete', [AdminController::class, 'hapusKendaraan'])->name('kendaraan.delete');

Route::group(['prefix' => 'user'], function () {
    //Homepage Route
    Route::group(['prefix' => 'homepage'], function () {
        Route::get('/', [HomepageController::class, 'index'])->name('homepage');
    });
});

Route::get('admin/pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan');
Route::post('admin/pelanggan/data', [AdminController::class, 'getDataPelanggan'])->name('pelanggan.data');

Route::get('admin/users', [AdminController::class, 'users'])->name('users');
Route::post('admin/users/data', [AdminController::class, 'getDataUsers'])->name('users.data');
Route::post('admin/users/save', [AdminController::class, 'saveUsers'])->name('users.save');
Route::post('admin/users/delete', [AdminController::class, 'hapusUsers'])->name('users.delete');
Route::post('admin/users/password', [AdminController::class, 'ubahPasswordUsers'])->name('users.password');

Route::get('admin/transaksi', [AdminController::class, 'users'])->name('transaksi');

require __DIR__.'/auth.php';
