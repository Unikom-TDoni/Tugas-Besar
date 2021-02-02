<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pelanggan\HomepageController;
use App\Http\Controllers\Pelanggan\ProductDetailPageController;
use App\Http\Controllers\Pelanggan\LoginPageController;
use App\Http\Controllers\Pelanggan\ProfilePageController;
use App\Http\Controllers\Pelanggan\RegisterPageController;



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

Route::group(['prefix' => 'admin'], function () 
{    
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    Route::group(['prefix' => 'cabang'], function () 
    {
        Route::get('/', [AdminController::class, 'cabang'])->name('cabang');
        Route::post('get-kota-by-provinsi', [AdminController::class, 'getKota'])->name('cabang.getkota');
        Route::post('data', [AdminController::class, 'getDataCabang'])->name('cabang.data');
        Route::post('save', [AdminController::class, 'saveCabang'])->name('cabang.save');
        Route::post('delete', [AdminController::class, 'hapusCabang'])->name('cabang.delete');
        Route::post('aktivasi', [AdminController::class, 'ubahAktivasiCabang'])->name('cabang.aktivasi');
    });

    Route::group(['prefix' => 'kendaraan'], function () 
    {
        Route::get('/', [AdminController::class, 'kendaraan'])->name('kendaraan');
        Route::post('data', [AdminController::class, 'getDataKendaraan'])->name('kendaraan.data');
        Route::post('save', [AdminController::class, 'saveKendaraan'])->name('kendaraan.save');
        Route::post('delete', [AdminController::class, 'hapusKendaraan'])->name('kendaraan.delete');
    });

    Route::group(['prefix' => 'pelanggan'], function () 
    {
        Route::get('/', [AdminController::class, 'pelanggan'])->name('pelanggan');
        Route::post('data', [AdminController::class, 'getDataPelanggan'])->name('pelanggan.data');
    });

    Route::group(['prefix' => 'users'], function () 
    {
        Route::get('/', [AdminController::class, 'users'])->name('users');
        Route::post('data', [AdminController::class, 'getDataUsers'])->name('users.data');
        Route::post('save', [AdminController::class, 'saveUsers'])->name('users.save');
        Route::post('delete', [AdminController::class, 'hapusUsers'])->name('users.delete');
        Route::post('password', [AdminController::class, 'ubahPasswordUsers'])->name('users.password');
    });

    Route::group(['prefix' => 'transaksi'], function () 
    {
        Route::get('/', [AdminController::class, 'transaksi'])->name('transaksi');
        Route::post('save', [AdminController::class, 'saveTransaksi'])->name('transaksi.save');
        Route::get('detail/{id}', [AdminController::class, 'detailTransaksi'])->name('transaksi.detail');
        Route::post('status', [AdminController::class, 'updateStatusTransaksi'])->name('transaksi.status');
    });

    Route::group(['prefix' => 'ulasan'], function () 
    {
        Route::get('/', [AdminController::class, 'ulasan'])->name('ulasan');
        Route::get('detail/{id}', [AdminController::class, 'daftarUlasan'])->name('ulasan.detail');
        Route::post('data', [AdminController::class, 'getDataUlasan'])->name('ulasan.data');
        Route::post('status', [AdminController::class, 'updateStatusUlasan'])->name('ulasan.status');
    });
});

Route::group(['prefix' => 'user'], function () 
{
    //Homepage Route    
    Route::group(['prefix' => 'homepage'], function () 
    {
        Route::get('/', [HomepageController::class, 'index'])->name('homepage');
    });
});

 
Route::group(['prefix' => 'pelanggan', 'as' => 'pelanggan.'], function () 
{
    //Home Page Route
    Route::group(['as' => 'homepage.'], function () 
    {
        Route::get('/homepage', [HomepageController::class, 'index'])->name('index');
    });

    //Detail Product Page Route
    Route::group(['as' => 'detailpage.'], function () 
    {
        Route::get('/detail-product/{id}', [ProductDetailPageController::class, 'index'])->name('index');
    });

    // Login Page Route
    Route::group(['as' => 'login.'], function () 
    {
        Route::get('/login', [LoginPageController::class, 'index'])->name('index');
        Route::post('/login', [LoginPageController::class, 'store'])->name('store')->middleware('throttle:pelangganLogin');
    });

    // Register Page Route
    Route::group(['as' => 'register.'], function () 
    {
        Route::get('/register', [RegisterPageController::class, 'index'])->name('index');
        Route::post('/register', [RegisterPageController::class, 'store'])->name('store');
    });

    //Profile Page Route
    Route::group(['middleware' => ['web','auth:pelanggan'], 'as' => 'profile.'], function () {
        Route::get('/profile', [ProfilePageController::class, 'index'])->name('index');
        Route::post('/logout', [ProfilePageController::class, 'logout'])->name('logout');
        Route::put('/profile/{id}', [ProfilePageController::class, 'update'])->name('update');
    });
});

require __DIR__.'/auth.php';
