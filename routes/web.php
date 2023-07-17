<?php

use App\Http\Controllers\KelolaPenggunaController;
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

Route::get('/data-penerimaan', function () {
    return view('data_penerimaan', ["title" => "Data Penerimaan"]);
})->middleware("auth");
Route::get('/laporan-penerimaan', function () {
    return view('laporan_penerimaan', ["title" => "Laporan Penerimaan"]);
})->middleware("auth");

Route::get('/data-penjualan', function () {
    return view('data_penjualan', ["title" => "Data Penjualan"]);
})->middleware("auth");
Route::get('/laporan-penjualan', function () {
    return view('laporan_penjualan', ["title" => "Laporan Penjualan"]);
})->middleware("auth");

Route::get('/laporan-persediaan', function () {
    return view('laporan_persediaan', ["title" => "Laporan Persediaan"]);
})->middleware("auth");
