<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\MusicStyleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;





//API
Route::post('/songs/{songId}/listen', [HistoryController::class, 'recordListening'])->middleware('auth');



//Views Routes

Route::get('/', function () {
    return view('welcome');
});
Route::get('/music/{id}', [MusicController::class, 'show'])->name('music.show');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user/histories', [HistoryController::class, 'userHistory'])->middleware('auth');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('admin/dashboard/songs', SongController::class);
    Route::resource('admin/dashboard/albums', AlbumController::class);
    Route::resource('admin/dashboard/music_styles', MusicStyleController::class);
    Route::resource('admin/dashboard/users', UserController::class);
    
});