<?php

use App\Http\Controllers\DataPenerimaanController;
use App\Http\Controllers\DataPenjualanController;
use App\Http\Controllers\DataPersediaanController;
use App\Http\Controllers\KelolaPenggunaController;
use App\Http\Controllers\LaporanPenerimaanController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanPersediaanController;
use App\Http\Controllers\LoginController;
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
    return view('dashboard', ["title" => "Dashboard"]);
})->middleware("auth");

Route::get('/login', [LoginController::class, 'index'])->name("login")->middleware("guest");
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/kelola-pengguna', [KelolaPenggunaController::class, 'index'])->middleware("auth");
Route::post('/kelola-pengguna', [KelolaPenggunaController::class, 'store']);
Route::put('/kelola-pengguna/{user}', [KelolaPenggunaController::class, 'update']);
Route::delete('/kelola-pengguna/{user}', [KelolaPenggunaController::class, 'destroy']);

Route::get('/data-penerimaan', [DataPenerimaanController::class, 'index'])->middleware("auth");
Route::post('/data-penerimaan', [DataPenerimaanController::class, 'store']);
Route::put('/data-penerimaan/{penerimaan}', [DataPenerimaanController::class, 'update']);
Route::delete('/data-penerimaan/{penerimaan}', [DataPenerimaanController::class, 'destroy']);

Route::get('/data-penjualan', [DataPenjualanController::class, 'index'])->middleware("auth");
Route::post('/data-penjualan', [DataPenjualanController::class, 'store']);
Route::put('/data-penjualan/{penjualan}', [DataPenjualanController::class, 'update']);
Route::delete('/data-penjualan/{penjualan}', [DataPenjualanController::class, 'destroy']);

Route::get('/data-persediaan', [DataPersediaanController::class, 'index'])->middleware("auth");
Route::post('/data-persediaan', [DataPersediaanController::class, 'store']);
Route::put('/data-persediaan/{persediaan}', [DataPersediaanController::class, 'update']);
Route::delete('/data-persediaan/{persediaan}', [DataPersediaanController::class, 'destroy']);

Route::get('/laporan-penerimaan', [LaporanPenerimaanController::class, 'index'])->middleware("auth");
Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->middleware("auth");
Route::get('/laporan-persediaan', [LaporanPersediaanController::class, 'index'])->middleware("auth");

Route::get('/laporan-penerimaan/cetak-pdf', [LaporanPenerimaanController::class, 'cetak_pdf'])->middleware("auth");
Route::get('/laporan-penjualan/cetak-pdf', [LaporanPenjualanController::class, 'cetak_pdf'])->middleware("auth");
Route::get('/laporan-persediaan/cetak-pdf', [LaporanPersediaanController::class, 'cetak_pdf'])->middleware("auth");
