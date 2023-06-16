<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\KaryawanController;

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
    return view('welcome');
});

//karyawan
// Route::get('karyawans', [KaryawanController::class, 'index'])->name('karyawans.index');
// Route::post('karyawans', [KaryawanController::class, 'store'])->name('karyawans.store');
// Route::get('karyawans/{karyawan}', [KaryawanController::class, 'show'])->name('karyawans.show');
// Route::put('karyawans/{karyawan}', [KaryawanController::class, 'update'])->name('karyawans.update');
// Route::delete('karyawans/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawans.destroy');