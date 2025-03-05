<?php

use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    return redirect()->route('videos.index');
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

Route::middleware(['auth', 'can:manage videos'])->group(function () {
    Route::get('videos/manage', [VideosManageController::class, 'index'])->name('videos.manage.index');
    Route::get('videos/manage/create', [VideosManageController::class, 'create'])->name('videos.manage.create');
    Route::post('videos/manage', [VideosManageController::class, 'store'])->name('videos.manage.store');
    Route::get('videos/manage/{video}', [VideosManageController::class, 'show'])->name('videos.manage.show');
    Route::get('videos/manage/{video}/edit', [VideosManageController::class, 'edit'])->name('videos.manage.edit');
    Route::put('videos/manage/{video}', [VideosManageController::class, 'update'])->name('videos.manage.update');
    Route::get('videos/manage/{video}/delete', [VideosManageController::class, 'delete'])->name('videos.manage.delete');
    Route::delete('videos/manage/{video}', [VideosManageController::class, 'destroy'])->name('videos.manage.destroy');
});

Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');
Route::get('/videos/{video}', [VideosController::class, 'show'])->name('videos.show');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
