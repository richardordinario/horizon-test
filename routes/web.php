<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/songs');
});

Route::middleware(["auth"])->group(function () {
    Route::get('songs/random', [SongController::class, "getRandom"])->name("songs.random");
    Route::resource('songs', SongController::class)->names("songs");
});

require __DIR__.'/auth.php';
