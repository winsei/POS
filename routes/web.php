\<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DashboardController;
use Egulias\EmailValidator\Result\Reason\DetailedReason;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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

//Transaksi
Route::get('/transaksis', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi_add', [TransaksiController::class, 'tambah'])->name('transaksi.add');
Route::post('/transaksi_save', [TransaksiController::class, 'simpan'])->name('transaksi.save');
Route::get('/transaksi_edit/{no_nota}', [TransaksiController::class, 'ubah'])->name('transaksi.edit');
Route::put('/transaksi_update/{no_nota}', [TransaksiController::class, 'simpan_ubah'])->name('transaksi.update');
Route::delete('/transaksi_delete/{no_nota}', [TransaksiController::class, 'hapus'])->name('transaksi.delete');

// Grouping untuk transaksi detail
Route::prefix('transaksi/{no_nota}/detail')->group(function () {
    Route::get('/', [DetailController::class, 'show'])->name('transaksi.detail'); // Menampilkan halaman detail transaksi
    
    Route::get('/barang_add', [DetailController::class, 'tambahBarang'])->name('detail.barang.add'); // Form tambah barang
    
    Route::get('/service_add', [DetailController::class, 'tambahService'])->name('detail.service.add'); // Form tambah service

    Route::post('/barang_save', [DetailController::class, 'simpanBarang'])->name('detail.barang.save'); // Simpan barang
    Route::post('/service_save', [DetailController::class, 'simpanService'])->name('detail.service.save'); // Simpan service
});

// Route untuk mengedit dan menghapus detail barang dan service
Route::prefix('detail')->group(function () {
    Route::get('/barang_edit/{id}', [DetailController::class, 'editBarang'])->name('detail.barang.edit'); // Form edit barang
    Route::get('/service_edit/{id}', [DetailController::class, 'editService'])->name('detail.service.edit'); // Form edit service
    Route::get('/transaksi/{no_nota}/barang_add', [DetailController::class, 'tambahBarang'])->name('detail.barang.add');

    Route::put('/barang_update/{id}', [DetailController::class, 'updateBarang'])->name('detail.barang.update'); // Update barang
    Route::put('/service_update/{id}', [DetailController::class, 'updateService'])->name('detail.service.update'); // Update service
    
    Route::delete('/barang_delete/{id}', [DetailController::class, 'hapusBarang'])->name('detail.barang.delete'); // Hapus barang
    Route::delete('/service_delete/{id}', [DetailController::class, 'hapusService'])->name('detail.service.delete'); // Hapus service
    Route::get('/{no_nota}/cetak', [DetailController::class, 'cetak'])->name('detail.cetak');

});

Route::get('/transaksi/{no_nota}/total', [DetailController::class, 'updateTotalTransaksi']);

//Hak Akses
Route::get('/admin/users', [UserManagementController::class, 'index'])->name('HakAkses.index');

// Mengubah role pengguna
Route::put('/admin/users/{user}/update-role', [UserManagementController::class, 'updateRole'])->name('HakAkses.update-role');

// Mengedit pengguna
Route::get('/admin/users/{user}/edit', [UserManagementController::class, 'edit'])->name('HakAkses.edit');
Route::put('/admin/users/{user}', [UserManagementController::class, 'update'])->name('HakAkses.update');

// Menghapus pengguna
Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('HakAkses.destroy');

// Route to show the form for adding a new user
Route::get('/admin/hak-akses/create', [UserManagementController::class, 'create'])->name('HakAkses.create');

// Route to store the new user
Route::post('/admin/hak-akses', [UserManagementController::class, 'store'])->name('HakAkses.store');

// Route untuk laporan bulanan
Route::get('/laporan-bulanan', [TransaksiController::class, 'laporanBulanan'])->name('laporan.bulanan');
Route::get('/laporan-harian/{periode}', [TransaksiController::class, 'laporanHarian'])->name('laporan.harian');

