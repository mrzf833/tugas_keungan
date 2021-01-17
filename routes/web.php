<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::get('pemasukan',[PemasukanController::class,'index'])->middleware(['auth'])->name('pemasukan.index');
Route::post('pemasukan',[PemasukanController::class,'store'])->middleware(['auth'])->name('pemasukan.store');
Route::delete('pemasukan/deleteall',[PemasukanController::class,'deleteAll'])->middleware(['auth'])->name('pemasukan.delete.all');
Route::delete('pemasukan/{id}',[PemasukanController::class,'delete'])->middleware(['auth'])->name('pemasukan.delete');

Route::get('pengeluaran',[PengeluaranController::class,'index'])->middleware(['auth'])->name('pengeluaran.index');
Route::post('pengeluaran',[PengeluaranController::class,'store'])->middleware(['auth'])->name('pengeluaran.store');
Route::delete('pengeluaran/deleteall',[PengeluaranController::class,'deleteAll'])->middleware(['auth'])->name('pengeluaran.delete.all');
Route::delete('pengeluaran/{id}',[PengeluaranController::class,'delete'])->middleware(['auth'])->name('pengeluaran.delete');

require __DIR__.'/auth.php';
