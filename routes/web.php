<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK (LANDING PAGE & DETAIL BERITA)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/category/{slug}', [LandingController::class, 'category'])->name('category.show');
Route::get('/article/{slug}', [LandingController::class, 'show'])->name('article.show');
Route::post('/subscribe', [LandingController::class, 'subscribe'])->name('subscribe');

/*
|--------------------------------------------------------------------------
| 2. ROUTE AUTENTIKASI (LOGIN & LOGOUT)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. ROUTE ADMIN DASHBOARD (CRUD ARTIKEL - PROTECTED AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('dashboard.daftar-artikel');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('dashboard.tambah-artikel');
    Route::post('/articles', [ArticleController::class, 'store'])->name('dashboard.simpan-artikel');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('dashboard.edit-artikel');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('dashboard.update-artikel');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('dashboard.hapus-artikel');
});

