<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TesKompleksitasController;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/produk', ProductController::class);
    Route::resource('admin/pengguna', PenggunaController::class);
    Route::resource('admin/pembelian', PembelianController::class);
    Route::resource('admin/penjualan', PenjualanController::class);
    // Route::resource('admin/periode', PeriodeController::class);
});

Route::middleware(['auth', 'role:gudang'])->group(function () {
    Route::get('pembina/extracurricular/{id}', [ProductController::class, 'ekstrakurikulerPembina'])->name('extracurricular.pembina');
    Route::get('pembina/extracurricular/{id}/peserta', [ProductController::class, 'peserta'])->name('extracurricular.peserta');
    Route::get('pembina/extracurricular/{id}/approve/{user_id}', [ProductController::class, 'approve'])->name('extracurricular.approve');
    Route::get('pembina/extracurricular/{id}/pending/{user_id}', [ProductController::class, 'pending'])->name('extracurricular.pending');
    Route::get('pembina/extracurricular/{id}/reject/{user_id}', [ProductController::class, 'reject'])->name('extracurricular.reject');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('siswa/extracurricular/{id}', [ProductController::class, 'ekstrakurikulerSiswa'])->name('extracurricular.siswa');
    Route::get('siswa/extracurricular/{id}/detail', [ProductController::class, 'ekstrakurikulerDetail'])->name('extracurricular.detail');
    Route::post('siswa/extracurricular/{id}/register', [ProductController::class, 'register'])->name('extracurricular.register');
    Route::post('siswa/extracurricular/{id}/unregister', [ProductController::class, 'unregister'])->name('extracurricular.unregister');
    Route::get('siswa/extracurricular', [ProductController::class, 'ekstrakurikulerSemua'])->name('extracurricular');
});

Route::get('tes-kompleksitas', [TesKompleksitasController::class, 'analyze'])->name('tes-kompleksitas');
Route::get('tes-kompleksitas/multiple', [TesKompleksitasController::class, 'analyzeMultiple'])->name('tes-kompleksitas.multiple');

require __DIR__.'/auth.php';
