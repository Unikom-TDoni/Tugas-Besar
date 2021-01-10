<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

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

require __DIR__.'/auth.php';
