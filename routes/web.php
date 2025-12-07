<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\PeriodeController;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/extracurricular', EkstrakurikulerController::class);
    Route::resource('admin/pembina', PembinaController::class);
    Route::resource('admin/peserta', PesertaController::class);
    Route::resource('admin/periode', PeriodeController::class);
});

Route::middleware(['auth', 'role:pembina'])->group(function () {
    Route::get('pembina/extracurricular/{id}', [EkstrakurikulerController::class, 'ekstrakurikulerPembina'])->name('extracurricular.pembina');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('siswa/extracurricular/{id}', [EkstrakurikulerController::class, 'ekstrakurikulerSiswa'])->name('extracurricular.siswa');
    Route::get('siswa/extracurricular/{id}/detail', [EkstrakurikulerController::class, 'ekstrakurikulerDetail'])->name('extracurricular.detail');
    Route::post('siswa/extracurricular/{id}/register', [EkstrakurikulerController::class, 'register'])->name('extracurricular.register');
    Route::post('siswa/extracurricular/{id}/unregister', [EkstrakurikulerController::class, 'unregister'])->name('extracurricular.unregister');
    Route::get('siswa/extracurricular', [EkstrakurikulerController::class, 'ekstrakurikulerSemua'])->name('extracurricular');
});

require __DIR__.'/auth.php';
