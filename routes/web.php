<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ADMIN\AdminController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/api/articles', [\App\Http\Controllers\Api\ArticleApiController::class, 'index']);



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// صفحات لوحة التحكم
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');


    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles');
    Route::post('/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');

});

Route::get('/writer', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('writer.dashboard');