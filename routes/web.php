<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/bukus', [BukuController::class, 'index'])->name('bukus.index');

    Route::get('/peminjamen', [PeminjamanController::class, 'index'])->name('peminjamen.index');
    Route::get('/peminjamen/{buku}', [PeminjamanController::class, 'create'])->name('peminjamen.create');
    Route::post('/peminjamen/{buku}', [PeminjamanController::class, 'store'])->name('peminjamen.store');
    Route::get('/peminjamen/terminate/{peminjaman}', [PeminjamanController::class, 'terminate'])->name('peminjamen.terminate');
});

require __DIR__ . '/auth.php';
