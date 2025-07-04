<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\WelcomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/pinjam', [PeminjamanController::class, 'home']);
Route::get('inven', [InventoryController::class, 'home']);
Route::get('/pinjam', [PeminjamanController::class, 'home']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('inventori', InventoryController::class);
    Route::get('/export-peminjaman', [PeminjamanController::class, 'exportPDF'])->name('peminjaman.export');
    Route::get('/export-peminjaman-excel', [PeminjamanController::class, 'exportExcel'])->name('peminjaman.export.excel');
});

Route::middleware(['auth', 'role:petugas'])->group(function () {
    //
});

Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::resource('peminjaman', PeminjamanController::class);
});

require __DIR__ . '/auth.php';
