<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\KasDesaController;
use App\Http\Controllers\MeterAirController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagihanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pelanggan', PelangganController::class);
    Route::resource('meter', MeterAirController::class)->only(['index','store']);
    Route::post('pembayaran', [PembayaranController::class,'store']);

    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
    Route::get('/tagihan/{tagihan}', [TagihanController::class, 'show'])->name('tagihan.show');
    Route::post('/tagihan/generate', [TagihanController::class, 'generate'])->name('tagihan.generate');
    Route::post('/tagihan/{id}/verifikasi', [TagihanController::class, 'verifikasi'])->name('tagihan.verifikasi');

    Route::get('/kas', [KasDesaController::class, 'index'])->name('kas.index');
    Route::post('/kas', [KasDesaController::class, 'store'])->name('kas.store');
    Route::get('/kas/export', [KasDesaController::class, 'export'])->name('kas.export');


});

require __DIR__.'/auth.php';
