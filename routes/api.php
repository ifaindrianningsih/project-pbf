<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KaryawanController;
use App\Http\Controllers\Api\ObatController;
use App\Http\Controllers\Api\PakanController;
use App\Http\Controllers\Api\SapiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//karyawan
// Route::apiResource('/karyawans', KaryawanController::class);

Route::get('karyawans', [KaryawanController::class, 'index'])->name('karyawans.index');
Route::post('karyawans', [KaryawanController::class, 'store'])->name('karyawans.store');
Route::get('karyawans/{nomorKaryawan}', [KaryawanController::class, 'show'])->name('karyawans.show');
Route::put('karyawans/{nomorKaryawan}', [KaryawanController::class, 'update'])->name('karyawans.update');
Route::delete('karyawans/{nomorKaryawan}', [KaryawanController::class, 'destroy'])->name('karyawans.destroy');

//obat
Route::get('obats', [ObatController::class, 'index'])->name('obats.index');
Route::post('obats', [ObatController::class, 'store'])->name('obats.store');
Route::get('obats/{jenisObat}', [ObatController::class, 'show'])->name('obats.show');
Route::put('obats/{jenisObat}', [ObatController::class, 'update'])->name('obats.update');
Route::delete('obats/{jenisObat}', [ObatController::class, 'destroy'])->name('obats.destroy');

//pakan
Route::get('pakans', [PakanController::class, 'index'])->name('pakans.index');
Route::post('pakans', [PakanController::class, 'store'])->name('pakan.store');
Route::get('pakans/{jenisPakan}', [PakanController::class, 'show'])->name('pakans.show');
Route::put('pakans/{jenisPakan}', [PakanController::class, 'update'])->name('pakans.update');
Route::delete('pakans/{jenisPakan}', [PakanController::class, 'destroy'])->name('pakans.destroy');

//sapi
Route::get('sapis', [SapiController::class, 'index'])->name('sapis.index');
Route::post('sapis', [SapiController::class, 'store'])->name('sapis.store');
Route::get('sapis/{nis}', [SapiController::class, 'show'])->name('sapis.show');
Route::put('sapis/{nis}', [SapiController::class, 'update'])->name('sapis.update');
Route::delete('sapis/{nis}', [SapiController::class, 'destroy'])->name('sapis.destroy');