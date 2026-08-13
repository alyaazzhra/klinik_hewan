<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CashierController; // <-- PASTIKAN BARIS INI ADA!
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');

// Semua Route yang Butuh Login (Auth)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pelayanan / Pendaftaran Pasien
    Route::get('/pelayanan', [ServiceController::class, 'index'])->name('pelayanan');
    
    // TAMBAHKAN ROUTE INI: Untuk memproses tombol simpan formulir
    Route::post('/pelayanan/simpan', [ServiceController::class, 'store'])->name('pelayanan.store');

    // Profile Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::middleware(['auth'])->group(function () {
    // ... rute dashboard dan pelayanan yang lama tetap biarkan ...

    // RUTE BARU UNTUK EDIT DAN HAPUS DATA
    Route::get('/pelayanan/{id}/edit', [ServiceController::class, 'edit'])->name('pelayanan.edit');
    Route::put('/pelayanan/{id}', [ServiceController::class, 'update'])->name('pelayanan.update');
    Route::delete('/pelayanan/{id}', [ServiceController::class, 'destroy'])->name('pelayanan.destroy');
});
Route::get('/kasir', [CashierController::class, 'index'])->name('kasir');
Route::post('/kasir/simpan', [CashierController::class, 'store'])->name('kasir.store');
Route::get('/kasir/{id}/cetak', [CashierController::class, 'print'])->name('kasir.print');

Route::middleware(['auth'])->group(function () {
    // Rute utama Dashboard & Pelayanan Anda yang lama biarkan saja di sini
    
    // ==========================================
    // SEGMEN KASIR & RIWAYAT TRANSAKSI BARU
    // ==========================================
    
    // 1. Menampilkan halaman kasir (tabel pasien dari pelayanan)
    Route::get('/kasir', [CashierController::class, 'index'])->name('kasir');
    
    // 2. Memproses tombol hitung bayar kasir
    Route::post('/kasir/simpan', [CashierController::class, 'store'])->name('kasir.store');
    
    // 3. Membuka halaman struk thermal khusus siap cetak
    Route::get('/kasir/{id}/cetak', [CashierController::class, 'print'])->name('kasir.print');
    
    // 4. SESUAI REKUES: Menggunakan URL /transactions untuk melihat riwayat keuangan
    Route::get('/transactions', [CashierController::class, 'riwayat'])->name('riwayat');
});

});

require __DIR__.'/auth.php';
