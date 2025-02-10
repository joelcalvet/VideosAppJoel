<?php

use App\Http\Controllers\VideosController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');
Route::get('/videos/{video}', [VideosController::class, 'show'])->name('videos.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/videos/manage', function () {
        if (!Gate::allows('manage-videos')) {
            abort(403);
        }
        return view('videos.manage');
    })->name('videos.manage');
});
