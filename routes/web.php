<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MusicController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/music/{id}', [MusicController::class, 'show'])->name('music.show');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('admin/songs', SongController::class);
});