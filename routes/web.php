<?php

use App\Http\Controllers\AlumniDirectoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Alumni Directory
    Route::get('/alumni', [AlumniDirectoryController::class, 'index'])->name('alumni.index');

    // Knowledge Feed & Challenge Board
    Route::get('/feed', [PostController::class, 'index'])->name('posts.index');
    Route::post('/feed', [PostController::class, 'store'])->name('posts.store');
});

require __DIR__.'/auth.php';