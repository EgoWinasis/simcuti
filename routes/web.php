<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');
// users
Route::resource('password', PasswordController::class)->middleware('auth');
// profile
Route::resource('profile', ProfileController::class)->middleware('auth');
// cuti
Route::group(['middleware' => 'profile.check'], function () {
    // Routes that require profile check
    Route::resource('cuti', CutiController::class)->middleware('auth');
    Route::resource('verifikasi', VerifikasiController::class)->middleware('auth');
    Route::resource('cetak', CetakController::class)->middleware('auth');
    
});
