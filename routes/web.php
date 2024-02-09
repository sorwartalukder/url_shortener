<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/url/{shortUrl}', [UrlController::class, 'redirectToOriginalUrl']);

Route::middleware('auth')->group(function () {
    Route::get('/', [UrlController::class, 'showForm'])->name('home');
    Route::post('/', [UrlController::class, 'shortenUrl'])->name('home');
    Route::get('/result', [UrlController::class, 'showResult'])->name('url.result');
    Route::get('/dashboard', [UrlController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
