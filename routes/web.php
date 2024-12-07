<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RuangTanyaController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\CekKesehatanController;
use App\Http\Controllers\AuthenticationController;

Route::get('/login',[AuthenticationController::class, 'loginview'])->name('login');
Route::post('/login',[AuthenticationController::class,'authentication'])->name('auth.authentication');
Route::get('/register',[AuthenticationController::class, 'registerview'])->name('register');
Route::post('/register',[AuthenticationController::class,'registration'])->name('auth.registration');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/ruang-bertanya', [RuangTanyaController::class, 'index'])->name('ruang-bertanya.index');
    Route::post('/chat', [RuangTanyaController::class, 'sendMessage'])->name('ruang-bertanya.chat');
    Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi.index');

    Route::get('/cek-kesehatan', [CekKesehatanController::class, 'index'])->name('cek-kesehatan.index');
    Route::post('/upload-photo', [CekKesehatanController::class, 'uploadPhoto'])->name('cek-kesehatan.upload-photo');
    Route::get('/cek-kesehatan/hasil', [CekKesehatanController::class, 'hasil'])->name('cek-kesehatan.hasil')->middleware('isSubmitPhoto');

    Route::get('/profile', [UserController::class, 'index'])->name('profile.index');

    Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');
    Route::post('/ruangbertanya/delete-history', [RuangTanyaController::class, 'deleteHistory'])->name('ruangbertanya.delete-history');

});
