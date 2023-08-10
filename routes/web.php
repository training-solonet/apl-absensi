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
Route::get('/', function () {
    return view('dashboard.dashboard');
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

// Route::resource('absensi', AbsensiController::class, 'create');

// Route::get('tes', 'AbController@index');
// Route::get('tes', 'AbController@index')->name('pic');

Route::get('/tes', [AbsensiController::class, 'index']);

Route::get('/siswa',[SiswaController::class, 'store']);

Route::get('/nama',[UidController::class, 'store']);

Route::get('/uid',[AbsensiController::class, 'store2']);

// Route::get('/laporan', function () {
//     return view('dashboard.laporan');
// });
Route::get('/data', function () {
    return view('dashboard.data');
});
// Route::get('/laporan', [AbsensiController::class, 'laporan']);
// Route::get('/laporan/rekap', [AbsensiController::class, 'rekap']);

Route::get('/laporan',[AbsensiController::class, 'laporan'])->name('laporan');
Route::get('/laporan/cari', [AbsensiController::class, 'rekap'])->name('filter');