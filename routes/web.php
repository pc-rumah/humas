<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KategoriNewsController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ShowNewsAgendaController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/pinjam', [PeminjamanController::class, 'home']);
Route::get('inven', [InventoryController::class, 'home']);
Route::get('/pinjam', [PeminjamanController::class, 'home']);
Route::get('/newsagenda', [ShowNewsAgendaController::class, 'home']);
Route::get('/permohonan', [LetterController::class, 'home']);
Route::post('/peminjaman/user', [PeminjamanController::class, 'storeUser'])->name('peminjaman.storeUser');
Route::post('/letter/user', [LetterController::class, 'storeUser'])->name('letter.storeUser');

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
    Route::resource('kategorinews', KategoriNewsController::class);
    Route::get('/export-peminjaman', [PeminjamanController::class, 'exportPDF'])->name('peminjaman.export');
    Route::get('/export-peminjaman-excel', [PeminjamanController::class, 'exportExcel'])->name('peminjaman.export.excel');
});

Route::middleware(['auth', 'role:petugas'])->group(function () {
    //
});

Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('news', NewsController::class);
    Route::resource('agenda', AgendaController::class);
    Route::resource('letter', LetterController::class);
    Route::get('/letter/download/{id}', [LetterController::class, 'download'])->name('letter.download');
});

require __DIR__ . '/auth.php';
