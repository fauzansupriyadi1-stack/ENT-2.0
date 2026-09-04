<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/{slug}', [HomeController::class, 'show'])->name('article.show');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');
