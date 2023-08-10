<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AbsensiController;
use  App\Http\Controllers\SiswaController;
use  App\Http\Controllers\AbController;
use  App\Http\Controllers\UidController;
// use App\Http\Controllers\Api\AbsensiController;

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
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
});
// route resource untuk absen siswa
Route::resource('/absen',UidController::class,);
//route resource dashboard
Route::resource('/', SiswaController::class);
//route resource laporan
Route::resource('laporan', AbsensiController::class);