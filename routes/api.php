<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\RiwayatTransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('transaksi', [TransaksiController::class, 'index']);
Route::post('transaksi', [TransaksiController::class, 'store']);
Route::get('transaksi/{id}', [TransaksiController::class, 'show']);
Route::put('transaksi/{id}', [TransaksiController::class, 'update']);
Route::delete('transaksi/{id}', [TransaksiController::class, 'destroy']);

Route::get('riwayat-transaksi', [RiwayatTransaksiController::class, 'index']);
Route::get('riwayat-transaksi/{id}', [RiwayatTransaksiController::class, 'show']);

Route::put('/stok/{kode_barang}', [StokBarangController::class, 'updateStok']);

Route::post('/barangs', [BarangController::class, 'store']);
Route::put('/barang/{id}', [BarangController::class, 'updateJumlah']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
