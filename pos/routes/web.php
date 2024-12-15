<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

    Route::get('/kelola-transaksi', [TransaksiController::class, 'index'])->name('transaksi');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Menampilkan form reservasi
    Route::get('/user/reservasi/', [ReservasiController::class, 'index'])->name('reservasi');

    // Menyimpan data reservasi
    Route::post('/user/reservasi/store', [ReservasiController::class, 'store'])->name('reservasi.store');
});

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');

//Barang

Route::get('/barangs', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang_add', [BarangController::class, 'tambah'])->name('barang.add');
Route::post('/barang_save', [BarangController::class, 'simpan'])->name('barang.save');
Route::get('/barang_edit/{id}', [BarangController::class, 'ubah'])->name('barang.edit');
Route::put('/barang_update/{id}', [BarangController::class, 'simpan_ubah'])->name('barang.update');
Route::delete('/barang_delete/{id}', [BarangController::class, 'hapus'])->name('barang.delete');

//Service

Route::get('/services', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service_add', [ServiceController::class, 'tambah'])->name('service.add');
Route::post('/service_save', [ServiceController::class, 'simpan'])->name('service.save');
Route::get('/service_edit/{id}', [ServiceController::class, 'ubah'])->name('service.edit');
Route::put('/service_update/{id}', [ServiceController::class, 'simpan_ubah'])->name('service.update');
Route::delete('/service_delete/{id}', [ServiceController::class, 'hapus'])->name('service.delete');
