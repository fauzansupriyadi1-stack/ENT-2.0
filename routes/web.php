<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');
Route::get('/article/{slug}', [HomeController::class, 'show'])->name('article.show');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

// Real-Time API Routes
Route::get('/api/stats', [DashboardController::class, 'statsApi'])->name('api.stats');
Route::post('/api/articles/{id}/like', [DashboardController::class, 'likeArticle'])->name('api.like');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Management Routes (Protected by Auth Middleware)
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/articles/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/articles', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/articles/{id}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/articles/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/articles/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});
