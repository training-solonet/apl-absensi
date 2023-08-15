<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AbsensiController;
use  App\Http\Controllers\SiswaController;
use  App\Http\Controllers\AbController;
use  App\Http\Controllers\UidController;
use  App\Http\Controllers\StudentsController;
use  App\Http\Controllers\EditController;
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
   //route resource dashboard
Route::resource('/', SiswaController::class);
});
// route untuk absen siswa
Route::get('absen',[UidController::class, 'store']);
//route resource laporan
Route::resource('laporan', AbsensiController::class);
//route resource data
Route::resource('data', StudentsController::class);
//route resource form edit
Route::resource('edit', EditController::class);

Route::get('/index', [StudentsController::class, 'index']);

Route::get('/edit/form/{name}', [EditController::class, 'index'])->name('edit.form');
