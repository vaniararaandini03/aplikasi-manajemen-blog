<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffArticleController;
use App\Http\Controllers\Admin\ArticleController;

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/articles/{article}', [GuestController::class, 'showArticle'])->name('guest.article.show');
Route::get('/category/{category}', [GuestController::class, 'articlesByCategory'])->name('guest.category.articles');
Route::get('/search', [GuestController::class, 'search'])->name('guest.search');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register (hanya staff)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');

    // Staff management
    Route::get('/staff/create', [AdminController::class, 'createStaff'])->name('staff.create');
    Route::post('/staff/store', [AdminController::class, 'storeStaff'])->name('staff.store');

    // Article management
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::put('/{article}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/', [StaffArticleController::class, 'index'])->name('index');
        Route::get('/create', [StaffArticleController::class, 'create'])->name('create');
        Route::post('/', [StaffArticleController::class, 'store'])->name('store');
        Route::get('/{article}/edit', [StaffArticleController::class, 'edit'])->name('edit');
        Route::put('/{article}', [StaffArticleController::class, 'update'])->name('update');
        Route::delete('/{article}', [StaffArticleController::class, 'destroy'])->name('destroy');
    });
});
