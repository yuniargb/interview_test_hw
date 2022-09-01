<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route Kategori Buku */
Route::group(['prefix' => 'kategori_buku'], function () {
    Route::get('/', [KategoriBukuController::class,'index']);
    Route::post('/store', [KategoriBukuController::class,'store']);
    Route::put('/update/{id}', [KategoriBukuController::class,'update']);
    Route::delete('/delete/{id}', [KategoriBukuController::class,'destroy']);
});
/* Route Kategori Buku */

/* Route Buku */
Route::group(['prefix' => 'buku'], function () {
    Route::get('/', [BukuController::class,'index']);
    Route::post('/store', [BukuController::class,'store']);
    Route::put('/update/{id}', [BukuController::class,'update']);
    Route::delete('/delete/{id}', [BukuController::class,'destroy']);
});
/* Route Buku */

/* Route Transaksi Peminjaman Buku */
Route::group(['prefix' => 'transaksi'], function () {
    Route::get('/', [PeminjamanController::class,'index']);
    Route::post('/peminjaman', [PeminjamanController::class,'peminjaman']);
    Route::put('/pengembalian/{id}', [PeminjamanController::class,'pengembalian']);
});
/* Route Transaksi Peminjaman Buku */