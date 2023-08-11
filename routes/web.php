<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AbsensiController;
use  App\Http\Controllers\SiswaController;
use  App\Http\Controllers\AbController;
use  App\Http\Controllers\UidController;
use Illuminate\Routing\Route as RoutingRoute;

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
Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
});
// route untuk absen siswa
Route::get('absen',[UidController::class, 'store']);
//route resource dashboard
Route::resource('/', SiswaController::class);
//route resource laporan
Route::resource('laporan', AbsensiController::class);