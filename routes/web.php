<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\StaffArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GuestLoginController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/search', [GuestController::class, 'search'])->name('guest.search');

/*
|--------------------------------------------------------------------------
| GUEST LOGIN & REGISTER
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/guest/login', [GuestLoginController::class, 'showLoginForm'])
        ->name('guest.login');

    Route::post('/guest/login', [GuestLoginController::class, 'login'])
        ->name('guest.login.submit');

    Route::get('/guest/register', [App\Http\Controllers\Auth\GuestRegisterController::class, 'showRegistrationForm'])
        ->name('guest.register');

    Route::post('/guest/register', [App\Http\Controllers\Auth\GuestRegisterController::class, 'register'])
        ->name('guest.register.submit');
});

/*
|--------------------------------------------------------------------------
| GUEST AREA (LOGIN GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest.auth')->group(function () {
    Route::get('/articles/{article}', [GuestController::class, 'showArticle'])
        ->name('guest.article.show');

    Route::get('/categories/{category}', [GuestController::class, 'articlesByCategory'])
        ->name('guest.category.articles');
});

/*
|--------------------------------------------------------------------------
| AUTH UMUM (ADMIN & STAFF)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [AdminController::class, 'profile'])
            ->name('profile');

        Route::put('/profile', [AdminController::class, 'updateProfile'])
            ->name('profile.update');

        Route::get('/users', [AdminController::class, 'users'])
            ->name('users.index');

        Route::get('/staff/create', [AdminController::class, 'createStaff'])
            ->name('staff.create');

        Route::post('/staff/store', [AdminController::class, 'storeStaff'])
            ->name('staff.store');

        /* ================= ADMIN ARTICLES ================= */
        Route::prefix('articles')->name('articles.')->group(function () {
            Route::get('/', [ArticleController::class, 'index'])->name('index');
            Route::get('/create', [ArticleController::class, 'create'])->name('create');
            Route::post('/', [ArticleController::class, 'store'])->name('store');

            // 🔥 INI YANG BIKIN ERROR KEMARIN (SEKARANG SUDAH ADA)
            Route::get('/{article}', [ArticleController::class, 'show'])
                ->name('show');

            Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
            Route::put('/{article}', [ArticleController::class, 'update'])->name('update');
            Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
        });

        /* ================= ADMIN CATEGORIES ================= */
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {

        Route::get('/dashboard', [StaffDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [StaffController::class, 'profile'])
            ->name('profile');

        Route::put('/profile', [StaffController::class, 'updateProfile'])
            ->name('profile.update');

        Route::prefix('articles')->name('articles.')->group(function () {
            Route::get('/', [StaffArticleController::class, 'index'])->name('index');
            Route::get('/create', [StaffArticleController::class, 'create'])->name('create');
            Route::post('/', [StaffArticleController::class, 'store'])->name('store');
            Route::get('/{article}', [StaffArticleController::class, 'show'])->name('show');
            Route::get('/{article}/edit', [StaffArticleController::class, 'edit'])->name('edit');
            Route::put('/{article}', [StaffArticleController::class, 'update'])->name('update');
            Route::delete('/{article}', [StaffArticleController::class, 'destroy'])->name('destroy');
        });
    });
